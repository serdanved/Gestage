<?php class User extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model("User_model");
		$this->load->model("Student_model");
		$this->load->model("Teacher_model");
		$this->load->model("Option_model");
	}

	function index() {
		$data['_view'] = 'user/login';
		$this->load->view('user/login', $data);
	}

	function login() {
		if ($this->input->post() != null) {
			$uid = $this->input->post("login_id");
			$pass = $this->input->post("login_pass");

			if ($this->verify_admin($uid, $pass)) {
				redirect("/dashboard/index");
				return;
			}

			if ($this->verify_student($uid, $pass)) {
				redirect("/dashboard/index");
				return;
			}

			if ($this->verify_teacher($uid, $pass)) {
				redirect("/dashboard/index");
				return;
			}

			if ($this->verify_employer($uid, $pass)) {
				redirect("/dashboard/index");
				return;
			}

			redirect("/user/login/errorlogin");
			return;
		}

		$data['_view'] = 'user/login';
		$this->load->view('user/login', $data);
	}

	private function verify_admin($uid, $pass) {
		$user = $this->User_model->get_admin_by_email($uid);
		if ($user == null) {
			return false;
		}

		if (!password_verify($pass, $user["PASSWORD_HASH"])) {
			return false;
		}

		$this->session->set_userdata(array(
			"userid" => $user["ID"],
			"status" => "admin",
			"status_id" => 0,
			"name" => $user["NAME"],
			"mail" => $user["EMAIL"],
			"logged_in" => 1,
		));
		return true;
	}

	private function verify_student($uid, $pass) {
		$user = $this->Student_model->get_student_by_email($uid);
		if ($user == null) {
			return false;
		}

		if (!password_verify($pass, $user["PASSWORD_HASH"])) {
			return false;
		}

		$this->session->set_userdata(array(
			"userid" => $user["ID"],
			"status" => "student",
			"status_id" => 1,
			"name" => $user["NAME"],
			"mail" => $user["EMAIL_CS"],
			"program_id" => $user["PROGRAM_ID"],
			"logged_in" => 1,
		));
		return true;
	}

	private function verify_teacher($uid, $pass) {
		$user = $this->Teacher_model->get_teacher_by_email($uid);
		if ($user == null) {
			return false;
		}

		if (!password_verify($pass, $user["PASSWORD_HASH"])) {
			return false;
		}

		$this->session->set_userdata(array(
			"userid" => $user["ID"],
			"status" => "teacher",
			"status_id" => 2,
			"name" => $user["NAME"],
			"mail" => $user["EMAIL_CS"],
			"logged_in" => 1,
		));
		return true;
	}

	private function verify_employer($uid, $pass) {
		$user = $this->db->get_where("EMPLOYERS", array("PHONEHASH" => $uid))->row_array();
		if ($user == null) {
			return false;
		}

		if (!password_verify($pass, $user["PASSWORD_HASH"])) {
			return false;
		}

		$this->session->set_userdata(array(
			"userid" => $user["ID"],
			"status" => "employer",
			"status_id" => 3,
			"name" => $user["EMPLOYER_NAME"],
			"mail" => null,
			"logged_in" => 1,
		));
		return true;
	}

	function disconnect() {
		if ($this->session->userdata("ADMIN") != null) {
			$admin = $this->session->userdata("ADMIN");
			$user = $this->User_model->get_admin($admin);
			foreach($this->session->all_userdata() as $D => $V) {
				$this->session->unset_userdata($D);
			}
			$this->session->set_userdata(array(
				"userid" => $user["ID"],
				"status" => "admin",
				"status_id" => 0,
				"name" => $user["NAME"],
				"mail" => $user["EMAIL"],
				"logged_in" => 1,
			));
			redirect("/dashboard/index");
			return;
		}

		if (!file_exists("application/controllers/Azure.php")) {
			session_destroy();
			redirect("/user/login");
		} else {
			redirect("/azure/disconnect");
		}
	}

	function profile() {
		if (($this->input->post("PROGRAM_ID")) && (is_teacher())) {
			$params = array(
				'TEACHER_ID' => $this->session->userid,
				'PROGRAM_ID' => $this->input->post('PROGRAM_ID'),
			);

			$this->Teacher_model->add_program($params);
			redirect("/user/profile");
		}

		if (is_student()) {
			$data["typeid"] = 1;
			$data["user"] = $this->Student_model->get_student($this->session->userid);
			$data['type'] = "Élève de " . get_option_value("_SCHOOL_NAME");
		}

		if (is_teacher()) {
			$data["typeid"] = 2;
			$data["user"] = $this->Teacher_model->get_teacher($this->session->userid);
			$data['type'] = "Enseignant de '" . $this->Option_model->get_option(1)["VALUE"] . "'";
			$data["programs"] = $this->Teacher_model->get_teacher_programs($data["user"]["ID"]);
			$data["students"] = $this->Student_model->get_all_students_by_teacher_id($data["user"]["ID"]);

			$programs_id = array();
			foreach ($data["programs"] as $program) {
				array_push($programs_id, $program["ID"]);
			}

			$data["all_programs"] = $this->Teacher_model->get_teacher_programs_not($programs_id);
		}

		if (is_admin()) {
			$data["typeid"] = 0;
			$data["user"] = $this->User_model->get_admin($this->session->userid);
			$data["user"]["EMAIL_CS"] = $data["user"]["EMAIL"];
			$data['type'] = "Administrateur";
		}

		$this->load->model('Message_model');

		if (is_teacher()) {
			$data['all_messages'] = $this->Message_model->get_messages_for_user($this->session->userid, "2");
		}
		if (is_student()) {
			$data['all_messages'] = $this->Message_model->get_messages_for_user($this->session->userid, "1");
		}
		if (is_employer()) {
			$data['all_messages'] = $this->Message_model->get_messages_for_user($this->session->userid, "3");
		}

		$data['_view'] = 'user/profile';
		$this->load->view('layouts/main', $data);
	}

	function password() {
		$pass = $this->input->post("PASS");
		$confirm = $this->input->post("CONFIRM");
		if ($pass != $confirm) {
			redirect("/user/profile?pass=error");
			return;
		}

		$newPass = password_hash($pass, PASSWORD_BCRYPT);
		if (is_teacher()) {
			$this->Teacher_model->update_teacher($this->session->userid, array("PASSWORD_HASH" => $newPass));
		}
		if (is_student()) {
			$this->Student_model->update_student($this->session->userid, array("PASSWORD_HASH" => $newPass));
		}
		if (is_employer()) {
			$this->Employer_model->update_employer($this->session->userid, array("PASSWORD_HASH" => $newPass));
		}
		if (is_admin()) {
			$this->User_model->update_admin($this->session->userid, array("PASSWORD_HASH" => $newPass));
		}
		redirect("/user/profile");
	}

	function admin_index() {
		if (!is_admin()) {
			show_error("Vous n'avez pas la permission d'accéder a cette page");
			return;
		}

		$data["users"] = $this->User_model->get_all_admins();
		$data["_view"] = "user/admin_index";
		$this->load->view('layouts/main', $data);
	}

	function admin_add() {
		if (!is_admin()) {
			show_error("Vous n'avez pas la permission d'accéder a cette page");
			return;
		}

		$this->load->library('form_validation');

		$this->form_validation->set_rules('EMAIL', 'COURRIEL', 'valid_email|required');
		$this->form_validation->set_rules('NAME', 'NOM', 'required');
		$this->form_validation->set_rules('PASSWORD', 'MOT DE PASSE', 'required');

		if ($this->form_validation->run()) {
			$params = array(
				'NAME' => $this->input->post('NAME'),
				'EMAIL' => $this->input->post('EMAIL'),
				'PASSWORD_HASH' => password_hash($this->input->post('PASSWORD'), PASSWORD_BCRYPT),
			);

			$uid = $this->User_model->add_admin($params);
			redirect('user/admin_index');
		} else {
			$data["_view"] = "user/admin_add";
			$this->load->view('layouts/main', $data);
		}
	}

	function admin_edit($ID) {
		if (!is_admin()) {
			show_error("Vous n'avez pas la permission d'accéder a cette page");
			return;
		}

		$data["user"] = $this->User_model->get_admin($ID);

		if (isset($data['user']['ID'])) {
			$this->load->library('form_validation');

			$this->form_validation->set_rules('EMAIL', 'EMAIL', 'valid_email|required');
			$this->form_validation->set_rules('NAME', 'NOM', 'required');

			if ($this->form_validation->run()) {
				$params = array(
					'EMAIL' => $this->input->post('EMAIL'),
					'NAME' => $this->input->post('NAME'),
				);

				$this->User_model->update_admin($ID, $params);
				redirect('user/admin_index');
			} else {
				$data["_view"] = "user/admin_edit";
				$this->load->view('layouts/main', $data);
			}
		} else {
			show_error('The administrator you are trying to edit does not exist.');
		}
	}

	function admin_delete($ID) {
		if (!is_admin()) {
			show_error("Vous n'avez pas la permission d'accéder a cette page");
			return;
		}

		$this->User_model->delete_admin($ID);
		redirect("/user/admin_index");
	}

	function admin_password($ID) {
		if (!is_admin()) {
			show_error("Vous n'avez pas la permission d'accéder a cette page");
			return;
		}

		$pass = $this->input->post("PASS");
		$confirm = $this->input->post("CONFIRM");
		if ($pass != $confirm) {
			redirect("/user/admin_edit/$ID?pass=error");
			return;
		}

		$this->User_model->update_admin($ID, array("PASSWORD_HASH" => password_hash($pass, PASSWORD_BCRYPT)));
		redirect("/user/admin_edit/$ID");
	}
}
