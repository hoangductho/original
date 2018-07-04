<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cryptography extends CI_Controller {
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
			'title' => 'Cryptography Methods',
			'categories' => $this->MCategories->getActiveCategories(),
			'populars' => $this->MPublicArticles->getPopular(),
			'javascript' => array(
				0 => '/assets/js/jsencrypt/jsencrypt.min.js',
				1 => '/assets/js/crypto-js/crypto-js.js',
				2 => '/assets/js/vienvong/common.js',
                3 => '/assets/js/vienvong/vienvong_core.js',
                4 => '/assets/js/supernews/contact.js',
                5 => '/assets/js/vienvong/cryptography.js',
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
		$this->load->render('cryptography/cryptography_index', $settings);
	}

	public function md5() 
	{
		$settings = array();
		$layout_data = [
			'title' => 'MD5 Hash Online'
		];
		$this->load->layout($layout_data);
		$this->load->render('cryptography/cryptography_md5', $settings);
	}

	public function sha1()
	{
		$settings = array();
		$layout_data = [
			'title' => 'SHA-1 Hash Online'
		];
		$this->load->layout($layout_data);
		$this->load->render('cryptography/cryptography_sha1', $settings);
	}

	public function aes() 
	{
		$settings = array();
		$layout_data = [
			'title' => 'AES Encrypt/Decrypt Online'
		];
		$this->load->layout($layout_data);
		$this->load->render('cryptography/cryptography_aes', $settings);
	}

	public function rsa() 
	{
		$settings = array();
		$layout_data = [
			'title' => 'RSA Encrypt/Decrypt Online'
		];
		$this->load->layout($layout_data);
		$this->load->render('cryptography/cryptography_rsa', $settings);
	}

	public function base64() 
	{
		$settings = array();
		$layout_data = [
			'title' => 'Base64 Encode/Decode Online'
		];
		$this->load->layout($layout_data);
		$this->load->render('cryptography/cryptography_base64', $settings);
	}
}