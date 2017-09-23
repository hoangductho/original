<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MGroups extends MBase {
	/**
	 * Table name
	 */
	public $table = 'GROUPS';

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
	public function getAllGroups() {
		$filter = array();

		return $this->get($filter);
	}
	/**
	 * --------------------------------------------
	 * Get Active Groups
	 * --------------------------------------------
	 */
	public function getActiveGroups() {
		$filter = array(
			'deleted' => 0,
			'status' => 1
		);

		return $this->get($filter);
	}

}