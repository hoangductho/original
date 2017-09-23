<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

	protected $__ISSERVICE__ = false;
	protected $__RULES__ = [
		'signin' => [
			'method' => 'GET',
			'data' => []
		],
		'signup' => [
			'method' => 'GET',
			'data' => []
		],
		'signout' => [
			'method' => 'GET',
			'data' => []
		],
		'forgot' => [
			'method' => 'GET',
			'data' => []
		],
		'reset' => [
			'method' => 'GET',
			'data' => []
		],
		'active' => [
			'method' => 'GET',
			'data' => [
			]
		],
		'resend' => [
			'method' => 'GET',
			'data' => [
			]
		],
	];

	public function __construct() {
		parent::__construct();
		if(!empty($this->__ACCOUNT__) && $this->__FUNCTION__ != 'signout') {
			redirect('/app/dashboard');
		}
		// set layout
		$this->load->set_layout('user_layout.php');
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
	public function signin()
	{
		$this->load->render('User/signin');
	}
	/**
	 * Sign Up page
	 * 
	 * Form for user sign up new account
	 */
	public function signup()
	{
		$this->load->render('User/signup');
	}
	/**
	 * Sign Up page
	 * 
	 * Form for user sign up new account
	 */
	public function signout()
	{
		if (isset($_COOKIE['session_token'])) {
		    unset($_COOKIE['session_token']);
		    setcookie('session_token', '', -1, '/');
		} 
	
		// redirect('/app/user/signin');
		header("Location: /app/user/signin");
	}
	/**
	 * Forgot Password
	 *
	 * Form to case of forget password
	 */
	public function forgot()
	{
		$this->load->render('User/forgot');
	}
	/**
	 * Reset Password
	 * 
	 */
	public function reset($key)
	{
		$code = json_decode(base64_decode(urldecode($key)), true);

		$data = [
			'code' => $key,
			'email' => $code['email']
		];

		$this->load->render('User/reset', $data);
	}
	/**
	 * Active account
	 *
	 */
	public function active($key)
	{
		$code = json_decode(base64_decode(urldecode($key)), true);

		$data = [
			'code' => $key,
			'email' => $code['email']
		];

		$this->load->render('User/active', $data);
	}
}