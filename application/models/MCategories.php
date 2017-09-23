<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MCategories extends MBase {
	/**
	 * Table name
	 */
	public $table = 'CATEGORIES';

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
	public function getAllCategories() {
		$filter = array();

		return $this->get($filter);
	}

	/**
	 * --------------------------------------------
	 * Get all active categories
	 * --------------------------------------------
	 */
	public function getActiveCategories() {
		$filter = array(
			'status' => 1,
			'deleted' => 0 
		);

		return $this->get($filter);
	}

	/**
	 * --------------------------------------------
	 * Get Dictionary Categories
	 * --------------------------------------------
	 */
	public function getDictionaryCategories() {
		$categories = $this->getActiveCategories();

		$dic_categories = array();

		foreach ($categories as $key => $value) {
			$dic_categories[$value['id']] = $value['name'];
		}

		return $dic_categories;
	}

}