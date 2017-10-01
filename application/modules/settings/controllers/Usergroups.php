<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usergroups extends MY_Controller {

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
				'account_id' => [
					'allow_null' => false,
					'filter' => FILTER_VALIDATE_REGEXP,
					'options' => [
						'regexp' => '/^[\\d]{1,9}+$/'
					]
				],
				'group_id' => [
					'allow_null' => false,
					'filter' => FILTER_VALIDATE_REGEXP,
					'options' => [
						'regexp' => '/^[\\d]{1,9}+$/'
					]
				],
				'role_id' => [
					'allow_null' => false,
					'filter' => FILTER_VALIDATE_REGEXP,
					'options' => [
						'regexp' => '/^[\\d]{1,9}+$/'
					]
				],
			]
		]
	];

	public function __construct() {
		parent::__construct();

		// set layout
		$this->load->set_layout('active_layout.php');

		$this->load->model('MGroups');
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

		// create relation of group and user
		$gu_filter = [
			'account_id' => $request->account_id,
			'group_id' => $request->group_id
		];

		$gu_exist = $this->MGroupuser->exists($gu_filter, '*');

		if(!$gu_exist) {
			$gu_create = $this->MGroupuser->insert($request);
		}else {
			if($gu_exist[0]['deleted'] = 1 || $gu_exist[0]['role_id'] != $request->role_id) {
				$gu_set = array(
					'deleted' => 0,
					'role_id' => $request->role_id
				);
				$gu_create = $this->MGroupuser->update($gu_set, $gu_filter);
			}
		}

		// create relation of 
		
		// send mail to user
		$this->response(json_encode(set_response_data($gu_create)));
	}
}