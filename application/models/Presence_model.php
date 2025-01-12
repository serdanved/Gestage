<?php /*
 * Generated by CRUDigniter v3.2
 * www.crudigniter.com
 */

class Presence_model extends CI_Model {
	function __construct() {
		parent::__construct();

	}

	/*
	 * Get message by ID
	 */
	function get_presence($ID) {
		return $this->db->get_where('PRESENCES', array('ID' => $ID))->row_array();
	}

	/*
	 * Get all messages
	 */
	function get_all_presences() {
		$this->db->order_by('ID', 'desc');
		return $this->db->get('PRESENCES')->result_array();
	}

	/*
	 * function to add new message
	 */
	function add_presence($params) {
		$this->db->insert('PRESENCES', $params);
		return $this->db->insert_id();
	}

	/*
	 * function to update message
	 */
	function update_presence($ID, $params) {
		$this->db->where('ID', $ID);
		return $this->db->update('PRESENCES', $params);
	}

	/*
	 * function to delete message
	 */
	function delete_presence($ID) {
		return $this->db->delete('PRESENCES', array('ID' => $ID));
	}
}
