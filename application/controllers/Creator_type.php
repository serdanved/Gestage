<?php /*
 * Generated by CRUDigniter v3.2
 * www.crudigniter.com
 */

class Creator_type extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('Internship_model');
		$this->load->model('Creator_type_model');
	}

	/*
	 * Listing of creator_types
	 */
	function index() {
		$data['creator_types'] = $this->Creator_type_model->get_all_creator_types();

		$data['_view'] = 'creator_type/index';
		$this->load->view('layouts/main', $data);
	}

	/*
	 * Adding a new creator_type
	 */
	function add() {
		if (isset($_POST) && count($_POST) > 0) {
			$params = array(
				'NAME' => $this->input->post('NAME'),
			);

			$creator_type_id = $this->Creator_type_model->add_creator_type($params);
			redirect('creator_type/index');
		} else {
			$data['_view'] = 'creator_type/add';
			$this->load->view('layouts/main', $data);
		}
	}

	/*
	 * Editing a creator_type
	 */
	function edit($ID) {
		// check if the creator_type exists before trying to edit it
		$data['creator_type'] = $this->Creator_type_model->get_creator_type($ID);

		if (isset($data['creator_type']['ID'])) {
			if (isset($_POST) && count($_POST) > 0) {
				$params = array(
					'NAME' => $this->input->post('NAME'),
				);

				$this->Creator_type_model->update_creator_type($ID, $params);
				redirect('creator_type/index');
			} else {
				$data['_view'] = 'creator_type/edit';
				$this->load->view('layouts/main', $data);
			}
		} else {
			show_error('The creator_type you are trying to edit does not exist.');
		}
	}

	/*
	 * Deleting creator_type
	 */
	function remove($ID) {
		$creator_type = $this->Creator_type_model->get_creator_type($ID);

		// check if the creator_type exists before trying to delete it
		if (isset($creator_type['ID'])) {
			$this->Creator_type_model->delete_creator_type($ID);
			redirect('creator_type/index');
		} else {
			show_error('The creator_type you are trying to delete does not exist.');
		}
	}
}
