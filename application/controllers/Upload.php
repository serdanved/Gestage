<?php class Upload extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('Internship_model');
		$this->load->model('Document_model');
		$this->load->model('Internship_model');
		$this->load->model('Obligation_model');
	}

	//FUNCTION USED TO UPLOAD WITH FINE UPLOADER PLUGIN
	public function file_upload() {
		// LOAD CUSTOM LIB "UPLOADHANDLER AND SET INPUT NAME TO QQFILE"
		$this->load->library('uploadhandler');
		$uploader = new Uploadhandler();
		$uploader->inputName = "qqfile";

		//CHECK INPUT METHOD TO MAKE SURE USER IS SENDING A FILE
		if ($this->input->method() == "post") {
			//UPLOAD FILE IN FOLDER
			$result = $uploader->handleUpload("resources/uploads", $this->input->post('internship_id'));

			//INSERT ENTRY IN DATABASE DOCUMENTS IF UPLOAD SUCCESS
			if (isset($result['success'])) {
				$file_name = $result['name'];
				$internship_id = $this->input->post('internship_id');

				//INSERT DOCUMENT IN DB
				$document_id = insert_upload_entry($internship_id, "resources/$internship_id/$file_name", $this->input->post('ck_cansee_students'), $this->input->post('ck_cansee_teachers'), $this->input->post('ck_cansee_employers'));

				//INSERT OBLIGATION IN DB
				insert_obligations_entry($internship_id, $document_id, $this->input->post('ck_obligation_students'), $this->input->post('ck_obligation_teachers'), $this->input->post('ck_obligation_employers'));

				// var_dump(array('success' => true));
				//$result['success']);
				echo json_encode(array('success' => true));
			} else {
				echo json_encode($result);
			}
		}
	}

	public function tiny_upload() {
        $this->load->library('upload', [
            "upload_path" => "./resources/uploads/",
            "allowed_types" => "jpg|jpeg|png|webp|gif",
            "file_ext_tolower" => true,
            "encrypt_name" => true,
        ]);

        if ($this->upload->do_upload('file')) {
            echo json_encode([
                "location" => site_url("resources/uploads/" . $this->upload->data('file_name')),
            ]);
        } else {
            header("HTTP/1.1 500 Server Error");
        }
	}
}
