<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Writing extends MY_Controller {
	protected $__ISSERVICE__ = false;
	protected $__IS_AUTH__ = true;
	protected $__RULES__ = [
		'index' => [
			'method' => 'GET',
			'authorize' => [
                'group' => 'Publish',
                // 'role' => 'Admin',
                'permission' => 'USER_WRITING_EDIT',
                // 'region' => null,
            ],
			'data' => []
		],
		'edit' => [
			'method' => 'GET',
			'authorize' => [
                'group' => 'Publish',
                // 'role' => 'Admin',
                'permission' => 'USER_WRITING_EDIT',
                // 'region' => null,
            ],
			'data' => [
				// 'id' => [
				// 	'allow_null' => false,
				// 	'filter' => FILTER_VALIDATE_INT,
				// 	'options' => []
				// ],
			]
		],
		'preview' => [
			'method' => 'GET',
			'authorize' => [
                'group' => 'Publish',
                // 'role' => 'Admin',
                'permission' => 'USER_WRITING_EDIT',
                // 'region' => null,
            ],
			'data' => []
		],
		'list' => [
			'method' => 'GET',
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
				'privacy' => [
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
			'title' => 'Writing',
			'javascript' => array(
                1 => '/assets/lib/editormd/lib/codemirror/codemirror.min.js',
                2 => '/assets/lib/editormd/lib/codemirror/modes.min.js',
                3 => '/assets/lib/editormd/lib/codemirror/addons.min.js',
                4 => '/assets/lib/editormd/lib/marked.min.js',
                5 => '/assets/lib/editormd/lib/prettify.min.js',
                6 => '/assets/lib/editormd/lib/raphael.min.js',
                7 => '/assets/lib/editormd/lib/underscore.min.js',
                8 => '/assets/lib/editormd/lib/sequence-diagram.min.js',
                9 => '/assets/lib/editormd/lib/flowchart.min.js',
                10 => '/assets/lib/editormd/lib/jquery.flowchart.min.js',
                11 => '//cdnjs.cloudflare.com/ajax/libs/KaTeX/0.3.0/katex.min.js',
                
                12 => '/assets/js/vienvong/writing.js',
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
		$settings = array(
			'categories' => $this->MCategories->getActiveCategories(),
			'series' => $this->MSeries->getActiveSeries()
		);
		$this->load->render('Writing/article', $settings);
	}

	/**
	 * Edit Article Page
	 *
	 * User edit his article
	 */
	public function edit($id)
	{
		$settings = array(
			'categories' => $this->MCategories->getDictionaryCategories(),
			'series' => $this->MSeries->getActiveSeries(),
			'article' => $this->MArticles->getByID($id)
		);
		$this->load->render('Writing/edit', $settings);
	}

	/**
	 * Preview Article
	 */
	public function preview($id) {
		$settings = array(
			'categories' => $this->MCategories->getDictionaryCategories(),
			'article' => $this->MArticles->getByID($id)
		);
		$this->load->render('Writing/preview', $settings);
	}

	/**
	 * Get User Article
	 */
	public function list() {
		$filter = array(
			'deleted' => 0,
			'account_id' => $this->__ACCOUNT__->id
		);

		$settings = array(
			'categories' => $this->MCategories->getDictionaryCategories(),
			'articles' => $this->MArticles->getArticles($filter)
		);
		
		$this->load->render('Writing/filter', $settings);
	}

	/** 
	 * Filter User Article
	 */
	public function filter() {
		$request = $this->__REQUEST_DATA__;

		$settings = array(
			'categories' => $this->MCategories->getDictionaryCategories(),
			'articles' => $this->MArticles->filterUserArticles($this->__ACCOUNT__->id,$request)
		);
		
		$render = $this->load->view('Articles/list_articles', $settings, TRUE);

		echo $render;
	}
}