<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MUserPermission extends MBase {
	/**
	 * Table name
	 */
	public $table = 'USER_PERMISSION';

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
	public function getAllUserPermission($filter = array()) {

		foreach ($filter as $key => $value) {
			if($value == null) {
				unset($filter->{$key});
			}
		}

		return $this->get((array)$filter);
	}
}