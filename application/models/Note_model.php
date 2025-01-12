<?php /*
 * Generated by CRUDigniter v3.2
 * www.crudigniter.com
 */

class Note_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	function get_all_notes_by_internship($INTERNSHIP_ID) {
		$this->db->order_by('ID', 'asc');
		return $this->db->get_where('NOTES', array('INTERNSHIP_ID' => $INTERNSHIP_ID))->result_array();
	}

	/*
	 * Get note by ID
	 */
	function get_note($ID) {
		return $this->db->get_where('NOTES', array('ID' => $ID))->row_array();
	}

	/*
	 * Get all notes
	 */
	function get_all_notes($params) {
		$this->db->order_by('ID', 'desc');
		return $this->db->get('NOTES')->result_array();
	}

	/*
	 * Get all notes
	 */
	function get_all_notes_where($params) {
		$this->db->order_by('ID', 'desc');
		return $this->db->get_where('NOTES', $params)->result_array();
	}

	/*
	 * function to add new note
	 */
	function add_note($params) {
		$this->db->insert('NOTES', $params);
		return $this->db->insert_id();
	}

	/*
	 * function to update note
	 */
	function update_note($ID, $params) {
		$this->db->where('ID', $ID);
		return $this->db->update('NOTES', $params);
	}

	/*
	 * function to delete note
	 */
	function delete_note($ID) {
		return $this->db->delete('NOTES', array('ID' => $ID));
	}

	function get_note_user($ID, $TYPE) {
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
