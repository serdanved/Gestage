<?php

class Report extends MY_Controller {
	function __construct() {
		parent::__construct();
        $this->load->model("Internship_model");
        $this->load->model("Employer_model");
        $this->load->model("Document_model");
	}

	function index() {
		$programs = $this->Teacher_model->get_program_by_teacher_id_select($this->session->userid);
        $program_ids = array();
        $data["programs"] = array(0 => "Tous les programmes");
        foreach ($programs as $P) {
            $program_ids[] = $P["ID"];
			$data["programs"][$P["ID"]] = $P["NAME"];
		}

		$students = $this->Student_model->get_all_students_from_program_ids($program_ids);
		$data["students"] = array(0 => "Tous les élèves");
		foreach ($students as $S) {
			$data["students"][$S["ID"]] = $S["NAME"];
		}

        $employers = $this->Employer_model->get_all_employers();
		$data["employers"] = array(0 => "Tous les employeurs");
        foreach ($employers as $E) {
			$data["employers"][$E["ID"]] = $E["EMPLOYER_NAME"];
		}

		$data["_view"] = "report/index";
		$this->load->view("layouts/main", $data);
	}

	public function generateXls() {
		// create file name
		$fileName = 'data-' . time() . '.xlsx';
		// load excel library
		$this->load->library('excel');

        $internships = $this->Internship_model->get_interships_for_report(
            $this->input->post("STUDENTS"),
            $this->input->post("EMPLOYERS"),
            $this->input->post("PROGRAMS"),
            $this->input->post("DATE_DEBUT"),
            $this->input->post("DATE_FIN")
        );

        PHPExcel_Settings::setLocale("fr_ca");

		$objPHPExcel = new PHPExcel();
		$objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Liste des stages en date du ' . date("Y-m-d"));

        $objDrawing = new PHPExcel_Worksheet_Drawing();
        $objDrawing->setName('logo');
        $objDrawing->setDescription('logo');
        $objDrawing->setPath(dirname(__FILE__) . "/../../resources/img/logo.png");
        $objDrawing->setCoordinates('E1');
        //setOffsetX works properly
        $objDrawing->setOffsetX(5);
        $objDrawing->setOffsetY(5);
        //set width, height
        $objDrawing->setWidth(100);
        $objDrawing->setHeight(35);
        $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

        if ($this->input->post("DATE_DEBUT") != null && $this->input->post("DATE_FIN") != null) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A2', 'Liste des stages entre ' . $this->input->post("DATE_DEBUT") . ' et ' .$this->input->post("DATE_FIN"));
        }

		// set Header
		$objPHPExcel->getActiveSheet()->SetCellValue('A4', 'Étudiant');
		$objPHPExcel->getActiveSheet()->SetCellValue('B4', 'Employeur');
		$objPHPExcel->getActiveSheet()->SetCellValue('C4', 'Programme');
		$objPHPExcel->getActiveSheet()->SetCellValue('D4', 'Date Début');
        $objPHPExcel->getActiveSheet()->SetCellValue('E4', 'Date Fin');

		// set Row
		$rowCount = 5;
		foreach ($internships[0] as $I) {
			$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $I["STUDENT_NAME"]);
			$objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $I["EMPLOYER_NAME"]);
			$objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $I["PROGRAM"]);
			$objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $I["DATE_START"]);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $I["DATE_END"]);
			$rowCount++;
		}

		$filename = "stages" . date("Y-m-d-H-i-s") . ".xlsx";
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="' . $filename . '"');
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
	}

	function generatePdf() {
        ini_set('max_execution_time', 1000);
        ini_set('memory_limit', '512M');
		$this->load->library("Pdf");

		$data = array(
			"post" => array(
                "report_type" => $this->input->post("REPORT_TYPE"),
				"students" => $this->input->post("STUDENTS"),
				"employers" => $this->input->post("EMPLOYERS"),
				"programs" => $this->input->post("PROGRAMS"),
				"date_debut" => $this->input->post("DATE_DEBUT"),
				"date_fin" => $this->input->post("DATE_FIN"),
			),
		);

        //die($data["internships"][1]);

		$this->pdf->setPaper("Letter", "Portrait");
        switch ($this->input->post("REPORT_TYPE")) {
            case "1":
            case "2":
                $data["internships"] = $this->Internship_model->get_interships_for_report(
                    $this->input->post("STUDENTS"),
                    $this->input->post("EMPLOYERS"),
                    $this->input->post("PROGRAMS"),
                    $this->input->post("DATE_DEBUT"),
                    $this->input->post("DATE_FIN")
                );
                $this->pdf->load_view("report/pdf-tables", $data);
                break;
            case "3":
                $data["employers"] = $this->Employer_model->get_employers_for_report(
                    $this->input->post("PROGRAMS"),
                    $this->input->post("REPORT_TYPE") == "3"
                );
                $this->pdf->load_view("report/pdf-employers", $data);
                break;
            case "4":
                $data["documents"] = $this->Document_model->get_protocoles_for_report(
                    $this->input->post("DATE_DEBUT"),
                    $this->input->post("DATE_FIN")
                );
                $this->pdf->load_view("report/pdf-protocoles", $data);
                break;
            case "5":
                $data["employers"] = $this->Employer_model->get_employers_for_report(
                    $this->input->post("PROGRAMS"),
                    $this->input->post("REPORT_TYPE") == "3"
                );
                $this->pdf->load_view("report/pdf-simple-employers", $data);
                break;
        }
		$this->pdf->render();
		$this->pdf->stream("report.pdf", array("Attachment" => 0));
	}
}