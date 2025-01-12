<?php /*
 * Generated by CRUDigniter v3.2
 * www.crudigniter.com
 */

class Absence extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('Absence_model');
		$this->load->model('Internship_model');
		$this->load->model('Teacher_model');
	}

	/*
	 * Listing of presences
	 */
	function index() {
		$user_id = $this->session->userdata('userid');
		$current_user_program_id = $this->Teacher_model->get_teacher($user_id);
		$data['internships'] = $this->Internship_model->get_all_internships("teacher", $user_id, $current_user_program_id['PROGRAM_IDS']);
		$data["students"] = $this->Student_model->get_all_students_from_program_ids($current_user_program_id['PROGRAM_IDS']);

		$data['absences'] = $this->Absence_model->get_all_absences();

		$data['_view'] = 'absence/index';
		$this->load->view('layouts/main', $data);
	}

	function printabsences($student_id, $start_date, $end_date) {
		$user_id = $this->session->userdata('userid');
		$current_user_program_id = $this->Teacher_model->get_teacher($user_id);
		$data['internships'] = $this->Internship_model->get_all_internships("teacher", $user_id, $current_user_program_id['PROGRAM_IDS']);
		$data["students"] = $this->Student_model->get_all_students_by_teacher_id($user_id);
		$data['absences'] = $this->Absence_model->get_all_absences_filter($student_id, $start_date, $end_date);
		$data['studentid'] = $student_id;
		$data['start_date'] = $start_date;
		$data['end_date'] = $end_date;

		$arr = array();
		foreach ($data['absences'] as $student) {
			$arr[] = $student["STUDENT_ID"];
		}
		$unique_students = array_unique($arr);
		$data['unique_student'] = $unique_students;

		$data['student_id'] = $user_id;
		$this->load->view('absence/print', $data);
	}

	/*
	 * Adding a new presence
	 */
	function add() {}

	/*
	 * Editing a presence
	 */
	function edit($ID) {}

	/*
	 * Deleting presence
	 */
	function remove($ID) {}
}
