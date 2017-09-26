<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MRespond extends MBase {
	/**
	 * Table name
	 */
	public $table = 'RESPOND';

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
	public function getAllRespond() {
		$filter = array();

		return $this->get($filter);
	}

	/**
	 * --------------------------------------------
	 * Get all active categories
	 * --------------------------------------------
	 */
	public function getActiveRespond() {
		$filter = array(
			'status' => 1,
			'deleted' => 0 
		);

		return $this->get($filter);
	}

}