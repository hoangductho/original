<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MSeries extends MBase {
	/**
	 * Table name
	 */
	public $table = 'SERIES';

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
	 * Get all active categories
	 * --------------------------------------------
	 */
	public function getActiveSeries() {
		$filter = array(
			'status' => 1,
			'deleted' => 0 
		);

		return $this->get($filter);
	}

}