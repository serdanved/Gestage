<?php defined('BASEPATH') or exit('No direct script access allowed');

function get_setting_value($name) {
	$CI = &get_instance();
	$CI->load->model('Setting_model');
	return $CI->Setting_model->get_setting($name);
}

function get_option_value($name) {
	$CI = &get_instance();
	$CI->load->model('Option_model');
	$opt = $CI->Option_model->get_option_by_name($name);
	if ($opt == null) {
		return null;
	} else {
		return $opt["VALUE"];
	}
}

function has_block_schedule($id) {
	$CI =& get_instance();
	$CI->load->model('Block_model');

	$schedule_count = $CI->Block_model->has_block_schedule($id);

	if ($schedule_count > 0) {
		return true;
	}
	return false;
}

function get_user_fullname_by_id_and_type($id, $type) {
	$CI =& get_instance();
	$CI->load->model('Teacher_model');
	$CI->load->model('Student_model');
	$CI->load->model('Employer_model');

	$name = "";
	if ($id == 0) {
		return "";
	}

	if ($type == 2) {
		$teacher = $CI->Teacher_model->get_teacher($id);
		$name = $teacher["NAME"];
	}

	if ($type == 1) {
		$student = $CI->Student_model->get_student($id);
		$name = $student["NAME"];
	}

	if ($type == 3) {
		$employer = $CI->Employer_model->get_employer($id);
		$name = $employer["EMPLOYER_NAME"];
	}

	return $name;
}

function email($from, $from_name = "Gestage", $to = "support@blitzmedia.io", $subject = "Test Courriel Gestage", $message = "Ceci est un message test pour smtp Gestage", $internship_id = "", $archor = "#vosobligations") {
	$CI =& get_instance();

	$email_body = file_get_contents(dirname(__FILE__) . "/../../resources/uploads/template/Notification.html");
	$email_body = str_replace("{SITE_URL}", site_url(), $email_body);
	$email_body = str_replace("{SCHOOL_NAME}", get_option_value("_SCHOOL_NAME"), $email_body);

	//SET MESSAGE SUBJECT
	$email_body = str_replace("{MESSAGE_SUBJECT}", $subject, $email_body);

	//SET MESSAGE DESCRIPTION
	$email_body = str_replace("{MESSAGE_DESCRIPTION}", $message, $email_body);

	//SET BTN
	if ($internship_id != '') {
		$email_body = str_replace("{MESSAGE_BTN_LINK}", site_url("/internship/edit/$internship_id") . $archor, $email_body);
		$email_body = str_replace("{MESSAGE_BTN_TITLE}", "Voir maintenant", $email_body);
	} else {
		$email_body = str_replace("{MESSAGE_BTN_TITLE}", "Connexion", $email_body);
		$email_body = str_replace("{MESSAGE_BTN_LINK}", site_url("/user/login"), $email_body);
	}

	if (!file_exists("application/controllers/Azure.php")) {
    	$config = array(
    		'protocol' => 'smtp',
    		'smtp_host' => get_option_value("_SMTP_HOST"),
    		'smtp_port' => get_option_value("_SMTP_PORT"),
    		'smtp_user' => get_option_value("_SMTP_USER"),
    		'smtp_pass' => get_option_value("_SMTP_PASS"),
    		'mailtype' => 'html',
    		'charset' => 'utf-8',
    	);

    	$CI->load->library('email');
    	$CI->email->initialize($config);
    	$CI->email->set_mailtype("html");
    	$CI->email->set_newline("\r\n");
    	$CI->email->set_crlf("\r\n");

    	$CI->email->to($to);
    	$CI->email->from($from, $from_name);
    	$CI->email->subject($subject);
    	$CI->email->message($email_body);

    	$CI->email->send();
    	//$data["result"] = $this->email->print_debugger();
	} else {
	    require_once "application/controllers/Azure.php";
	    graph_sendMail($from, [
	        "subject" => $subject,
	        "toRecipients" => [
	            ["name" => explode("@", $to)[0], "address" => $to],
            ],
            "ccRecipients" => [],
            "importance" => "normal",
            "body" => $email_body,
            "images" => [],
            "attachments" => [],
        ]);
	}
}

function get_letters_favorite() {
	$CI =& get_instance();
	$CI->load->model('Lettergenerator_model');
	$params = array("FAVORITE" => '1');
	$letters = $CI->Lettergenerator_model->get_letters_where($params);

	return $letters;
}

function is_user_logged() {
	$CI = &get_instance();
	return $CI->session->userdata("logged_in") == 1;
}

function get_current_user_status() {
	$CI = &get_instance();

	if (is_user_logged()) {
		return $CI->session->userdata("status");
	} else {
		return false;
	}
}

function is_current_user_having_program() {
	$CI = &get_instance();

	$program = $CI->Teacher_model->get_program_by_teacher_id($CI->session->userid);

	if ($program == null) {
		return false;
	}
	return true;
}

function is_student() {
	$CI = &get_instance();
	return $CI->session->status == 'student';
}

function is_teacher() {
	$CI = &get_instance();
	return $CI->session->status == 'teacher';
}

function is_employer() {
	$CI = &get_instance();
	return $CI->session->status == 'employer';
}

function is_admin() {
	$CI = &get_instance();
	return $CI->session->status == 'admin';
}

function get_current_user_name() {
	$CI = &get_instance();
	return $CI->session->userdata['name'];
}

function get_program_name_by_id($id) {
	$CI = &get_instance();

	if ($id > 0) {
		$program_name = $CI->program_model->get_program_name_by_id($id);
		return $program_name['NAME'];
	} else {
		return "";
	}
}

function get_programs_by_teacher_id($id) {
	$CI = &get_instance();

	$program_ids = $CI->Teacher_model->get_program_by_teacher_id($id);
	return $program_ids;
}

function get_programs_by_employer_id($id) {
	$CI = &get_instance();

	$program_ids = $CI->Employer_model->get_program_by_employer_id($id);
	return $program_ids;
}

function get_count_programs_by_employer_id($id) {
	$CI = &get_instance();

	$program_ids = $CI->Employer_model->get_count_program_by_employer_id($id);
	return $program_ids;
}

function get_teacher_name_by_id($id) {
	$CI = &get_instance();

	$teacher_name = $CI->Teacher_model->get_teacher_name_by_id($id);
	return $teacher_name['NAME'];
}

function get_teacher_email_by_id($id) {
	$CI = &get_instance();

	$teacher_name = $CI->Teacher_model->get_teacher_name_by_id($id);
	return $teacher_name['EMAIL_CS'];
}

function get_employer_name_by_id($id) {
	$CI = &get_instance();

	$employer_name = $CI->Employer_model->get_employer_name_by_id($id);
	return $employer_name['USERNAME'];
}

function get_employer_email_by_id($id) {
	$CI = &get_instance();

	$employer_name = $CI->Employer_model->get_employer_name_by_id($id);
	return $employer_name['USERNAME'];
}

function get_employer_contact_name_by_id($id) {
	$CI = &get_instance();

	$employer_name = $CI->Employer_model->get_employer_name_by_id($id);
	return $employer_name['CONTACT_NAME'];
}

function get_student_name_by_id($id) {
	$CI = &get_instance();

	$student_name = $CI->Student_model->get_student_name_by_id($id);
	return $student_name['NAME'];
}

function get_student_email_by_id($id) {
	$CI = &get_instance();

	$student_email = $CI->Student_model->get_student_name_by_id($id);
	return $student_email['EMAIL_CS'];
}

function get_student_name_by_internship_id($id) {
	$CI = &get_instance();

	$student_name = $CI->Student_model->get_student_name_by_internship_id($id);
	return $student_name['NAME'];
}

function get_student_id_by_internship_id($id) {
	$CI = &get_instance();

	$student_name = $CI->Student_model->get_student_id_by_internship_id($id);
	return $student_name['ID'];
}

function get_sender_name($id, $type) {
	$CI = &get_instance();

	$sender_name = $CI->Message_model->get_sender_name($id, $type);
	return $sender_name;
}

function get_internship_count_by_teacher($teacher_id, $flag) {
	$CI = &get_instance();
	$CI->load->model('Internship_model');
	$programids = explode(",", get_programs_by_teacher_id($teacher_id));

	switch ($flag) {
		case "SELF":
			$internship_count = $CI->Internship_model->get_internship_count_by_teacher($teacher_id, $programids, "SELF");
			break;
		case "PROGRAM":
			$internship_count = $CI->Internship_model->get_internship_count_by_teacher($teacher_id, $programids, "PROGRAM");
			break;
		case "TOTAL":
			$internship_count = $CI->Internship_model->get_internship_count_by_teacher($teacher_id, $programids, "TOTAL");
			break;
	}

	return $internship_count;
}

function get_internship_count_by_employer($employer_id, $flag) {
	$CI = &get_instance();
	$CI->load->model('Internship_model');
	$programids = explode(",", get_programs_by_employer_id($employer_id));

	switch ($flag) {
		case "SELF":
			$internship_count = $CI->Internship_model->get_internship_count_by_employer($employer_id, $programids, "SELF");
			break;
		case "PROGRAM":
			$internship_count = $CI->Internship_model->get_internship_count_by_employer($employer_id, $programids, "PROGRAM");
			break;
		case "TOTAL":
			$internship_count = $CI->Internship_model->get_internship_count_by_employer($employer_id, $programids, "TOTAL");
			break;
	}

	return $internship_count;
}

function get_internship_count_by_student($student_id, $program_id) {
	$CI = &get_instance();
	$CI->load->model('Internship_model');
	$internship_count = $CI->Internship_model->get_internship_count_by_student($student_id, $program_id);

	return $internship_count;
}

function get_student_count_by_teacher($teacher_id, $flag) {
	$CI = &get_instance();
	$CI->load->model('Student_model');
	$programids = explode(",", get_programs_by_teacher_id($teacher_id));

	switch ($flag) {
		case "SELF":
			$student_count = $CI->Student_model->get_all_student_by_teacher_id($teacher_id, $programids, "SELF");
			break;
		case "PROGRAM":
			$student_count = $CI->Student_model->get_all_student_by_teacher_id($teacher_id, $programids, "PROGRAM");
			break;
		case "TOTAL":
			$student_count = $CI->Student_model->get_all_student_by_teacher_id($teacher_id, $programids, "TOTAL");
			break;
	}

	return $student_count;
}

function get_student_count_by_employer($employer_id, $flag) {
	$CI = &get_instance();
	$CI->load->model('Student_model');
	$programids = explode(",", get_programs_by_employer_id($employer_id));

	switch ($flag) {
		case "SELF":
			$student_count = $CI->Student_model->get_all_student_by_employer_id($employer_id, $programids, "SELF");
			break;
		case "PROGRAM":
			$student_count = $CI->Student_model->get_all_student_by_employer_id($employer_id, $programids, "PROGRAM");
			break;
		case "TOTAL":
			$student_count = $CI->Student_model->get_all_student_by_employer_id($employer_id, $programids, "TOTAL");
			break;
	}

	return $student_count;
}

function get_messages_unread_by_teacher($teacher_id) {
	$CI = &get_instance();
	$CI->load->model('Message_model');
	$messages = $CI->Message_model->get_messages_unread_by_teacher($teacher_id);
	return $messages;
}

function get_messages_unread_by_employer($employer_id) {
	$CI = &get_instance();
	$CI->load->model('Message_model');
	$messages = $CI->Message_model->get_messages_unread_by_employer($employer_id);
	return $messages;
}

function get_messages_unread_by_student($student_id) {
	$CI = &get_instance();
	$CI->load->model('Message_model');
	$messages = $CI->Message_model->get_messages_unread_by_student($student_id);
	return $messages;
}

function get_obligations_unopen_by_teacher($teacher_id) {
	$CI = &get_instance();
	$CI->load->model('Obligation_model');
	$obligations = $CI->Obligation_model->get_obligations_unopen_by_teacher($teacher_id);
	return $obligations;
}

function get_obligations_unopen_by_employer($employer_id) {
	$CI = &get_instance();
	$CI->load->model('Obligation_model');
	$obligations = $CI->Obligation_model->get_obligations_unopen_by_employer($employer_id);
	return $obligations;
}

function get_obligations_unopen_by_student($student_id) {
	$CI = &get_instance();
	$CI->load->model('Obligation_model');
	$obligations = $CI->Obligation_model->get_obligations_unopen_by_student($student_id);
	return $obligations;
}

function get_uploader_name($id, $type) {
	$CI = &get_instance();

	$uploader_name = $CI->Document_model->get_uploader_data($id, $type);
	if (isset($uploader_name->NAME)) {
		return $uploader_name->NAME;
	} else {
		return $uploader_name->EMPLOYER_NAME;
	}
}

function get_obligation_user_name($id, $type) {
	$CI = &get_instance();
	$CI->load->model('Obligation_model');

	$user_name = $CI->Obligation_model->get_obligation_user($id, $type);

	if (isset($user_name->NAME)) {
		return $user_name->NAME;
	} else {
		return "";
	}
}

function get_notes_user_name($id, $type) {
	$CI = &get_instance();
	$CI->load->model('Note_model');

	$user_name = $CI->Note_model->get_note_user($id, $type);

	if (isset($user_name->NAME)) {
		return $user_name->NAME;
	} else {
		return $user_name->EMPLOYER_NAME;
	}
}

function get_blocks_by_internship_id($id) {
	$CI = &get_instance();

	$blocks = $CI->Block_model->get_all_blocks_where(array("INTERNSHIP_ID" => $id));

	return $blocks;
}

function get_document_name($id) {
	$CI = &get_instance();

	$document_name = $CI->Document_model->get_document($id);
	return $document_name['NAME'];
}

function get_document_form_id($id) {
	$CI = &get_instance();

	$document = $CI->Document_model->get_document($id);
	return $document['FORM_ID'];
}

function get_document_filename($id) {
	$CI = &get_instance();

	$document_name = $CI->Document_model->get_document($id);
	//die(var_dump($document_name));
	if ($document_name == null) {
		return "";
	} else {
		return $document_name['FILENAME'];
	}
}

//FORMAT DATE TO FRENCH FORMAT "LUNDI 5 FÉVRIER 2018"
function date_in_french($date) {
	$week_name = array("Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi");
	$month_name = array("", "Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août",
		"Septembre", "Octobre", "Novembre", "Décembre");

	$split = preg_split('/-/', $date);
	$year = $split[0];
	$month = round($split[1]);
	$day = round($split[2]);

	$week_day = date("w", mktime(12, 0, 0, $month, $day, $year));
	return $date_fr = $week_name[$week_day] . ' ' . $day . ' ' . $month_name[$month] . ' ' . $year;
}

//GET COUNT OF INTERNSHIPS FOR AN EMPLOYER
function get_employer_internship_count($employer_id) {
	$CI =& get_instance();
	$CI->load->model('Employer_model');
	$value = "";

	if ($value = $CI->Employer_model->get_employer_internship_count($employer_id)) {
		echo $value;
	}
}

//FORMAT PHONE NUMBER TO XXX-XXX-XXXX
function format_phone_number($phone_number) {
	$data = $phone_number;
	if (preg_match('/(\d{3})(\d{3})(\d{4})$/', $data, $matches)) {
		$result = $matches[1] . '-' . $matches[2] . '-' . $matches[3];
		return $result;
	}

	return null;
}

//PRINT UPLOADER ANYWHERE ON A PAGE
function print_upload($internship_id = null) {
	//CHECK IF USER SUBMIT INTERNSHIP ID
	if ($internship_id !== null) {
		$html = "<div class=\"row\">";
		$html .= "<div style=\"margin-left:15%;margin-bottom:5px;\">";
		$html .= "<label  style=\"margin-right:2%;\">PERMISSIONS:</label>";
		$html .= "<label class=\"checkbox-inline\">";
		$html .= "<input CHECKED name=\"ck_CANSEE_EMPLOYERS\" type=\"checkbox\">EMPLOYEURS";
		$html .= "</label>";
		$html .= "<label class=\"checkbox-inline\">";
		$html .= "<input CHECKED name=\"ck_CANSEE_STUDENTS\" type=\"checkbox\">ÉLÈVES";
		$html .= "</label>";
		$html .= "<label class=\"checkbox-inline\">";
		$html .= "<input CHECKED name=\"ck_CANSEE_TEACHERS\" type=\"checkbox\" >ENSEIGNANTS";
		$html .= "</label>";
		$html .= "</div>";
		$html .= "</div>";

		$html .= "<div class=\"row\">";
		$html .= "<div id=\"fine-uploader-manual-trigger\"></div>";
		$html .= "</div>";

		$html .= "<div class=\"row\">";
		$html .= "<div style=\"margin-left:15%;margin-bottom:5px;\">";
		$html .= "<label  style=\"margin-right:2%;\">OBLIGATIONS:</label>";
		$html .= "<label class=\"checkbox-inline\">";
		$html .= "<input name=\"ck_OBLIGATION_EMPLOYERS\" type=\"checkbox\">EMPLOYEURS";
		$html .= "</label>";
		$html .= "<label class=\"checkbox-inline\">";
		$html .= "<input name=\"ck_OBLIGATION_STUDENTS\" type=\"checkbox\">ÉLÈVES";
		$html .= "</label>";
		$html .= "<label class=\"checkbox-inline\">";
		$html .= "<input name=\"ck_OBLIGATION_TEACHERS\" type=\"checkbox\" >ENSEIGNANTS";
		$html .= "</label>";
		$html .= "</div>";
		$html .= "</div>";
		$html .= form_hidden('internship_id', $internship_id);

		return $html;
	}

	return null;
}

//WHEN WE ADD A NEW UPLOAD, ADD THE ENTRY WITH PERMISSIONS
function insert_upload_entry($internship_id, $source_path, $cansee_student, $cansee_teacher, $cansee_employer, $block_id = 0, $form_id = 0, $letter_id = 0) {
	$CI = &get_instance();
	$CI->load->library('session');
	$CI->load->model('Document_model');

	//SET VARIABLES, FAIL IF ONE IS NULL
	if ($source_path !== null || $internship_id !== null) {
		if ($form_id != 0) {
			$file_full_name = "";
			$file_name = $source_path;
		} else {
			$file_full_name = pathinfo($source_path, PATHINFO_BASENAME);
			$file_name = pathinfo($source_path, PATHINFO_FILENAME);
		}

		$params_documents = array(
			'UPLOADER_USERID' => $CI->session->userdata('userid'),
			'UPLOADER_TYPEID' => $CI->session->userdata('status_id'),
			'INTERNSHIP_ID' => $internship_id,
			'BLOCK_ID' => $block_id,
			'NAME' => $file_name,
			'FILENAME' => $file_full_name,
			'CANSEE_STUDENT' => $cansee_student,
			'CANSEE_TEACHER' => $cansee_teacher,
			'CANSEE_EMPLOYER' => $cansee_employer,
			'DATE' => date('Y-m-d'),
			'FORM_ID' => $form_id,
			'letter_id' => $letter_id,
		);

		$document_id = $CI->Document_model->add_document($params_documents);

		return $document_id;
	}

	return "";
}

//INSERT AN OBLIGATION FOR A DOCUMENT
function insert_obligations_entry($internship_id, $document_id, $obligation_student, $obligation_teacher, $obligation_employer, $add_obligation_signature_student = 0, $add_obligation_signature_teacher = 0, $add_obligation_signature_employer = 0, $form_data = "") {
	$CI = &get_instance();
	$CI->load->library('session');
	$CI->load->model('Obligation_model');
	$CI->load->model('Internship_model');

	if ($document_id !== null || $internship_id !== null) {
		$internship_data = $CI->Internship_model->get_internship($internship_id);
		$params_obligations = array(
			'INTERNSHIP_ID' => $internship_id,
			'DATE' => date('Y-m-d H:i:s'),
			'DOCUMENT_ID' => $document_id,
			'STATUS' => 0,);

		if ($obligation_student == 1) {
			$params_obligations["USER_ID"] = $internship_data["STUDENT_ID"];
			$params_obligations["USER_TYPE"] = 1;
			$params_obligations["SIGNATURE"] = $add_obligation_signature_student;
			$params_obligations["FORM_DATA"] = $form_data;
			$CI->Obligation_model->add_obligation($params_obligations);

			//SEND MESSAGE
			$to_email = get_student_email_by_id($internship_data["STUDENT_ID"]);
			email(get_option_value("_SMTP_FROM"), "Gestage", $to_email, "Gestage | Nouvelle Obligation", "Vous avez reçu une nouvelle obligation pour votre stage.", $internship_id, "#vosobligations");
		}
		if ($obligation_teacher == 1) {
			$params_obligations["USER_ID"] = $internship_data["TEACHER_ID"];
			$params_obligations["USER_TYPE"] = 2;
			$params_obligations["SIGNATURE"] = $add_obligation_signature_teacher;
			$params_obligations["FORM_DATA"] = $form_data;
			$CI->Obligation_model->add_obligation($params_obligations);

			//SEND MESSAGE
			$to_email = get_teacher_email_by_id($internship_data["TEACHER_ID"]);
			email(get_option_value("_SMTP_FROM"), "Gestage", $to_email, "Gestage | Nouvelle Obligation", "Vous avez reçu une nouvelle obligation pour votre stage.", $internship_id, "#vosobligations");
		}

		if ($obligation_employer == 1) {
			$params_obligations["USER_ID"] = $internship_data["EMPLOYER_ID"];
			$params_obligations["USER_TYPE"] = 3;
			$params_obligations["SIGNATURE"] = $add_obligation_signature_employer;
			$params_obligations["FORM_DATA"] = $form_data;
			$CI->Obligation_model->add_obligation($params_obligations);

			//SEND MESSAGE
			$to_email = get_employer_email_by_id($internship_data["EMPLOYER_ID"]);
			email(get_option_value("_SMTP_FROM"), "Gestage", $to_email, "Gestage | Nouvelle Obligation", "Vous avez reçu une nouvelle obligation pour votre stage.", $internship_id, "#vosobligations");
		}
	}
}

//FUNCTION USED TO MOVE FILED FROM X TO CORRECT INTERNSHIP FOLDER WHEN ALREADY UPLOADER
function move_file($internship_id, $source_path) {
	//CHECK IF USER SENT US SOURCE PATH AND INTERNSHIP ID FOR COPY
	if ($source_path !== null || $internship_id !== null) {
		$file_full_name = pathinfo($source_path, PATHINFO_BASENAME);
		$destination_path = "resources/uploads/$internship_id/$file_full_name";

		//CHECK IF SOURCE EXISTS
		if (!file_exists($source_path)) {
			die("SOURCE DOESN'T EXIST");
		}

		//COPY THE FILE TO THE NEW DESTINATION ELSE RETURN ERROR
		if (!copy($source_path, $destination_path)) {
			die("UNABLE TO COPY THE FILE");
		}

		//DELETE THE OLD FILE
		if (!unlink($source_path)) {
			die("UNABLE TO DELETE THE OLD FILE");
		}

		return true;
	}

	return false;
}

//FORMAT ELAPSED TIME WITH DATETIME
function time_elapsed_string($datetime, $full = false) {
	$now = new DateTime;
	$ago = new DateTime($datetime);
	$diff = $now->diff($ago);

	$diff->w = floor($diff->d / 7);
	$diff->d -= $diff->w * 7;

	$string = array(
		'y' => 'année',
		'm' => 'mois',
		'w' => 'semaine',
		'd' => 'jour',
		'h' => 'heure',
		'i' => 'minute',
		's' => 'seconde',
	);
	foreach ($string as $k => &$v) {
		if ($diff->$k) {
			$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
		} else {
			unset($string[$k]);
		}
	}

	if (!$full) {
		$string = array_slice($string, 0, 1);
	}
	return $string ? 'Il y a ' . implode(', ', $string) : "À l'instant";
}

function generateRandomString($length = 10) {
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, $charactersLength - 1)];
	}
	return $randomString;
}