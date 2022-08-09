<?php

class MY_Controller extends CI_Controller {
	function __construct() {
		parent::__construct();

		if (!file_exists("application/controllers/Azure.php")) {
			if (!is_user_logged()) {
				if (uri_string() != "user/login") {
					redirect("/user/login");
				}
			}
		} else {
			if (!is_user_logged()) {
				if ((uri_string() != "azure/connection") && (uri_string() != "azure/login")) {
					redirect("/azure/login");
				}
			}
		}

		/* SI L'UTILISATEUR EST UN ÉLÈVE MAIS PAS D'ENSEIGNANT ASSOCIÉ, ON MONTRE UN MESSAGE D'ERREUR */
		if (is_student()) {
			if (($this->session->userdata("program_id") == 0) && ($this->uri->segment(2) != "set_program")) {
				redirect("/student/set_program/" . $this->session->userdata("userid"));
			}

			$this->load->model('Student_model');
			$teacher_assigned = $this->Student_model->get_assigned_teacher($this->session->userid);

			if (!$teacher_assigned) {
				//show_error("Vous n'avez pas encore d'enseignant associé à votre compte. Veuillez communiquer avec votre enseignant.");
			}
		}
	}
}