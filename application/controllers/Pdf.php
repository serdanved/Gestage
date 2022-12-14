<?php

class Pdf extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this->error = null;
		$this->load->model("Program_model");
		$this->load->model("Pdf_model");
		$this->load->library('upload');
	}

	function index() {
		if (!is_admin()) {
			redirect("/");
		}

		if ($this->error != null) {
			$data["error"] = $this->error;
		}

		$data["progs"] = $this->Program_model->get_all_programs();
		$data['_view'] = 'pdf/index';
		$this->load->view('layouts/main', $data);
		$this->error = null;
	}

	function add() {
		$progId = $this->input->post("programme");

		if ($_FILES["fileTeacher"]["name"] != null) {
			$name = $this->input->post("nameTeacher");
			if ($name == null) {
				$this->error = "<p>Vous devez spécifier un nom pour 'Enseignant'</p>";
				return $this->index();
			} else {
				if ($ret = $this->doupload($progId, "fileTeacher", $name) != "OK") {
					$this->error = "<p><b>Ensignant:</b> $ret</p>";
					return $this->index();
				}
			}
		}

		if ($_FILES["fileEmployer"]["name"] != null) {
			$name = $this->input->post("nameEmployer");
			if ($name == null) {
				$this->error = "<p>Vous devez spécifier un nom pour 'Employeur'</p>";
				return $this->index();
			} else {
				if ($ret = $this->doupload($progId, "fileEmployer", $name) != "OK") {
					$this->error = "<p><b>Ensignant:</b> $ret</p>";
					return $this->index();
				}
			}
		}

		if ($_FILES["fileStudent"]["name"] != null) {
			$name = $this->input->post("nameStudent");
			if ($name == null) {
				$this->error = "<p>Vous devez spécifier un nom pour 'Étudiant'</p>";
				return $this->index();
			} else {
				if ($ret = $this->doupload($progId, "fileStudent", $name) != "OK") {
					$this->error = "<p><b>Ensignant:</b> $ret</p>";
					return $this->index();
				}
			}
		}

		redirect("/pdf/index");
	}

	function add_pdf_stage($stageId) {
		$name = $this->input->post("NAME");
		$type = $this->input->post("TYPE");
		$docId = $this->Pdf_model->add_stage_pdf(array(
			"STAGE_ID" => $stageId,
			"NAME" => $name,
			"TYPE" => $type,
		));

		$config['upload_path'] = __DIR__ . '/../../resources/documents/' . $stageId;
		$config['allowed_types'] = 'pdf';
		$config['overwrite'] = true;
		$config['file_name'] = "$docId.pdf";

		if (!file_exists($config['upload_path'])) {
			mkdir($config['upload_path'], 0777, true);
		}

		$this->upload->initialize($config);
		if (!$this->upload->do_upload("FILE")) {
			$this->Pdf_model->delete_stage_pdf($docId);
			die("<script>alert('Une erreur est survenu : " . $this->upload->display_errors("", "") . "'); window.location = '" . site_url("/internship/edit/$stageId") . "';)");
		}

		redirect("/internship/edit/$stageId");
	}

	function add_stage($stageId) {
		$name = $this->input->post("NAME");
		$type = $this->input->post("TYPE");
		$docIf = $this->Pdf_model->add_stage_pdf(array(
			"STAGE_ID" => $stageId,
			"NAME" => $name,
			"TYPE" => $type,
		));

		redirect("/internship/edit/$stageId");
	}

	function delete($id) {
		$path = __DIR__ . '/../../resources/documents/' . $id . '.pdf';
		if (file_exists($path)) {
			unlink($path);
			$this->Pdf_model->delete_pdf($id);
		}
		redirect("/pdf/index");
	}

	function delete_stage_pdf($stageId, $docId) {
		$path = __DIR__ . '/../../resources/documents/' . $stageId . '/' . $docId . '.pdf';
		if (file_exists($path)) {
			unlink($path);
			$this->Pdf_model->delete_stage_pdf($docId);
		}
		redirect("/internship/edit/$stageId");
	}

	function viewer($stageId, $docId, $save = false) {
		$config['upload_path'] = __DIR__ . '/../../resources/documents/' . $stageId;
		$config['allowed_types'] = 'pdf';
		$config['overwrite'] = true;
		$config['file_name'] = "$docId.pdf";
		$this->upload->initialize($config);

		$data["doc"] = $this->Pdf_model->get_stage_pdf($docId);
		$data["file"] = "/resources/documents/$stageId/$docId.pdf";

		if ($save == true) {
			if (!$this->upload->do_upload('pdfFile')) {
				echo $this->upload->display_errors();
			} else {
				echo "UPLOADED";
			}
		} else {
			$this->load->view('pdf/viewer', $data);
		}
	}

	private function doupload($progId, $field, $name) {
		$docId = $this->Pdf_model->add_pdf(array(
			"PROG_ID" => $progId,
			"NAME" => $name,
			"TYPE" => $field,
		));

		$config['upload_path'] = __DIR__ . '/../../resources/documents';
		$config['allowed_types'] = 'pdf';
		$config['overwrite'] = true;
		$config['file_name'] = "$docId.pdf";

		if (!file_exists($config['upload_path'])) {
			mkdir($config['upload_path'], 0777, true);
		}

		$this->upload->initialize($config);
		if ($this->upload->do_upload($field)) {
			return "OK";
		} else {
			$this->Pdf_model->delete_pdf($docId);
			return $this->upload->display_errors("", "");
		}
	}
}
