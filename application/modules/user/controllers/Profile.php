<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends MY_Controller {
	protected $__ISSERVICE__ = true;
	protected $__IS_AUTH__ = false;
	protected $__RULES__ = [
		'edit' => [
			'method' => 'POST',
			'security' => true,
			'data' => [
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
		'changepassword' => [
			'method' => 'POST',
			'security' => true,
			'data' => [
				'current_password' => [
					'allow_null' => false,
					'filter' => FILTER_VALIDATE_REGEXP,
					'options' => [
						'regexp' => '/^[\S]{8,128}+$/'
					]
				],
				'new_password' => [
					'allow_null' => false,
					'filter' => FILTER_VALIDATE_REGEXP,
					'options' => [
						'regexp' => '/^[\S]{8,128}+$/'
					]
				],
			]
		]
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
	 * Sign Up page
	 * --------------------------------------------
	 * 
	 * Form for user sign up new account
	 */
	public function edit()
	{
		$request = $this->__REQUEST_DATA__;

		$request->birthday = DateTime::createFromFormat('d/m/Y', $request->birthday)->format('Y/m/d');

		// create new account
		$update = $this->MAccount->update($request, array('id' => $this->__ACCOUNT__->id));

		// send mail to user
		// if($insert) {
		// 	try {
		// 		$data = [
		// 			'fullname' => write_fullname_local($request->firstname, $request->lastname, $this->config->config['services_language']),
		// 			'active_code' => $this->MAccount->create_active_code((array)$request)
		// 		];

		// 		$email = [
		// 			'to' => $request->email,
		// 			'subject' => 'Đăng ký tài khoản thành công',
		// 			'message' => $this->load->render('email/confirm_mail', $data, true)
		// 		];

		// 		$this->Vmail->send($email);
		// 	} catch (Exception $e) {
		// 		log($e);
		// 	}
			
		// }

		$this->response(json_encode(set_response_data($update)));
	}
	/**
	 * Reset Password
	 * 
	 */
	public function changepassword()
	{
		$current_password = PasswordHashing($this->__REQUEST_DATA__->current_password);
		$new_password = PasswordHashing($this->__REQUEST_DATA__->new_password);
		$validate = $this->MAccount->change_password($current_password, $new_password, $this->__ACCOUNT__->id);

		// send mail to user
		// if($validate && is_array($validate)) {
		// 	try {
		// 		$data = [
		// 			'fullname' => write_fullname_local($validate->firstname, $validate->lastname, $this->config->config['services_language'])
		// 		];

		// 		$email = [
		// 			'to' => $validate->email,
		// 			'subject' => 'Đặt lại mật khẩu thành công',
		// 			'message' => $this->load->render('email/reset_mail', $data, true)
		// 		];

		// 		$this->Vmail->send($email);
		// 	} catch (Exception $e) {
		// 		log($e);
		// 	}
			
		// }

		$this->response(json_encode(set_response_data($validate)));
	}
}