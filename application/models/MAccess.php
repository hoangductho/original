<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MAccess extends MBase {
	/**
	 * Table name
	 */
	public $table = 'ACCESS';

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
		if($this->CI->agent->is_browser() || $this->CI->agent->is_mobile()) {
			$token = RandomString(32);
			// init log data
			$log = array(
				'account_id' => 0,
				'token' => $token,
				'algorithm' => $this->CI->config->item('algorithm_hashing'),
				'created_time' => time(),
				'ip' => $this->CI->input->ip_address(),
				'browser' => $this->CI->agent->browser(),
				'browser_version' => $this->CI->agent->version(),
				'mobile' => $this->CI->agent->mobile(),
				'platform' => $this->CI->agent->platform(),
				'referrer' => $this->CI->agent->referrer(),
				'user_agent' => $this->CI->agent->agent_string(),
				'languages' => json_encode($this->CI->agent->languages()),
				'remember' => 0
			);

			$this->insert($log);

			$log['id'] = $this->db->insert_id();

			$data = array(
				'session' => $log['id'],
				'account_id' => $log['account_id'],
				'created_time' => $log['created_time'],
				'end_time' => end_date($log['remember'], $log['created_time'], $this->CI->config->item('access_short_time'), $this->CI->config->item('access_long_time')),
				'token' => hash($log['algorithm'], $log['token'])
			);
			
			return base64_encode(json_encode($data));
		}
	}
	
}