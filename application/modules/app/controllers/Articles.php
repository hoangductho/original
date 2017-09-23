<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Articles extends MY_Controller {
	protected $__ISSERVICE__ = false;
	protected $__IS_AUTH__ = true;
	protected $__RULES__ = [
		'index' => [
			'method' => 'GET',
			'authorize' => [
                'group' => 'Publish',
                // 'role' => 'Admin',
                'permission' => 'MANAGER_ARTICLES_EXEC',
                // 'region' => null,
            ],
			'data' => []
		],
		'filter' => [
			'method' => 'GET',
			'security' => true,
			'data' => [
				'category' => [
					'allow_null' => true,
					'filter' => FILTER_VALIDATE_REGEXP,
					'options' => [
						'regexp' => '/[0-9]{1,9}/'
					]
				],
				'result' => [
					'allow_null' => true,
					'filter' => FILTER_VALIDATE_REGEXP,
					'options' => [
						'regexp' => '/[0-9]{1,3}/'
					]
				],
				'status' => [
					'allow_null' => true,
					'filter' => FILTER_VALIDATE_REGEXP,
					'options' => [
						'regexp' => '/[0-9]{1,3}/'
					]
				],
				'startdate' => [
					'allow_null' => true,
					'filter' => FILTER_VALIDATE_REGEXP,
					'options' => [
						'regexp' => '/[0-9]{2}+\/[0-9]{2}+\/+[0-9]{4}/'
					]
				],
				'enddate' => [
					'allow_null' => true,
					'filter' => FILTER_VALIDATE_REGEXP,
					'options' => [
						'regexp' => '/[0-9]{2}+\/[0-9]{2}+\/+[0-9]{4}/'
					]
				]
			]
		],
		'redact' => [
			'method' => 'GET',
			'data' => []
		]
	];

	public function __construct() {
		parent::__construct();

		$layout_data = [
			'title' => 'Articles',
			'javascript' => array(
                1 => '/assets/js/vienvong/articles.js'
            )
		];

		// set layout
		$this->load->set_layout('active_layout.php');
		$this->load->layout($layout_data);

	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$filter = array(
			'deleted' => 0,
			'privacy' => 1,
			'status' => 1
		);

		$settings = array(
			'categories' => $this->MCategories->getDictionaryCategories(),
			'articles' => $this->MArticles->getArticles($filter)
		);
		$this->load->render('Articles/list', $settings);
	}

	/**
	 * Filter Data
	 *
	 * Get list of articles by filter data conditions
	 */
	public function filter() {
		$request = $this->__REQUEST_DATA__;

		$settings = array(
			'categories' => $this->MCategories->getDictionaryCategories(),
			'articles' => $this->MArticles->filterArticles($request)
		);
		
		$render = $this->load->view('Articles/list_articles', $settings, TRUE);

		echo $render;
	}

	/**
	 * Redact Article
	 *
	 * Admin edit content and setup info of the aritcle 
	 */
	public function redact($id) {
		$settings = array(
			'categories' => $this->MCategories->getDictionaryCategories(),
			'series' => $this->MSeries->getActiveSeries(),
			'article' => $this->MArticles->getByID($id)
		);
		$this->load->render('Articles/redact', $settings);
	}
}