<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MGroupuser extends MBase {
	/**
	 * Table name
	 */
	public $table = 'GROUP_USER';

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
	 * Get Group User
	 * --------------------------------------------
	 */
	public function getAllGroupUser() {
		$sql = 'SELECT gu.account_id, gu.group_id, gu.role_id, g.name group_name, a.email email, r.name role_name FROM GROUP_USER gu, GROUPS g, ACCOUNT a, ROLE r WHERE gu.group_id = g.id and gu.account_id = a.id and gu.role_id = r.id and gu.deleted = 0 and g.deleted = 0 and a.deleted = 0 and r.deleted = 0';

		$query = $this->db->query($sql);

		return $query->result_array();
	}

}