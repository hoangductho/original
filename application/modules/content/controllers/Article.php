<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends MY_Controller {

	protected $__ISSERVICE__ = true;
	protected $__IS_AUTH__ = true;
	protected $__RULES__ = [
		'edit' => [
			'method' => 'POST',
			'authorize' => [
                'group' => 'Publish',
                // 'role' => 'Admin',
                'permission' => 'USER_WRITING_EDIT',
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
				'title' => [
					'allow_null' => false,
					'filter' => FILTER_VALIDATE_REGEXP,
					'options' => [
						'regexp' => '/^[\\s\\w\\p{L}\\pP]{8,128}+$/u'
					]
				],
				'description' => [
					'allow_null' => false,
					'filter' => FILTER_VALIDATE_REGEXP,
					'options' => [
						'regexp' => '/^[\\s\\w\\p{L}\\pP]{32,255}+$/u'
					]
				],
				'image' => [
					'allow_null' => false,
					'filter' => FILTER_VALIDATE_URL,
					'options' => [
						
					]
				],
				'series' => [
					'allow_null' => true,
					'filter' => FILTER_VALIDATE_REGEXP,
					'options' => [
						'regexp' => '/^[\\s\\w\\p{L}]{8,128}+$/u'
					]
				],
				'category' => [
					'allow_null' => false,
					'filter' => FILTER_VALIDATE_INT,
					'options' => [
					]
				],
				'privacy' => [
					'allow_null' => true,
					'filter' => FILTER_VALIDATE_REGEXP,
					'options' => [
						'regexp' => '/^[0-9]{1}+$/'
					]
				],
				'status' => [
					'allow_null' => false,
					'filter' => FILTER_VALIDATE_INT,
					'options' => [
					]
				],
				'content' => [
					'allow_null' => false,
					'filter' => FILTER_VALIDATE_REGEXP,
					'options' => [
						'regexp' => '/[:punct:\\p{L}]/'
					]
				],
			]
		],
		'redact' => [
			'method' => 'POST',
			'authorize' => [
                'group' => 'Publish',
                // 'role' => 'Admin',
                'permission' => 'MANAGER_ARTICLES_EXEC',
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
				'title' => [
					'allow_null' => false,
					'filter' => FILTER_VALIDATE_REGEXP,
					'options' => [
						'regexp' => '/^[\\s\\w\\p{L}\\pP]{8,128}+$/u'
					]
				],
				'description' => [
					'allow_null' => false,
					'filter' => FILTER_VALIDATE_REGEXP,
					'options' => [
						'regexp' => '/^[\\s\\w\\p{L}\\pP]{32,255}+$/u'
					]
				],
				'image' => [
					'allow_null' => false,
					'filter' => FILTER_VALIDATE_URL,
					'options' => [
						
					]
				],
				'series' => [
					'allow_null' => true,
					'filter' => FILTER_VALIDATE_REGEXP,
					'options' => [
						'regexp' => '/^[\\s\\w\\p{L}]{8,128}+$/u'
					]
				],
				'category' => [
					'allow_null' => false,
					'filter' => FILTER_VALIDATE_INT,
					'options' => [
					]
				],
				'result' => [
					'allow_null' => false,
					'filter' => FILTER_VALIDATE_INT,
					'options' => [
					]
				],
				// 'privacy' => [
				// 	'allow_null' => true,
				// 	'filter' => FILTER_VALIDATE_REGEXP,
				// 	'options' => [
				// 		'regexp' => '/^[0-9]{1}+$/'
				// 	]
				// ],
				'content' => [
					'allow_null' => false,
					'filter' => FILTER_VALIDATE_REGEXP,
					'options' => [
						'regexp' => '/[:punct:\\p{L}]/'
					]
				],
				'actived_date' => [
					'allow_null' => true,
					'filter' => FILTER_VALIDATE_REGEXP,
					'options' => [
						'regexp' => '/[0-9]{4}\/[0-9]{2}\/[0-9]{2}[\\s]{1}[0-9]{2}\:[0-9]{2}\:[0-9]{2}/'
					]
				],
				'popularity' => [
					'allow_null' => false,
					'filter' => FILTER_VALIDATE_REGEXP,
					'options' => [
						'regexp' => '/[0-9]{1,3}/'
					]
				]
			]
		],
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
		$request->account_id = $this->__ACCOUNT__->id;
		$request->title = ucwords(strtolower(preg_replace('/[\s]{2,}+/',' ',$request->title)));
		$request->friendly = url_friendly($request->title);

		$request->series = ucwords(strtolower(preg_replace('/[\s]{2,}+/',' ',$request->series)));

		$this->getSeries($request->series);

		$request->category_id = $request->category;

		unset($request->id);
		unset($request->category);

		if($id == 0) {
			$insert = $this->MArticles->insert($request);	
		}
		else {
			$insert = $this->MArticles->update($request, array('id' => $id));	
		}
		
		// send mail to user
		$this->response(json_encode(set_response_data($insert)));
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
	public function redact()
	{
		$request = $this->__REQUEST_DATA__;
		$id = $request->id;
		$insert = array();

		// create new account
		$request->account_id = $this->__ACCOUNT__->id;
		$request->title = ucwords(strtolower(preg_replace('/[\s]{2,}+/',' ',$request->title)));
		$request->friendly = url_friendly($request->title);
		$request->series = ucwords(strtolower(preg_replace('/[\s]{2,}+/',' ',$request->series)));

		$this->getSeries($request->series);

		if(empty($request->actived_date)) {
			$request->actived_date = date('Y/m/d H:i:s');
		}

		$request->category_id = $request->category;

		unset($request->id);
		unset($request->category);

		if($id == 0) {
			$insert = $this->MArticles->insert($request);	
		}
		else {
			$insert = $this->MArticles->update($request, array('id' => $id));	
		}
		
		// send mail to user
		$this->response(json_encode(set_response_data($insert)));
	}

	/**
	 * Get Series Code
	 *
	 * If series is exist, return code of it
	 * Else insert new series and return code of it
	 */
	public function getSeries($name) {
		$series_code = md5(ucwords(strtolower(preg_replace('/[\s]{2,}+/',' ',$name))));

		$series = $this->MSeries->exists(array('code' => $series_code), 'id, user_id');

		if(!empty($series)) {
			$series = $series[0];

			if($series['user_id'] == $this->__ACCOUNT__->id) {
				return $series_code;
			}
			else {
				$this->_function_error('Tên loạt bài viết đã tồn tại');
			}
		}
		else {
			$new_series = array(
				'name' => $name,
				'code' => $series_code,
				'user_id' => $this->__ACCOUNT__->id,
				'friendly' => url_friendly($name)
			);
			
			$insert = $this->MSeries->insert($new_series);

			if($insert) {
				return $series_code;
			}
			else {
				$this->_function_error('Tạo mới loạt bài viết thất bại');
			}
		}
	}
}