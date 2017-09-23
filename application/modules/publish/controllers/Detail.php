<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Detail extends MY_Controller {
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
			'javascript' => array(
                1 => '/assets/js/vienvong/articles.js'
            )
		];

		// set layout
		$this->load->set_layout('publish_layout.php');
		$this->load->layout($layout_data);
		$this->load->set_template('content_template');
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
		$settings = array(
			// 'categories' => $this->MCategories->getDictionaryCategories(),
			// 'articles' => $this->MArticles->getArticles($filter)
		);
		$this->load->render('detail/detail', $settings);
	}
}