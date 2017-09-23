<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MPermission extends MBase {
	/**
	 * Table name
	 */
	public $table = 'PERMISSION';

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
	public function getAllPermission() {
		$filter = array(
			'deleted' => 0
		);

		return $this->get($filter);
	}
	/**
	 * --------------------------------------------
	 * Get Active Groups
	 * --------------------------------------------
	 */
	public function getActivePermission() {
		$filter = array(
			'deleted' => 0,
			'status' => 1
		);

		return $this->get($filter);
	}

}