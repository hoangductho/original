<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Publish extends CI_Controller {
	protected $__ISSERVICE__ = false;
	protected $__IS_AUTH__ = false;
	protected $__RULES__ = [
		'index' => [
			'method' => 'GET',
			'authorize' => [
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
		]
	];

	public function __construct() {
		parent::__construct();

		$layout_data = [
			'title' => 'Viễn Vọng',
			'categories' => $this->MCategories->getActiveCategories(),
			'populars' => $this->MPublicArticles->getPopular(),
			'javascript' => array(
                1 => '/assets/js/vienvong/articles.js'
            )
		];

		// set layout
		$this->load->set_layout('publish_layout.php');
		$this->load->layout($layout_data);

		$template_data = [
			'series' => $this->MSeries->getNewestSeries()
		];
		
		$this->load->set_template('content_template');
		$this->load->template($template_data);
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
	public function index($category_id = null, $page = 1)
	{
		$filter = [
			'status' => 1,
			'privacy' => 1,
			'result' => 1,
			'deleted' => 0
		];

		if(!empty($category_id)) {
			$filter['category_id'] = $category_id;
		}

		$settings = array(
			// 'categories' => $this->MCategories->getDictionaryCategories(),
			'articles' => $this->MPublicArticles->getArticles($filter, $page),
			'pages' => $this->MPublicArticles->countPage($filter),
			'trends' => $this->MPublicArticles->getTrending($category_id),
		);

		$this->load->render('homepage/homepage', $settings);
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
			'articles' => $this->MPublicArticles->filterArticles($request)
		);
		
		$render = $this->load->view('Articles/list_articles', $settings, TRUE);

		echo $render;
	}
}