<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MArticles extends MBase {
	/**
	 * Table name
	 */
	public $table = 'ARTICLES';

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
	public function getArticles($filter = array()) {
		// var_dump($filter); exit();
		return $this->get($filter);
	}

	/**
	 * --------------------------------------------
	 * Filter Article
	 * --------------------------------------------
	 */
	public function filterArticles($filter, $select = '*') {
		$where = array(
			'deleted' => 0,
			'privacy' => 1
		);

		if($filter->category != null) {
			$where['category_id'] = $filter->category;
		}

		if($filter->result != null) {
			$where['result'] = $filter->result;
		}

		if($filter->status != null) {
			$where['status'] = $filter->status;
		}

		$this->db->where($where);

		if($filter->startdate != null) {
			$this->db->where("DATE_FORMAT(created_date,'%d/%m/%Y') >= '{$filter->startdate}'",NULL,FALSE);
		}

		if($filter->enddate != null) {
			$this->db->where("DATE_FORMAT(created_date,'%d/%m/%Y') <= '{$filter->enddate}'",NULL,FALSE);
		}

		if(is_array($select)) {
			$select = implode(',', $select);
		}
		// echo $this->db->select($select)->where($filter)->from($this->table)->get_compiled_select();
		$query = $this->db->select($select)->from($this->table)->get();
		// var_dump($this->db->last_query());
		return $query->result_array();
	}
	/**
	 * --------------------------------------------
	 * Filter User's Article
	 * --------------------------------------------
	 */
	public function filterUserArticles($userid, $filter, $select = '*') {
		$where = array(
			'deleted' => 0,
			'account_id' => $userid
		);

		if($filter->category != null) {
			$where['category_id'] = $filter->category;
		}

		if($filter->privacy != null) {
			$where['privacy'] = $filter->privacy;
		}

		if($filter->status != null) {
			$where['status'] = $filter->status;
		}

		$this->db->where($where);

		if($filter->startdate != null) {
			$this->db->where("DATE_FORMAT(created_date,'%d/%m/%Y') >= '{$filter->startdate}'",NULL,FALSE);
		}

		if($filter->enddate != null) {
			$this->db->where("DATE_FORMAT(created_date,'%d/%m/%Y') <= '{$filter->enddate}'",NULL,FALSE);
		}

		if(is_array($select)) {
			$select = implode(',', $select);
		}
		// echo $this->db->select($select)->where($filter)->from($this->table)->get_compiled_select();
		$query = $this->db->select($select)->from($this->table)->get();
		// var_dump($this->db->last_query());
		return $query->result_array();
	}
}