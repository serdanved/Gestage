<?php /*
 * Generated by CRUDigniter v3.2
 * www.crudigniter.com
 */

class Log_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	/*
	 * Get log by ID
	 */
	function get_log($ID) {
		return $this->db->get_where('LOGS', array('ID' => $ID))->row_array();
	}

	/*
	 * Get all logs
	 */
	function get_all_logs() {
		$this->db->order_by('ID', 'desc');
		return $this->db->get('LOGS')->result_array();
	}

	/*
	 * function to add new log
	 */
	function add_log($params) {
		$this->db->insert('LOGS', $params);
		return $this->db->insert_id();
	}

	/*
	 * function to update log
	 */
	function update_log($ID, $params) {
		$this->db->where('ID', $ID);
		return $this->db->update('LOGS', $params);
	}

	/*
	 * function to delete log
	 */
	function delete_log($ID) {
		return $this->db->delete('LOGS', array('ID' => $ID));
	}
}
