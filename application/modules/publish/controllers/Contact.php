<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {
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
			'title' => 'Contact',
			'categories' => $this->MCategories->getActiveCategories(),
			'populars' => $this->MPublicArticles->getPopular(),
			'javascript' => array(
				0 => '/assets/js/jsencrypt/jsencrypt.min.js',
				1 => '/assets/js/crypto-js/crypto-js.js',
				2 => '/assets/js/vienvong/common.js',
                3 => '/assets/js/vienvong/vienvong_core.js',
                4 => '/assets/js/supernews/contact.js'
            )
		];

		// set layout
		$this->load->set_layout('publish_layout.php');
		$this->load->layout($layout_data);
		$this->load->set_template('branding_template');
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
			// 'categories' => $this->MCategories->getDictionaryCategories(),
			// 'articles' => $this->MPublicArticles->getArticles($filter)
		);
		$this->load->render('contact/contact', $settings);
	}
}