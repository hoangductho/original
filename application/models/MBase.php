<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MBase extends CI_Model {
	/**
	 * Table name
	 */
	public $table;

	/**
	 * Contronller Pointer
	 */
	public $CI;
	// ----------------------------------------------------------------
	/**
	 * --------------------------------------------
	 * Constructor
	 * --------------------------------------------
	 */
	function __construct() {
		parent::__construct();
		$this->load->database();
		$this->CI = & get_instance();
	}
	// ----------------------------------------------------------------
	/**
	 * --------------------------------------------
	 * Insert Row
	 * --------------------------------------------
	 *
	 * @param array $data data needed insert
	 *
	 * @return insert result
	 */
	public function insert($data) {
		try {
			$insert = $this->db->insert($this->table, $data);
			return $insert;
		} catch (Exception $e) {
			return ['status' => 0,'code' => 1,'message' => $e['message']];
		}
		
	}
	// ----------------------------------------------------------------
	/**
	 * --------------------------------------------
	 * Get Rows
	 * --------------------------------------------
	 *
	 * @param array $filter filter's conditional
	 * @param mixed $select fields needed get
	 *
	 * @return rows result
	 */
	public function get($filter, $select = '*', $page = 1) {
		// var_dump($filter);
		if(is_array($select)) {
			$select = implode(',', $select);
		}

		if(!empty($page)) {
			$limit = $this->CI->config->item('limit');
			$this->db->limit($limit, ($page - 1) * $limit);
		}
		
		// echo $this->db->select($select)->where($filter)->from($this->table)->get_compiled_select(); exit();
		$query = $this->db->select($select)->where($filter)->from($this->table)->get();
		// var_dump($this->db->last_query());
		return $query->result_array();
	}
	// ----------------------------------------------------------------
	/**
	 * --------------------------------------------
	 * Get Element By ID
	 * --------------------------------------------
	 *
	 * @param array $filter filter's conditional
	 * @param mixed $select fields needed get
	 *
	 * @return rows result
	 */
	public function getByID($id, $select = '*') {
		if(is_array($select)) {
			$select = implode(',', $select);
		}

		$filter = array(
			'id' => $id
		);
		// echo $this->db->select($select)->where($filter)->from($this->table)->get_compiled_select();
		$query = $this->db->select($select)->where($filter)->from($this->table)->get();

		$result = $query->result_array();

		return !empty($result[0]) ? $result[0] : $result;
	}
	// ----------------------------------------------------------------
	/**
	 * --------------------------------------------
	 * Exists row
	 * --------------------------------------------
	 *
	 * @param array $filter filter's conditional
	 * @param mixed $select fields needed get (array/string)
	 *
	 * @return row result
	 */
	public function exists($filter, $select = null) {
		if(is_array($select)) {
			$select = implode(',', $select);
		}

		if(!empty($select)) {
			$this->db->select($select);
		}
		// echo $this->db->select($select)->where($filter)->from($this->table)->get_compiled_select();
		$query = $this->db->where($filter)->from($this->table)->get();

		if($query->num_rows() > 0)  {
			if(!empty($select)) {
				return $query->result_array();
			}else {
				return true;
			}
		}else {
			return false;
		}
	}
	// ----------------------------------------------------------------
	/**
	 * --------------------------------------------
	 * Update Data
	 * --------------------------------------------
	 *
	 * @param array $data data set 
	 * @param array $filter where filter
	 * @param bool  $default 
	 *
	 * @return update result
	 */
	public function update($set, $filter, $default = false) {
		try {
			$update = $this->db->update($this->table, $set, $filter);
			
			if($default) {
				return $update;
			}

			if($update) {
				return true;
			}else {
				return false;
			}
		} catch (Exception $e) {
			return false;
		}
	}
	// ----------------------------------------------------------------
	/**
	 * --------------------------------------------
	 * Select Max
	 * --------------------------------------------
	 *
	 * @param string $field
	 * @param string $alias
	 * @param array  $filter
	 *
	 * @return select max result
	 */
	public function select_max($field, $alias = '', $filter = null) {
		return $this->db->select_max($field)->where($filter)->from($this->table)->get();
	}
	// ----------------------------------------------------------------
	/**
	 * --------------------------------------------
	 * Count number of Page
	 * --------------------------------------------
	 */
	public function countPage($filter, $ignore, $limit = 0) {
		$page = 1;

		if(empty($limit)) {
			$limit = $this->CI->config->item('limit');
		}

		foreach ($ignore as $key => $value) {
			$this->db->where_not_in($key, $value);
		}

		$query = $this->get($filter, 'count(ID) numbers');

		if(!empty($query)) {
			$page = ceil($query[0]['numbers'] / $limit);
		}

		return $page;
	}
	// ----------------------------------------------------------------
	/**
	 * --------------------------------------------
	 * Update Data By ID
	 * --------------------------------------------
	 *
	 * @param array $data data set 
	 * @param array $filter where filter
	 * @param bool  $default 
	 *
	 * @return update result
	 */
	public function updateByID($id, $set, $default = false) {
		try {
			$filter = array('id' => $id);
			
			$update = $this->db->update($this->table, $set, $filter);
			
			if($default) {
				return $update;
			}

			if($update) {
				return true;
			}else {
				return false;
			}
		} catch (Exception $e) {
			return false;
		}
	}
}