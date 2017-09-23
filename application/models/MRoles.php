<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MRoles extends MBase {
	/**
	 * Table name
	 */
	public $table = 'ROLE';

	// ----------------------------------------------------------------
	/**
	 * --------------------------------------------
	 * Constructor
	 * --------------------------------------------
	 */
	function __construct() {
		parent::__construct();
	}
	
	/**
	 * --------------------------------------------
	 * Get list data
	 * --------------------------------------------
	 */
	public function getAllRoles() {
		// $filter = array();

		// return $this->get($filter);

		$sql = 'SELECT r.id, r.name, r.status, r.group_id, g.NAME group_name FROM ROLE r INNER JOIN GROUPS g ON r.group_id = g.id and g.deleted = 0 and r.deleted = 0 ';
		$query = $this->db->query($sql);

		return $query->result_array();
	}

	/**
	 * --------------------------------------------
	 * Get all active categories
	 * --------------------------------------------
	 */
	public function getActiveRoles() {
		$filter = array(
			'status' => 1,
			'deleted' => 0 
		);

		return $this->get($filter);

		// $sql = 'SELECT r.ID, r.NAME, r.STATUS, r.GROUP_ID, g.NAME GROUP_NAME FROM ROLE r INNER JOIN GROUPS g ON r.group_id = g.id and g.deleted = 0 and g.status = 1 and r.deleted = 0 and r.status = 1';
		// $query = $this->db->query($sql);

		// return $query->result_array();
	}

	/**
	 * --------------------------------------------
	 * Get role of Group
	 * --------------------------------------------
	 */
	public function getByGroupID($group_id) {
		$filter = array(
			'status' => 1,
			'deleted' => 0 ,
			'group_id' => $group_id
		);

		return $this->get($filter);
	}

}