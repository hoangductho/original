<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MKeyword extends MBase {
	/**
	 * Table name
	 */
	public $table = 'KEYWORD';

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
	public function getActiveKeyword() {
		$filter = array(
			'status' => 1,
			'deleted' => 0 
		);

		return $this->get($filter);
	}
	/**
	 * --------------------------------------------
	 * Get newest Keyword
	 * --------------------------------------------
	 */
	public function addKeyword($keywords) {
		if(empty($keywords)) {
			return true;
		}

		$insert = array();

		$keywords = ucwords(strtolower(preg_replace('/[\s]{2,}+/',' ',$keywords)));

		$explode = explode(',', $keywords);

		foreach ($explode as $key => $value) {
			$explode[$key] = trim($value);
		}

		$this->db->where_in('name', $explode);

		$query = $this->db->from($this->table)->get();

		$exists = $query->result_array();

		$dic = array();

		if(!empty($exists)) {
			foreach ($exists as $key => $value) {
				$dic[$value['name']] = $value['name'];
			}
		}

		foreach ($explode as $key => $value) {
			if(empty($dic[$value])) {
				$insert[$key] = array(
					'name' => $value,
					'friendly' => url_friendly($value),
					'user_id' => $this->CI->__ACCOUNT__->id,
				);
			}
		}

		if(!empty($insert)) {
			$add = $this->db->insert_batch($this->table, $insert);
		} 

		return $keywords;
	}

}