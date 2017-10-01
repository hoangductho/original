<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MRolePermission extends MBase {
	/**
	 * Table name
	 */
	public $table = 'ROLE_PERMISSION';

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
	public function getAllRolePermission() {
		$sql = 'SELECT rp.role_id, rp.permission_id, r.group_id, r.name role_name, p.name permission_name, g.name group_name FROM ROLE_PERMISSION rp, ROLE r, PERMISSION p, GROUPS g where rp.role_id = r.id and rp.permission_id = p.id and g.id = r.group_id and r.deleted = 0 and p.deleted = 0';

		$query = $this->db->query($sql);

		return $query->result_array();
	}

}