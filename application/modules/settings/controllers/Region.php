<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Region extends MY_Controller {

	protected $__ISSERVICE__ = true;
	protected $__IS_AUTH__ = true;
	protected $__RULES__ = [
		'edit' => [
			'method' => 'POST',
			'authorize' => [
                'group' => 'System',
                'role' => 'Admin',
                // 'permission' => 'USER_WRITING_EDIT',
                // 'region' => null,
            ],
			'data' => [
				'id' => [
					'allow_null' => true,
					'filter' => FILTER_VALIDATE_REGEXP,
					'options' => [
						'regexp' => '/^[\\d]{1,9}+$/'
					]
				],
				'name' => [
					'allow_null' => false,
					'filter' => FILTER_VALIDATE_REGEXP,
					'options' => [
						'regexp' => '/^[\\s\\w\\p{L}]{2,64}+$/u'
					]
				],
				'status' => [
					'allow_null' => true,
					'filter' => FILTER_VALIDATE_REGEXP,
					'options' => [
						'regexp' => '/^[0-9]{1}+$/'
					]
				]
			]
		]
	];

	public function __construct() {
		parent::__construct();

		// set layout
		$this->load->set_layout('active_layout.php');
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
	public function edit()
	{
		$request = $this->__REQUEST_DATA__;
		$id = $request->id;
		$insert = array();

		// create new account
		$request->name = ucwords(strtolower(preg_replace('/[\s]{2,}+/',' ',$request->name)));
		$request->code = md5(str_replace(' ', '', $request->name));
		
		unset($request->id);

		if($id == 0) {
			$insert = $this->MRegions->insert($request);	
		}
		else {
			$insert = $this->MRegions->update($request, array('id' => $id));	
		}
		
		// send mail to user
		$this->response(json_encode(set_response_data($insert)));
	}
}