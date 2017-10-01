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
	public function getArticles($filter = array(), $page = null) {
		$this->db->order_by('created_date DESC');
		return $this->get($filter, '*', $page);
	}

	/**
	 * --------------------------------------------
	 * Filter Article
	 * --------------------------------------------
	 */
	public function filterArticles($filter, $page = 0, $select = '*') {
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

		if(!empty($page)) {
			$limit = $this->CI->config->item('limit');
			$this->db->limit($limit, ($page - 1) * $limit);
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
	/**
	 * --------------------------------------------
	 * Get trending articles
	 * --------------------------------------------
	 */
	public function getTrending($category_id = 0, $limit = 3) {
		$filter = [
			'status' => 1,
			'privacy' => 1,
			'result' => 1,
			'popularity' => 3,
			'deleted' => 0
		];

		if(filter_var($category_id, FILTER_VALIDATE_INT)) {
			$filter['category_id'] = $category_id;
		}

		$query = $this->db->where($filter)->order_by('actived_date DESC')->limit($limit)->from($this->table)->get();

		return $query->result_array();
	}
	/**
	 * --------------------------------------------
	 * Get trending articles
	 * --------------------------------------------
	 */
	public function getPopular($category_id = 0, $limit = 3) {
		$filter = [
			'status' => 1,
			'privacy' => 1,
			'result' => 1,
			'popularity' => 2,
			'deleted' => 0
		];

		if(filter_var($category_id, FILTER_VALIDATE_INT)) {
			$filter['category_id'] = $category_id;
		}

		$query = $this->db->where($filter)->order_by('actived_date DESC')->limit($limit)->from($this->table)->get();

		return $query->result_array();
	}

	/**
	 * --------------------------------------------
	 * Get Relations of Article
	 * --------------------------------------------
	 */
	public function getRelations($id, $category_id, $limit = 4) {
		$filter = [
			'status' => 1,
			'privacy' => 1,
			'result' => 1,
			'deleted' => 0,
			'category_id' => $category_id,
			'id !=' => $id
		];

		$query = $this->db->where($filter)->order_by('actived_date DESC')->limit($limit)->from($this->table)->get();

		return $query->result_array();
	}
}