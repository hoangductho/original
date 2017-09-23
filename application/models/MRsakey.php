<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MRsakey extends MBase {
	/**
	 * Table name
	 */
	public $table = 'RSAKEY';

	// ----------------------------------------------------------------
	/**
	 * --------------------------------------------
	 * Constructor
	 * --------------------------------------------
	 */
	function __construct() {
		parent::__construct();
	}
	// ------------------------------------------------------------
	/**
	 * ----------------------------------------
	 * Create Access token
	 * ----------------------------------------
	 * 
	 * @todo Logging user agent into log visitor table
	 *
	 * @param array $log 
	 */
	public function create() {
		// create id for key
		$key['id'] = date('Ymd');
		// fields needed get
		$select = ['publicHex', 'public'];
		// get key from database
		$existed = $this->exists($key, $select);
		
		if(!$existed) {
			// init phpseclib
			$phpseclib = new Phpseclib();
			// create rsa keys
			// $create = $phpseclib->rsaKeyInit();
			$create = $this->opensslCreate();
			// setup create at time 
			$create['id'] = $key['id'];

			

			try {
				// insert into database
				$insert = $this->insert($create);
				if($insert){
					// get rsa public key
					$key['public'] = $create['public'];
					$key['publicHex'] = $create['publicHex'];
					$result = array('ok' => 1, 'key' => $key);
				}else {
					$result = array('ok' => 0, 'message' => (ENVIRONMENT !== 'production')?$insert['errmsg']:'Data Error');	
				}	
			} catch (Exception $ex) {
				$result = array('ok' => 0, 'message' => (ENVIRONMENT !== 'production')?$ex:'Data Error');	
			}
		}else {
			$result = array('ok' => 1, 'key' => $existed[0]);
		}

		// sent to client rsa key result
		return $result;
	}
	/**
	 * Create RSA KEYPAIR
	 * --------------------------------------------
	 */
	public function opensslCreate() {
		$config = array(
		    "digest_alg" => "sha512",
		    "private_key_bits" => 1024,
		    "private_key_type" => OPENSSL_KEYTYPE_RSA,
		);
		    
		// Create the private and public key
		$res = openssl_pkey_new($config);

		// Extract the private key from $res to $privKey
		openssl_pkey_export($res, $privKey);

		// Extract the public key from $res to $pubKey
		$pubKey = openssl_pkey_get_details($res);


		$create['public'] = $pubKey["key"];
		$create['publicHex'] = bin2hex($pubKey["rsa"]["n"]);
		$create['private'] = $privKey;

		return $create;
	}
	
}