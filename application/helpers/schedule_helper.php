<?php

function helper_time_to_decimal($time) {
    $timeArr = explode(':', $time);
    $decTime = ($timeArr[0] * 60) + ($timeArr[1]);

    return $decTime;
}

function generate_block_schedule($block_id, $internship_id) {
    $CI = &get_instance();
    $CI->load->model('Block_model');
    $CI->load->model('Internship_model');

    $newData = array();

    //GET INTERNSHIP SCHEDULE DATA
    $internship_schedules_json = $CI->Internship_model->get_internship($internship_id)["SCHEDULE"];
    $internship_schedules = json_decode($internship_schedules_json);

    //GENERATE DATES DATA ENTRY
    $block = $CI->Block_model->get_block($block_id);
    $date_end = new DateTime($block["DATE_END"]);
    $date_end = $date_end->modify('+1 day');
    $period = new DatePeriod(
        new DateTime($block["DATE_START"]),
        new DateInterval('P1D'), $date_end
    );

    foreach ($period as $date) {
        $day_number = $date->format('N');
        $day_date = $date->format('Y-m-d');
        $compare_with = $day_number - 1;

        $internship_schedules[$compare_with]->DATE = $day_date;
        $internship_schedules[$compare_with]->TOTAL = 0;
        $internship_schedules[$compare_with]->PRESENT = "on";
        $internship_schedules[$compare_with]->REASON = "";

        if (!isset($internship_schedules[$compare_with]->CLOSED)) {
            $datetime_from_am = new DateTime($internship_schedules[$compare_with]->FROM_AM);
            $datetime_to_am = new DateTime($internship_schedules[$compare_with]->TO_AM);
            $datetime_am = helper_time_to_decimal($datetime_from_am->diff($datetime_to_am)->format('%H:%I'));

            $datetime_from_pm = new DateTime($internship_schedules[$compare_with]->FROM_PM);
            $datetime_to_pm = new DateTime($internship_schedules[$compare_with]->TO_PM);
            $datetime_pm = helper_time_to_decimal($datetime_from_pm->diff($datetime_to_pm)->format('%H:%I'));

            if ((isset($internship_schedules[$compare_with]->FROM_EV)) && (isset($internship_schedules[$compare_with]->TO_EV))) {
                $datetime_from_ev = new DateTime($internship_schedules[$compare_with]->FROM_EV);
                $datetime_to_ev = new DateTime($internship_schedules[$compare_with]->TO_EV);
                $datetime_ev = helper_time_to_decimal($datetime_from_ev->diff($datetime_to_ev)->format('%H:%I'));
            } else {
                $datetime_ev = 0;
            }

            $total = ($datetime_am + $datetime_pm + $datetime_ev) / 60;
            $internship_schedules[$compare_with]->TOTAL = $total;
        }

        array_push($newData, array(
            "BLOCK_ID" => $block_id,
            "INTERNSHIP_ID" => $internship_id,
            "VALUE" => clone $internship_schedules[$compare_with],
        ));
    }

    return $newData;
}

function update_block_schedule($blockId, $internshipId) {
    $CI = &get_instance();
    $CI->load->model('Block_model');
    $CI->load->model('Internship_model');

    $currentSchedules = $CI->Block_model->get_all_block_schedules_where(array("INTERNSHIP_ID" => $internshipId));
    foreach ($currentSchedules as &$schedule) {
        $schedule["VALUE"] = json_decode($schedule["VALUE"]);
    }

    $newSchedules = generate_block_schedule($blockId, $internshipId);
    foreach ($newSchedules as &$schedule) {
        foreach ($currentSchedules as $old) {
            if ($old["VALUE"]->DATE == $schedule["VALUE"]->DATE) {
                $schedule["VALUE"] = $old["VALUE"];
                break;
            }
        }

        $schedule["VALUE"] = json_encode($schedule["VALUE"]);
    }

    $CI->Block_model->delete_block_schedule_where(array("BLOCK_ID" => $blockId, "INTERNSHIP_ID" => $internshipId));
    $CI->Block_model->add_block_schedule_batch($newSchedules);
}