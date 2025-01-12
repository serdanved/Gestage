<?php /*
 * Generated by CRUDigniter v3.2
 * www.crudigniter.com
 */

class Obligation_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	/*
	 * Get obligation by ID
	 */
	function get_obligation($ID) {
		return $this->db->get_where('OBLIGATIONS', array('ID' => $ID))->row_array();
	}

	function get_obligations_by_document_id($ID) {
		return $this->db->get_where('OBLIGATIONS', array('DOCUMENT_ID' => $ID))->result_array();
	}

	function get_obligations_unopen_by_teacher($TEACHER_ID) {
		$this->db->from('OBLIGATIONS');
		$this->db->where('OBLIGATIONS.USER_ID', $TEACHER_ID);
		$this->db->where('OBLIGATIONS.USER_TYPE', 2);
		$this->db->where('OBLIGATIONS.STATUS', 0);
		return $this->db->get()->result_array();
	}

	function get_obligations_unopen_by_employer($EMPLOYER_ID) {
		$this->db->from('OBLIGATIONS');
		$this->db->where('OBLIGATIONS.USER_ID', $EMPLOYER_ID);
		$this->db->where('OBLIGATIONS.USER_TYPE', 3);
		$this->db->where('OBLIGATIONS.STATUS', 0);
		return $this->db->get()->result_array();
	}

	function get_obligations_unopen_by_student($STUDENT_ID) {
		$this->db->from('OBLIGATIONS');
		$this->db->where('OBLIGATIONS.USER_ID', $STUDENT_ID);
		$this->db->where('OBLIGATIONS.USER_TYPE', 1);
		$this->db->where('OBLIGATIONS.STATUS', 0);
		return $this->db->get()->result_array();
	}

	function get_obligation_signature_by_document_student($document_id) {
		$this->db->from('OBLIGATIONS');
		$this->db->where('OBLIGATIONS.USER_TYPE', 1);
		$this->db->where('OBLIGATIONS.DOCUMENT_ID', $document_id);
		$this->db->where('OBLIGATIONS.SIGNATURE !=', "null");
		$this->db->where('OBLIGATIONS.SIGNATURE !=', "1");
		$this->db->where('OBLIGATIONS.SIGNATURE !=', "0");

		$signature_row = $this->db->get()->row();

		if (isset($signature_row)) {
			return $signature_row->SIGNATURE;
		} else {
			return "";
		}
	}

	function get_obligation_signature_by_document_teacher($document_id) {
		$this->db->from('OBLIGATIONS');
		$this->db->where('OBLIGATIONS.USER_TYPE', 2);
		$this->db->where('OBLIGATIONS.DOCUMENT_ID', $document_id);
		$this->db->where('OBLIGATIONS.SIGNATURE !=', "null");
		$this->db->where('OBLIGATIONS.SIGNATURE !=', "1");
		$this->db->where('OBLIGATIONS.SIGNATURE !=', "0");

		$signature_row = $this->db->get()->row();

		if (isset($signature_row)) {
			return $signature_row->SIGNATURE;
		} else {
			return "";
		}
	}

	function get_obligation_signature_by_document_employer($document_id) {
		$this->db->from('OBLIGATIONS');
		$this->db->where('OBLIGATIONS.USER_TYPE', 3);
		$this->db->where('OBLIGATIONS.DOCUMENT_ID', $document_id);
		$this->db->where('OBLIGATIONS.SIGNATURE !=', "null");
		$this->db->where('OBLIGATIONS.SIGNATURE !=', "1");
		$this->db->where('OBLIGATIONS.SIGNATURE !=', "0");

		$signature_row = $this->db->get()->row();

		if (isset($signature_row)) {
			return $signature_row->SIGNATURE;
		} else {
			return "";
		}
	}

	/*
	 * Get all obligations
	 */
	function get_all_obligations() {
		$this->db->order_by('ID', 'desc');
		return $this->db->get('OBLIGATIONS')->result_array();
	}

	function get_all_obligations_where($params) {
		$this->db->order_by('ID', 'desc');
		return $this->db->get_where('OBLIGATIONS', $params)->result_array();
	}

	/*
	 * function to add new obligation
	 */
	function add_obligation($params) {
		$this->db->insert('OBLIGATIONS', $params);
		return $this->db->insert_id();
	}

	/*
	 * function to update obligation
	 */
	function update_obligation($ID, $params) {
		$this->db->where('ID', $ID);
		return $this->db->update('OBLIGATIONS', $params);
	}

	/*
	 * function to delete obligation
	 */
	function delete_obligation($ID) {
		return $this->db->delete('OBLIGATIONS', array('ID' => $ID));
	}

	function get_all_obligations_by_internship($INTERNSHIP_ID) {
		$this->db->order_by('ID', 'asc');
		return $this->db->get_where('OBLIGATIONS', array('INTERNSHIP_ID' => $INTERNSHIP_ID))->result_array();
	}

	function get_obligation_user($ID, $TYPE) {
		$table = "";

		switch ($TYPE) {
			case 1:
				$table = "STUDENTS";
				break;
			case 2:
				$table = "TEACHERS";
				break;
			case 3:
				$table = "EMPLOYERS";
				break;
		}

		return $this->db->get_where($table, array('ID' => $ID))->row();
	}
}
