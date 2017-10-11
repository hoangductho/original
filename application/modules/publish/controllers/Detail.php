<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Detail extends CI_Controller {
	protected $__ISSERVICE__ = false;
	protected $__IS_AUTH__ = false;
	protected $__RULES__ = [
		'index' => [
			'method' => 'GET',
			'authorize' => [
            ],
			'data' => []
		]
	];

	public function __construct() {
		parent::__construct();

		$layout_data = [
			'title' => 'Articles',
			'categories' => $this->MCategories->getActiveCategories(),
			'populars' => $this->MPublicArticles->getPopular(),
			'stylesheet' => array(
				0 => '/assets/lib/editormd/css/editormd.min.css',
				1 => '/assets/css/vienvong/github-markdown.css'
			),
			'javascript' => array(
				0 => '/assets/lib/editormd/editormd.min.js',
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
                11 => '/assets/lib/editormd/lib/katex.min.js',

                12 => '/assets/js/vienvong/common.js',
                13 => '/assets/js/supernews/runtime.js'
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
		$this->load->helper('sitemap');
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
	public function index($id)
	{
		$detail = $this->MPublicArticles->getByID($id);
		$settings = array(
			// 'categories' => $this->MCategories->getDictionaryCategories(),
			'article' => $detail,
			'relations' => $this->MPublicArticles->getRelations($id, $detail['category_id'])
		);

		$layout_data = [
			'title' => $detail['title'],
		];
		$this->load->layout($detail);
		
		$this->load->render('detail/detail', $settings);
	}
}