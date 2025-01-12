<?php
/*
 * Generated by CRUDigniter v3.2
 * www.crudigniter.com
 */

class Document extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('Internship_model');
		$this->load->model('Document_model');
		$this->load->model('Obligation_model');
	}

	/*
	 * Listing of documents
	 */
	function index() {
		$data['documents'] = $this->Document_model->get_all_documents();

		$data['_view'] = 'document/index';
		$this->load->view('layouts/main', $data);
	}

	/*
	 * Adding a new document
	 */
	function add() {
		if (isset($_POST) && count($_POST) > 0) {
			$params = array(
				'TYPE_ID' => $this->input->post('TYPE_ID'),
				'INTERNSHIP_ID' => $this->input->post('INTERNSHIP_ID'),
				'NAME' => $this->input->post('NAME'),
				'FILENAME' => $this->input->post('FILENAME'),
			);

			$document_id = $this->Document_model->add_document($params);
			redirect('document/index');
		} else {
			$this->load->model('Document_type_model');
			$data['all_document_types'] = $this->Document_type_model->get_all_document_types();

			$this->load->model('Internship_model');
			$data['all_internships'] = $this->Internship_model->get_all_internships();

			$data['_view'] = 'document/add';
			$this->load->view('layouts/main', $data);
		}
	}

	/*
	 * Editing a document
	 */
	function edit($ID) {
		// check if the document exists before trying to edit it
		$data['document'] = $this->Document_model->get_document($ID);

		if (isset($data['document']['ID'])) {
			if (isset($_POST) && count($_POST) > 0) {
				$params = array(
					'TYPE_ID' => $this->input->post('TYPE_ID'),
					'INTERNSHIP_ID' => $this->input->post('INTERNSHIP_ID'),
					'NAME' => $this->input->post('NAME'),
					'FILENAME' => $this->input->post('FILENAME'),
				);

				$this->Document_model->update_document($ID, $params);
				redirect('document/index');
			} else {
				$this->load->model('Document_type_model');
				$data['all_document_types'] = $this->Document_type_model->get_all_document_types();

				$this->load->model('Internship_model');
				$data['all_internships'] = $this->Internship_model->get_all_internships();

				$data['_view'] = 'document/edit';
				$this->load->view('layouts/main', $data);
			}
		} else {
			show_error('The document you are trying to edit does not exist.');
		}
	}

	/*
	 * Deleting document
	 */
	function remove($ID) {
		$document = $this->Document_model->get_document($ID);

		// check if the document exists before trying to delete it
		if (isset($document['ID'])) {
			$this->Document_model->delete_document($ID);
			redirect('document/index');
		} else {
			show_error('The document you are trying to delete does not exist.');
		}
	}

	function remove_document() {
		$document = $this->Document_model->get_document($this->input->post("document_id"));
		// check if the document exists before trying to delete it
		if (isset($document['ID'])) {
			$this->Document_model->delete_document($document['ID']);
		}

		//CHECK FOR OBLIGATIONS WITH THE DOCUMENT
		$obligations = $this->Obligation_model->get_obligations_by_document_id($this->input->post("document_id"));
		foreach ($obligations as $ob) {
			$this->Obligation_model->delete_obligation($ob['ID']);
		}

		echo "DONE";
	}

	function adobe_test($upload = false) {
		$config['upload_path'] = __DIR__ . '/../../resources/';
		$config['allowed_types'] = 'pdf';
		$config['overwrite'] = true;
		$this->load->library('upload', $config);

		if ($upload == true) {
			if (!$this->upload->do_upload('pdfFile')) {
				echo $this->upload->display_errors();
			} else {
				echo "UPLOADED";
			}
		} else {
			$data["filename"] = "ENTRETIEN_AUTOMNAL.pdf";
			$data["url"] = site_url("resources/ENTRETIEN_AUTOMNAL.pdf");
			$this->load->view('document/adobe_test', $data);
		}
	}
}
