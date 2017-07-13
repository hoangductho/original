<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Security extends MY_Controller {
	/**
	 * Rule to valid function
	 */
	public $rules = array(
		'rsakey' => array(
			'method' => 'GET',
			'authenticate' => false,
			'security' => false,
			'data' => [
				''
			]
		)
	);
	// ----------------------------------------------------------------
	/**
	 * ============================================
	 * Constructor
	 * ============================================
	 * 
	 * @todo construct all initilization value
	 */
	public function __construct() {
		parent::__construct();
	}
	// ----------------------------------------------------------------
	/**
	 * ======================================================
	 * Get RSA Public Key
	 * ======================================================
	 *
	 * @todo response rsa public key and hexa key for client 
	 */
	public function rsakey() {
		// create id for key
		$key['id'] = date('Ymd');
		// fields needed get
		$select = ['id', 'publicHex', 'public'];
		// get key from database
		$existed = $this->MRsakey->get($key, $select);

		if($existed['ok'] && count($existed['result'])) {
			$result = array('ok' => 1, 'result' => $existed['result'][0]);
		}elseif(!count($existed['result'])) {
			// init phpseclib
			$phpseclib = new Phpseclib();
			// create rsa keys
			$create = $phpseclib->rsaKeyInit();
			// setup create at time 
			$create['id'] = $key['id'];
			$create['created_at'] = date('Y/m/d h:i:s');
			try {
				// insert into database
				$insert = $this->MRsakey->insert($create);
				if($insert){
					// get rsa public key
					$key['public'] = $create['public'];
					$key['publicHex'] = $create['publicHex'];
					$result = array('ok' => 1, 'result' => $key);
				}else {
					$result = array('ok' => 0, 'message' => (ENVIRONMENT !== 'production')?$insert['errmsg']:'Data Error');	
				}	
			} catch (Exception $ex) {
				$result = array('ok' => 0, 'message' => (ENVIRONMENT !== 'production')?$ex:'Data Error');	
			}
		}else {
			$result = array('ok' => 0);
		}

		// log user connect
		$this->load->library('Visitor');
		$visitor = new Visitor();
		$visitor->log();

		// sent to client rsa key result
		echo json_encode($result, true);
	}
}