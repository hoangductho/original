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
	/**
	 * --------------------------------------------
	 * Get newest series
	 * --------------------------------------------
	 */
	public function getNewestSeries($limit = 3) {
		$filter = array(
			'status' => 1,
			'deleted' => 0
		);

		$query = $this->db->where($filter)->order_by('modified_date DESC')->limit($limit)->from($this->table)->get();

		return $query->result_array();
	}

}