<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends MY_Controller {
	protected $__ISSERVICE__ = false;
	protected $__IS_AUTH__ = false;
	protected $__RULES__ = [
		'index' => [
			'method' => 'POST',
			'security' => false,
			'authorize' => [
            ],
			'data' => [
				'keyword' => [
					'allow_null' => false,
					'filter' => FILTER_VALIDATE_REGEXP,
					'options' => [
						'regexp' => '/^[\\s\\w\\p{L}\\pP]{2,128}+$/u'
					]
				],
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
	public function index($page = 1)
	{
		$filter = [
			'status' => 1,
			'privacy' => 1,
			'result' => 1,
			'deleted' => 0,
			'title like' => '%'.$this->__REQUEST_DATA__->keyword.'%'
		];

		$settings = array(
			// 'categories' => $this->MCategories->getDictionaryCategories(),
			'articles' => $this->MPublicArticles->getArticles($filter, $page),
			'pages' => $this->MPublicArticles->countPage($filter),
			'keyword' => $this->__REQUEST_DATA__->keyword,
		);

		$this->load->render('search/search', $settings);
	}
}