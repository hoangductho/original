<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MAccount extends MBase {
	// Live time (day) of active code
	public $livetime = 1;

	public $CI;

	public $dictionary;

	// ----------------------------------------------------------------
	/**
	 * --------------------------------------------
	 * Constructor
	 * --------------------------------------------
	 */
	function __construct() {
		parent::__construct();
		$this->table = "ACCOUNT";
		$this->CI = & get_instance();
		$this->dictionary = (object) $this->CI->config->item('dictionary');
	}

	/**
	 * --------------------------------------------
	 * Get All Active User
	 * --------------------------------------------
	 */
	public function getAllAccount() {
		$filter = [
			'deleted' => 0,
			'status' => 1
		];

		return $this->get($filter);
	}

	/**
	 * --------------------------------------------
	 * Create Active Code
	 * --------------------------------------------
	 *
	 * @todo Create the active code for the function.
	 *
	 * @param array user info
	 *
	 * @return string active code
	 */
	public function create_active_code($user) {
		$seclib = new Phpseclib();
		$time = time();

		$code = array(
			'email' => $user['email'],
			'start_date' => $time,
			'end_date' => create_out_date($time, $this->livetime)
		);

		$code['code'] = hash_hmac('sha1', json_encode($code), $user['password']);

		return urlencode(base64_encode(json_encode($code)));
	}

	/**
	 * --------------------------------------------
	 * Check Active Code
	 * --------------------------------------------
	 */
	public function validate_active_code($code) {
		$code = json_decode(base64_decode(urldecode($code)), true);	

		// active code invalid format
		if(!isset($code['email']) || !isset($code['start_date']) || !isset($code['end_date']) || !isset($code['code'])) {
			$this->CI->_error($this->CI::SRV_ACCOUNT_CODE_INVALID, $this->CI::HTTP_OK);
			return -1;
		}

		// active code out of date
		if($code['end_date'] != create_out_date($code['start_date'], $this->livetime) || $code['end_date'] < time()) {
			$this->CI->_error($this->CI::SRV_ACCOUNT_CODE_TIMEOUT, $this->CI::HTTP_OK);
			return -2;
		}

		// get user info
		$exists = $this->exists(array('email' => $code['email']), array('id', 'email', 'password', 'status'));

		// email not found
		if(!$exists) {
			$this->CI->_error($this->CI::SRV_ACCOUNT_NOT_FOUND, $this->CI::HTTP_OK);
			return -3;
		}

		$user = $exists[0];

		return $user;
	}

	/**
	 * --------------------------------------------
	 * Active account
	 * --------------------------------------------
	 */
	public function active_account($code) {
		$user = $this->validate_active_code($code);

		// active account
		if($user['status'] == $this->dictionary->account_status['pending']) {
			$update = $this->update(array('status' => 1), array('id' => $user['id']));
			if(!$update) {
				$this->CI->_error($this->CI::SRV_ACCOUNT_ACTIVE_ERR, $this->CI::HTTP_OK);
			}

			return $user;
		} else {
			return true;
		}
	}

	/**
	 * --------------------------------------------
	 * Reset password
	 * --------------------------------------------
	 */
	public function reset_password($code, $password) {
		$user = $this->validate_active_code($code);

		// active account
		if($user && is_array($user)) {
			$update = $this->update(array('password' => $password), array('id' => $user['id']));
			if(!$update) {
				$this->CI->_error($this->CI::SRV_ACCOUNT_ACTIVE_ERR, $this->CI::HTTP_OK);
			}

			return $user;
		} else {
			return true;
		}
	}
	/**
	 * --------------------------------------------
	 * Change password
	 * --------------------------------------------
	 */
	public function change_password($current, $password, $account_id) {
		$filter = array(
			'id' => $account_id, 
			'password' => $current
		);

		$user = $this->exists($filter);

		if($user) {
			$update = $this->update(array('password' => $password), $filter);
			if(!$update) {
				$this->CI->_error($this->CI::SRV_ACCOUNT_ACTIVE_ERR, $this->CI::HTTP_OK);
			}

			return $update;
		} else {
			$this->CI->_error($this->CI::SRV_ACCOUNT_PASSWORD_INVALID, $this->CI::HTTP_OK);
		}
	}

	/**
	 * --------------------------------------------
	 * Check account exist with status
	 * --------------------------------------------
	 *
	 * @todo check account existed and compare account status with the status checking
	 */
	public function account_exist_status($email, $status, $select = null) {
		if(empty($select)) {
			$select = array('id', 'email', 'firstname', 'lastname', 'status');
		}

		$exists = $this->MAccount->exists(array('email' => $email), $select);

		if(!$exists) {
			$this->CI->_error($this->CI::SRV_ACCOUNT_NOT_FOUND, $this->CI::HTTP_OK);
		}

		$exists = $exists[0];

		if($exists['status'] ==  $this->dictionary->account_status[$status]) {
			return (object) $exists;
		}

		if($exists['status'] == $this->dictionary->account_status['pending']) {
			$this->CI->_error($this->CI::SRV_ACCOUNT_NOT_ACTIVE, $this->CI::HTTP_OK);	
		}

		if($exists['status'] == $this->dictionary->account_status['active']) {
			$this->CI->_error($this->CI::SRV_ACCOUNT_NOT_ACTIVE, $this->CI::HTTP_OK);	
		}

		if($exists['status'] == $this->dictionary->account_status['deactive']) {
			$this->CI->_error($this->CI::SRV_ACCOUNT_DEACTIVED, $this->CI::HTTP_OK);	
		}

		if($exists['status'] == $this->dictionary->account_status['banned']) {
			$this->CI->_error($this->CI::SRV_ACCOUNT_BANNED, $this->CI::HTTP_OK);	
		}

		if($exists['status'] == $this->dictionary->account_status['blocked']) {
			$this->CI->_error($this->CI::SRV_ACCOUNT_BLOCKED, $this->CI::HTTP_OK);	
		}

		return false;
	}
	/**
	 * --------------------------------------------
	 * Check account id exist with status
	 * --------------------------------------------
	 *
	 * @todo check account existed and compare account status with the status checking
	 */
	public function account_id_exist_status($id, $status) {
		$exists = $this->MAccount->exists(array('id' => $id), array('id', 'email', 'firstname', 'lastname', 'status', 'password'));

		if(!$exists) {
			$this->CI->_error($this->CI::SRV_ACCOUNT_NOT_FOUND, $this->CI::HTTP_OK);
		}

		$exists = $exists[0];

		if($exists['status'] ==  $this->dictionary->account_status[$status]) {
			return (object) $exists;
		}

		if($exists['status'] == $this->dictionary->account_status['pending']) {
			$this->CI->_error($this->CI::SRV_ACCOUNT_NOT_ACTIVE, $this->CI::HTTP_OK);	
		}

		if($exists['status'] == $this->dictionary->account_status['active']) {
			$this->CI->_error($this->CI::SRV_ACCOUNT_NOT_ACTIVE, $this->CI::HTTP_OK);	
		}

		if($exists['status'] == $this->dictionary->account_status['deactive']) {
			$this->CI->_error($this->CI::SRV_ACCOUNT_DEACTIVED, $this->CI::HTTP_OK);	
		}

		if($exists['status'] == $this->dictionary->account_status['banned']) {
			$this->CI->_error($this->CI::SRV_ACCOUNT_BANNED, $this->CI::HTTP_OK);	
		}

		if($exists['status'] == $this->dictionary->account_status['blocked']) {
			$this->CI->_error($this->CI::SRV_ACCOUNT_BLOCKED, $this->CI::HTTP_OK);	
		}

		return false;
	}
}