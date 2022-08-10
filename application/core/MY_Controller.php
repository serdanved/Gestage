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
				if ((uri_string() != "azure/connection") && (uri_string() != "azure/login") && (uri_string() != "azure/cron")) {
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
		}

        if (is_teacher()) {
            if ($this->uri->segment(2) != "noProgram") {
                $this->load->model('Teacher_model');
                $programs = $this->Teacher_model->get_teacher_programs($this->session->userdata("userid"));
                if (count($programs) < 1) {
                    redirect("/teacher/noProgram");
                }
            }
        }
	}
}