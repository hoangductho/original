<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends MY_Controller {
	protected $__ISSERVICE__ = true;
	protected $__RULES__ = [
		'signin' => [
			'method' => 'POST',
			'security' => true,
			'data' => [
				'email' => [
					'allow_null' => false,
					'filter' => FILTER_VALIDATE_EMAIL,
				],
				'password' => [
					'allow_null' => false,
					'filter' => FILTER_VALIDATE_REGEXP,
					'options' => [
						'regexp' => '/^[\S]{8,128}+$/'
					]
				]
			]
		],
		'signup' => [
			'method' => 'POST',
			'security' => true,
			'data' => [
				'email' => [
					'allow_null' => false,
					'filter' => FILTER_VALIDATE_EMAIL,
				],
				'password' => [
					'allow_null' => false,
					'filter' => FILTER_VALIDATE_REGEXP,
					'options' => [
						'regexp' => '/^[\S]{8,128}+$/'
					]
				],
				'lastname' => [
					'allow_null' => false,
					'filter' => FILTER_VALIDATE_REGEXP,
					'options' => [
						'regexp' => '/^[\\s\\w\\p{L}]{2,128}+$/u'
					]
				],
				'firstname' => [
					'allow_null' => false,
					'filter' => FILTER_VALIDATE_REGEXP,
					'options' => [
						'regexp' => '/^[\\s\\w\\p{L}]{2,128}+$/u'
					]
				],
				'birthday' => [
					'allow_null' => false,
					'filter' => FILTER_VALIDATE_REGEXP,
					'options' => [
						'regexp' => '/^(((0[1-9]|[12]\d|3[01])\/(0[13578]|1[02])\/((19|[2-9]\d)\d{2}))|((0[1-9]|[12]\d|30)\/(0[13456789]|1[012])\/((19|[2-9]\d)\d{2}))|((0[1-9]|1\d|2[0-8])\/02\/((19|[2-9]\d)\d{2}))|(29\/02\/((1[6-9]|[2-9]\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))))$/'
					]
				],
				'mobile' => [
					'allow_null' => false,
					'filter' => FILTER_VALIDATE_REGEXP,
					'options' => [
						'regexp' => '/^\\d{10,16}$/'
					]
				],
				'sex' => [
					'allow_null' => false,
					'filter' => FILTER_VALIDATE_REGEXP,
					'options' => [
						'regexp' => '/^[0-1]{1}$/'
					]
				]
			]
		],
		'forgot' => [
			'method' => 'POST',
			'security' => true,
			'data' => [
				'email' => [
					'allow_null' => false,
					'filter' => FILTER_VALIDATE_EMAIL,
				],
			]
		],
		'reset' => [
			'method' => 'POST',
			'security' => true,
			'data' => [
				'password' => [
					'allow_null' => false,
					'filter' => FILTER_VALIDATE_REGEXP,
					'options' => [
						'regexp' => '/^[\S]{8,128}+$/'
					]
				],
				'code' => [
					'allow_null' => false,
					'filter' => FILTER_VALIDATE_REGEXP,
					'options' => [
						'regexp' => '/\\S/'
					]
				]
			]
		],
		'active' => [
			'method' => 'POST',
			'security' => true,
			'data' => [
				'code' => [
					'allow_null' => false,
					'filter' => FILTER_VALIDATE_REGEXP,
					'options' => [
						'regexp' => '/\\S/'
					]
				]
			]
		],
		'resend' => [
			'method' => 'POST',
			'security' => true,
			'data' => [
				'email' => [
					'allow_null' => false,
					'filter' => FILTER_VALIDATE_EMAIL,
				],
			]
		],
	];

	private $Vmail;

	public function __construct() {
		parent::__construct();

		// init Vienvong email
		$this->Vmail = new Vmail();

		// load models
		$this->load->model('MAccount');

		// set layout for email
		$this->load->set_layout('email/email_layout.php'); 
	}

	/**
	 * --------------------------------------------
	 * Sign in page
	 * --------------------------------------------
	 */
	public function signin()
	{
		if(empty($this->__ACCOUNT__)) {
			$key['email'] = $this->__REQUEST_DATA__->email;

			$exists = $this->MAccount->account_exist_status($this->__REQUEST_DATA__->email, 'active', 'id, email, firstname, lastname, status, password');

			if(!$exists) {
				$this->_error(self::SRV_ACCOUNT_NOT_FOUND, self::HTTP_OK);
			}

			if(PasswordHashing($this->__REQUEST_DATA__->password) != $exists->password) {
				$this->_error(self::SRV_ACCOUNT_PASSWORD_INVALID, self::HTTP_OK);
			}else {
				unset($exists->password);
			}

			$this->__ACCOUNT__ = $exists;
			
			$this->__TOKEN__['account_id'] = $exists->id;
		}

		$response = $this->__ACCOUNT__;
		$response->token = base64_encode(json_encode($this->__TOKEN__));
		
		// Set the response and exit
		$this->response(set_response_data(TRUE, 0, $response), self::HTTP_OK); // NOT_FOUND (404) being the HTTP response code
	}
	/**
	 * --------------------------------------------
	 * Sign Up page
	 * --------------------------------------------
	 * 
	 * Form for user sign up new account
	 */
	public function signup()
	{
		$request = $this->__REQUEST_DATA__;

		$request->password = PasswordHashing($request->password);
		$request->birthday = DateTime::createFromFormat('d/m/Y', $request->birthday)->format('Y/m/d');
		$request->status = 0;

		// create new account
		$insert = $this->MAccount->insert($request);

		// send mail to user
		if($insert) {
			try {
				$data = [
					'fullname' => write_fullname_local($request->firstname, $request->lastname, $this->config->config['services_language']),
					'active_code' => $this->MAccount->create_active_code((array)$request)
				];

				$email = [
					'to' => $request->email,
					'subject' => 'Đăng ký tài khoản thành công',
					'message' => $this->load->render('email/confirm_mail', $data, true)
				];

				$this->Vmail->send($email);
			} catch (Exception $e) {
				log($e);
			}
			
		}

		$this->response(json_encode(set_response_data($insert)));
	}
	/**
	 * --------------------------------------------
	 * Forgot Password
	 * --------------------------------------------
	 *
	 * Form to case of forget password
	 */
	public function forgot()
	{
		$exists = $this->MAccount->account_exist_status($this->__REQUEST_DATA__->email, 'active');

		if($exists && is_array($exists)) {
			try {
				$data = [
					'fullname' => write_fullname_local($exists->firstname, $exists->lastname, $this->config->config['services_language']),
					'active_code' => $this->MAccount->create_active_code($exists)
				];

				$email = [
					'to' => $exists->email,
					'subject' => 'Đăng ký tài khoản thành công',
					'message' => $this->load->render('email/forgot_mail', $data, true)
				];

				$this->Vmail->send($email);
			} catch (Exception $e) {
				log($e);
			}
		}

		$this->response(json_encode(set_response_data($exists)));
	}
	/**
	 * Reset Password
	 * 
	 */
	public function reset($key)
	{
		$validate = $this->MAccount->reset_password($this->__REQUEST_DATA__->code, $this->__REQUEST_DATA__->password);

		// send mail to user
		if($validate && is_array($validate)) {
			try {
				$data = [
					'fullname' => write_fullname_local($validate->firstname, $validate->lastname, $this->config->config['services_language'])
				];

				$email = [
					'to' => $validate->email,
					'subject' => 'Đặt lại mật khẩu thành công',
					'message' => $this->load->render('email/reset_mail', $data, true)
				];

				$this->Vmail->send($email);
			} catch (Exception $e) {
				log($e);
			}
			
		}

		$this->response(json_encode(set_response_data($validate)));
	}
	/**
	 * --------------------------------------------
	 * Active account
	 * --------------------------------------------
	 *
	 */
	public function active()
	{
		$validate = $this->MAccount->active_account($this->__REQUEST_DATA__->code);

		// send mail to user
		if($validate && is_array($validate)) {
			try {
				$data = [
					'fullname' => write_fullname_local($validate->firstname, $validate->lastname, $this->config->config['services_language'])
				];

				$email = [
					'to' => $validate->email,
					'subject' => 'Kích hoạt tài khoản thành công',
					'message' => $this->load->render('email/active_mail', $data, true)
				];

				$this->Vmail->send($email);
			} catch (Exception $e) {
				log($e);
			}
			
		}

		$this->response(json_encode(set_response_data($validate)));
	}
	/**
	 * --------------------------------------------
	 * Resend active code
	 * --------------------------------------------
	 */
	public function resend() {
		$exists = $this->MAccount->account_exist_status($this->__REQUEST_DATA__->email, 'pending');

		if($exists && is_array($exists)) {
			try {
				$data = [
					'fullname' => write_fullname_local($exists->firstname, $exists->lastname, $this->config->config['services_language']),
					'active_code' => $this->MAccount->create_active_code($exists)
				];

				$email = [
					'to' => $exists->email,
					'subject' => 'Mã kích hoạt tài khoản',
					'message' => $this->load->render('email/confirm_mail', $data, true)
				];

				$this->Vmail->send($email);
			} catch (Exception $e) {
				log($e);
			}
		}

		$this->response(json_encode(set_response_data($exists)));
	}
}