<?php
(defined('BASEPATH')) or exit('No direct script access allowed');

/* load the REST_Controller class */
require APPPATH . 'third_party/REST/REST_Controller.php';

class MY_Controller extends REST_Controller {
  /**
   * Rules Errors
   */
  const SRV_RULE_UNDEFINED = 10001;
  const SRV_FUNCTION_UNDEFINED = 10002;
  const SRV_METHOD_UNDEFINED = 10003;
  const SRV_METHOD_INVALID = 10004;
  const SRV_NON_SECURITY_INFORMATION = 10005;
  const SRV_NON_AUTHORITATIVE_INFORMATION = 10006;
  const SRV_NON_SECURITY_AESKEY = 10007;
  const SRV_NON_SECURITY_RSAKEY = 10008;
  const SRV_SECURITY_RSA_UNPROCESSABLE = 10009;
  const SRV_SECURITY_AES_UNPROCESSABLE = 10010;
  const SRV_SECURITY_FAILED = 10011;

  /**
   * Authenticate Errors
   */
  const SRV_AUTHENTICATION_TIMEOUT = 10100;
  const SRV_AUTHENTICATION_INVALID = 10101;
  const SRV_USER_NOT_FOUND = 10102;
  const SRV_PASSWORD_CHANGED = 10103;
  const SRV_USER_UNAVAILABLE = 10104;

  /**
   * Validate Errors
   */
  const SRV_INPUT_REQUIRED = 10201;
  const SRV_INPUT_NOT_ALLOWED = 10202;
  const SRV_DATA_REQUIRED = 10203;
  const SRV_DATA_INVALID = 10204;

  /**
   * Account Code
   */
  // Validate active code
  const SRV_ACCOUNT_CODE_INVALID = 20001;
  const SRV_ACCOUNT_CODE_TIMEOUT = 20002;
  const SRV_ACCOUNT_NOT_FOUND = 20003;
  const SRV_ACCOUNT_ACTIVE_ERR = 20004;
  const SRV_ACCOUNT_NOT_ACTIVE = 20005;
  const SRV_ACCOUNT_ACTIVED = 20009;
  const SRV_ACCOUNT_DEACTIVED = 20006;
  const SRV_ACCOUNT_BANNED = 20007;
  const SRV_ACCOUNT_BLOCKED = 20008;
  const SRV_ACCOUNT_PASSWORD_INVALID = 20009;
  const SRV_ACCOUNT_SIGNED_IN = 20010;
  const SRV_ACCOUNT_NON_PERMISSION = 20011;

  /**
   * Database Error
   */
  const SRV_DATABASE_UPDATE_FAILED = 30000;


  /**
   * Data request
   */
  protected $__REQUEST_DATA__;

  /**
   * Define rules of function
   */ 
  protected $__RULES__;

  /**
   * Class name of controller
   */
  protected $__CLASS__;
  /**
   * Controller's function requested
   */
  protected $__FUNCTION__;
  /**
   * Is Service
   */
  protected $__ISSERVICE__ = TRUE;
  /**
   * Account info
   */
  public $__ACCOUNT__;
  /**
   * Access token
   */
  public $__TOKEN__;
  /**
   * Authenticate 
   */
  protected $__IS_AUTH__ = FALSE;

  /**
   * Constructor
   */
  public function __construct($config = 'services') {
    // run parent constructor
    parent::__construct();

    // load services config 
    $this->load->config($config);

    // init default value
    $this->_init_default();

    // check rule
    $this->_protect_rule();

    $this->_set_cookie_data();

    // protected access
    $this->_access_token_info();

    // check authenticate
    $this->_check_auth();

    // check permission
    $this->_protect_permission();

    $this->load->__DICT__ = $this->config->item('dictionary');

    if(!empty($this->__ACCOUNT__)) {
      $layout_data = [
        'profile' => (array)$this->__ACCOUNT__
      ];
      
      $this->load->layout($layout_data);
    }
  }

  // ----------------------------------------------------------------
  /**
   * --------------------------------------------
   * Set Data
   * --------------------------------------------
   */
  protected function _init_default() {
    $router = $this->router;

    $this->__FUNCTION__ = $router->method;

    $this->__CLASS__ = $router->class;

    return $this;
  }

  // ----------------------------------------------------------------
  /**
   * --------------------------------------------
   * Get message 
   * --------------------------------------------
   *
   * Get message reference language with code
   */
  protected function _get_message($code) {
    $config = $this->config->config;

    $language = $config['services_language'];

    $this->lang->load('services_message', $language);

    $messages = $this->lang->language;

    if(!empty($messages) ) {

      if(is_int($code) && !empty($messages['SRV-'.$code])) {
        return $messages['SRV-'.$code];
      }
      else {
        return $messages[$code];
      }
    }

    return null;
  }

  // ----------------------------------------------------------------
  /**
   * --------------------------------------------
   * Services Error message
   * --------------------------------------------
   * 
   */
  public function _error($code, $http_code = 404, $key = '') {
    if($this->__ISSERVICE__) {
      // Set the response and exit
      $this->response(set_response_data(FALSE, $code, str_replace(':key', $key, self::_get_message($code))), $http_code); // NOT_FOUND (404) being the HTTP response code
      exit();
    }
    else {
      if($http_code == 404) {
        show_404();
      }
      else {
        show_error(self::_get_message($code), $http_code);
      }
    }
  }

  // ----------------------------------------------------------------
  /**
   * ----------------------------------------------
   * Function Error Message
   * ----------------------------------------------
   *
   */
  public function _function_error($message) {
    // Set the response and exit
    $this->response(set_response_data(FALSE, self::SRV_DATA_INVALID, $message), 200); // NOT_FOUND (404) being the HTTP response code
    exit();
  }

  // ----------------------------------------------------------------
  /**
   * --------------------------------------------
   * Get Rules
   * --------------------------------------------
   *
   * Get $rules variable of controller class.
   *
   * $rules using to define action in controller
   */
  protected function _get_rule() {
    // Rule not defined
    if(empty($this->__RULES__)){
      self::error(self::SRV_RULE_UNDEFINED, self::HTTP_SERVICE_UNAVAILABLE);
    }

    // Function not defined
    if(!isset($this->__RULES__[$this->__FUNCTION__])) {
      self::_error(self::SRV_FUNCTION_UNDEFINED, self::HTTP_NOT_FOUND);
    }

    return (object) $this->__RULES__[$this->__FUNCTION__];
  }

  // ------------------------------------------------------------------
  /**
   * ----------------------------------------------
   * Protect Rule
   * ----------------------------------------------
   *
   * Validate rule with request
   */
  protected function _protect_rule () {
    // get rule of function
    $rules = self::_get_rule();

    // HTTP method undefined
    if(empty($rules->method)) {
      self::_error(self::SRV_METHOD_UNDEFINED, self::HTTP_METHOD_NOT_ALLOWED);
    }

    // HTTP method invalid
    if(strtoupper($rules->method) != $this->input->method(true)) {
      self::_error(self::SRV_METHOD_INVALID, self::HTTP_METHOD_NOT_ALLOWED);
    }

    // check authenticate required
    if(!empty($rules->authenticate) && $rules->authenticate && empty($this->input->get_request_header('Authenticate'))) {
      self::_error(self::SRV_NON_AUTHORITATIVE_INFORMATION, self::HTTP_NON_AUTHORITATIVE_INFORMATION);
    }

    // Authentication Protect
    // self::_protect_authenticate();

    // validate request data
    self::_validate_request_data();

  }
  // ------------------------------------------------------------------
  /**
   * ----------------------------------------------
   * Check Authenticate
   * ----------------------------------------------
   */
  protected function _protect_authenticate() {
    // check authenticate required
    $rules = $this->_get_rule();
    if((!empty($rules->authenticate) && $rules->authenticate) || $this->__IS_AUTH__) {
      // get rules of function

      $authEncrypt = $this->__ISSERVICE__ ? $this->input->get_request_header('session_token') : $_COOKIE['session_token'];

      $authInfo = null;

      if(empty($authEncrypt)) {
        self::_error(self::SRV_AUTHENTICATION_INVALID, self::HTTP_UNAUTHORIZED);
      }

      if(!empty($rules->security)) {
        // init phpseclib
        //$phpseclib = new Phpseclib();

        // decrypt authenticate data
        //$authInfo = json_decode($phpseclib->aesDecryptCryptoJS($authEncrypt, $this->controller->aes['key'], $this->controller->__AES__['iv']), true);  

        $authInfo = json_decode(base64_decode($authEncrypt), true);
      }
      else {
        $authInfo = json_decode(base64_decode($authEncrypt), true);
      }
      
      // get current time
      $datetime = date('yyyy/mm/dd H:i:s');
      // check expired
      if($authInfo['end_time'] < $datetime) {
        self::_error(self::SRV_AUTHENTICATION_TIMEOUT, self::HTTP_UNAUTHORIZED);
      }
      // create check conditions
      $where = array(
        // 'token' => (!empty($authInfo['token'])) ? $authInfo['token'] : 0,
        'id' => $authInfo['session'],
        'account_id' => (!empty($authInfo['account_id'])) ? $authInfo['account_id'] : 0,
        'created_time' => $authInfo['created_time'],
        // 'live_time' => $authInfo['end_time'],
        'ip' => $this->input->ip_address(),
        'browser' => $this->agent->browser(),
        'mobile' => $this->agent->mobile(),
        'platform' => $this->agent->platform(),
      );
      // get access_token
      $access_token = $this->MAccess->exists($where, 'id, ip, account_id, password');
      // check authenticate
      if(!$access_token) {

        self::_error(self::SRV_AUTHENTICATION_INVALID, self::HTTP_UNAUTHORIZED);
      }
      // get user info
      if($user = $this->MUser->exists(array('_id' => $this->Extend->CreateID($authInfo['email'])), '*')) {
        $user = $user[0];
        // check password changed
        if(!empty($access_token[0]['password']) && $access_token[0]['password'] != $user['password']) {
          self::_error(self::SRV_PASSWORD_CHANGED, self::HTTP_UNAUTHORIZED);
        }
        // get status code
        $actived_status = $this->config->item('account_status')->actived;
        // continue proccessing
        if(!empty($user['status']) && $user['status'] === $actived_status)
          $this->__ACCOUNT__ = $user;
        else {
          self::_error(self::SRV_USER_UNAVAILABLE, self::HTTP_UNAUTHORIZED);
        }
      }else {
        self::_error(self::SRV_USER_NOT_FOUND, self::HTTP_UNAUTHORIZED);
      }
    }
  }
  // ----------------------------------------------------------------
  /**
   * --------------------------------------------
   * Raw Request Data
   * --------------------------------------------
   *
   */
  protected function _raw_request_data() {
    return (object) $this->{'_'.$this->request->method.'_args'};
  }
  // ----------------------------------------------------------------
  /**
   * --------------------------------------------
   * Get Request Data
   * --------------------------------------------
   */
  protected function _protected_data() {
    // check encrypt data required
    if(!empty($rules->security) && $rules->security && empty($this->__REQUEST_DATA__['encrypt'])) {
      self::_error(self::SRV_NON_SECURITY_INFORMATION, self::HTTP_UNPROCESSABLE_ENTITY);
    }

    $data = $this->__REQUEST_DATA__;

    $dataSecKey = $data->encrypt;

    if(!empty($dataSecKey)) {
      // create id for key
      $key['id'] = $data->expired;
      // fields needed get
      $select = ['id', 'private', 'public'];
      // get key from database
      $rsaKeypair = $this->MRsakey->exists($key, $select);

      if($rsaKeypair && count($rsaKeypair)) {
        // init phpseclib
        $phpseclib = new Phpseclib();

        try {
          // RSA descrypt to read AES keypair
          // $aesKeypair = $phpseclib->rsaDecryptCryptoJS($dataSecKey, $rsaKeypair[0]['private']);
          openssl_private_decrypt(base64_decode($dataSecKey), $aesKeypair, $rsaKeypair[0]['private']);

          if(empty($aesKeypair)) {
            self::_error(self::SRV_NON_SECURITY_AESKEY, self::HTTP_PRECONDITION_REQUIRED);
          }
          // Regexp of AES Keypair
          $aesKeyRegexp = array('options' => array('regexp' => '/^[a-f0-9]{64}+(\/)+[a-f0-9]{32}$/'));

          // get AES Keypair
          if( filter_var($aesKeypair, FILTER_VALIDATE_REGEXP, $aesKeyRegexp)) {
            // explode aes key and init vector
            list($aesKey, $aesIV) = explode('/', $aesKeypair);
            // set aes keypair for controller
            $this->__AES__ = array('key' => $aesKey, 'iv' => $aesIV);

            // AED decrypt to read data posted
            if(!empty($data->encrypted)) {
              // data decrypted
              $dataDecrypted = $phpseclib->aesDecryptCryptoJS($data->encrypted, $aesKey, $aesIV);
              
              if(!$dataDecrypted) {
                self::_error(self::SRV_SECURITY_AES_UNPROCESSABLE, self::HTTP_PRECONDITION_REQUIRED);
              }

              // set request data for controller
              $this->__REQUEST_DATA__ = (object) json_decode($dataDecrypted, true);
              
            }else {
              self::_error(self::SRV_SECURITY_RSA_UNPROCESSABLE, self::HTTP_PRECONDITION_REQUIRED); 
            }
          }else {
            self::_error(self::SRV_NON_SECURITY_AESKEY, self::HTTP_PRECONDITION_REQUIRED);  
          }
        } catch (Exception $e) {
          self::_error(self::SRV_SECURITY_FAILED, self::HTTP_PRECONDITION_REQUIRED); 
        }
      }
      else {
        self::_error(self::SRV_NON_SECURITY_RSAKEY, self::HTTP_UNPROCESSABLE_ENTITY);
      }
    }else{
      self::_error(self::SRV_NON_SECURITY_AESKEY, self::HTTP_UNPROCESSABLE_ENTITY);
    }
  }
  // ----------------------------------------------------------------
  /**
   * --------------------------------------------
   * Validate Posted Data
   * --------------------------------------------
   *
   * Validate posted data using standard defined by rules
   *
   * If data don't defined in rules will be unload in controller
   */
  protected function _validate_request_data() {
    // get rules of function
    $rules = $this->_get_rule();

    $this->__REQUEST_DATA__ = $this->_raw_request_data();

    if(!empty($rules->data) && empty($this->__REQUEST_DATA__)) {
      self::_error(self::SRV_INPUT_REQUIRED, self::HTTP_BAD_REQUEST);
    }

    if(!isset($rules->data) && !empty($this->__REQUEST_DATA__)) {
      self::_error(self::SRV_INPUT_NOT_ALLOWED, self::HTTP_BAD_REQUEST);
    }

    // decrypt protected data 
    if((!empty($rules->security) && $rules->security) || ($this->__ISSERVICE__ && empty($rules->security))) {
      $this->_protected_data();
      // var_dump($this->__REQUEST_DATA__); exit();
    }

    // if data inputed
    if(!empty($this->__REQUEST_DATA__) && !empty($rules->data)) {

      // data return
      $validate = (object) array();
      
      foreach ($rules->data as $key => $value) {
        if((!isset($this->__REQUEST_DATA__->{$key}) || $this->__REQUEST_DATA__->{$key} == null) && (empty($value['allow_null']) || !$value['allow_null'])) {
          self::_error(self::SRV_DATA_REQUIRED, self::HTTP_BAD_REQUEST, $key);
        }

        // data need check
        $inputed = null;
        if(isset($this->__REQUEST_DATA__->{$key})) {
          $inputed = $this->__REQUEST_DATA__->{$key};
        }

        // if data filter type defined
        if(!empty($value['filter'])) {
          // options filter
          $options = (!empty($value['options']))?$value['options']:array();
          
          // filter data
          $filter = filter_var($inputed, $value['filter'], array('options' => $options));
          
          if(($filter !== false || ($value['filter'] == FILTER_VALIDATE_INT && $filter === 0)) || ((!empty($value['allow_null']) && $value['allow_null']) && empty($inputed))) {
            $validate->{$key} = $inputed;
          }else {
            self::_error(self::SRV_DATA_INVALID, self::HTTP_BAD_REQUEST, $key);
          }
        }else {
          $validate->{$key} = $inputed;
        }
      }

      $this->__REQUEST_DATA__ = $validate;
    }

    return $this->__REQUEST_DATA__;
  }
  
  /**
     * Requests are not made to methods directly, the request will be for
     * an "object". This simply maps the object and method to the correct
     * Controller method
     *
     * @access public
     * @param string $object_called
     * @param array $arguments The arguments passed to the controller method
     */
    public function _remap($object_called, $arguments = [])
    {
        // Should we answer if not over SSL?
        if ($this->config->item('force_https') && $this->request->ssl === FALSE)
        {
            $this->response([
                    $this->config->item('rest_status_field_name') => FALSE,
                    $this->config->item('rest_message_field_name') => $this->lang->line('text_rest_unsupported')
                ], self::HTTP_FORBIDDEN);
        }

        // Remove the supported format from the function name e.g. index.json => index
        $object_called = preg_replace('/^(.*)\.(?:'.implode('|', array_keys($this->_supported_formats)).')$/', '$1', $object_called);

        $controller_method = $object_called;
      // Does this method exist? If not, try executing an index method
      if (!method_exists($this, $controller_method)) {
        $controller_method = "index";
        array_unshift($arguments, $object_called);
      }

        // Do we want to log this method (if allowed by config)?
        $log_method = ! (isset($this->methods[$controller_method]['log']) && $this->methods[$controller_method]['log'] === FALSE);

        // Use keys for this method?
        $use_key = ! (isset($this->methods[$controller_method]['key']) && $this->methods[$controller_method]['key'] === FALSE);

        // They provided a key, but it wasn't valid, so get them out of here
        if ($this->config->item('rest_enable_keys') && $use_key && $this->_allow === FALSE)
        {
            if ($this->config->item('rest_enable_logging') && $log_method)
            {
                $this->_log_request();
            }
            
            // fix cross site to option request error 
            if($this->request->method == 'options') {
                exit;
            }

            $this->response([
                    $this->config->item('rest_status_field_name') => FALSE,
                    $this->config->item('rest_message_field_name') => sprintf($this->lang->line('text_rest_invalid_api_key'), $this->rest->key)
                ], self::HTTP_FORBIDDEN);
        }

        // Check to see if this key has access to the requested controller
        if ($this->config->item('rest_enable_keys') && $use_key && empty($this->rest->key) === FALSE && $this->_check_access() === FALSE)
        {
            if ($this->config->item('rest_enable_logging') && $log_method)
            {
                $this->_log_request();
            }

            $this->response([
                    $this->config->item('rest_status_field_name') => FALSE,
                    $this->config->item('rest_message_field_name') => $this->lang->line('text_rest_api_key_unauthorized')
                ], self::HTTP_UNAUTHORIZED);
        }

        // Sure it exists, but can they do anything with it?
        if (! method_exists($this, $controller_method))
        {
            $this->response([
                    $this->config->item('rest_status_field_name') => FALSE,
                    $this->config->item('rest_message_field_name') => $this->lang->line('text_rest_unknown_method')
                ], self::HTTP_METHOD_NOT_ALLOWED);
        }

        // Doing key related stuff? Can only do it if they have a key right?
        if ($this->config->item('rest_enable_keys') && empty($this->rest->key) === FALSE)
        {
            // Check the limit
            if ($this->config->item('rest_enable_limits') && $this->_check_limit($controller_method) === FALSE)
            {
                $response = [$this->config->item('rest_status_field_name') => FALSE, $this->config->item('rest_message_field_name') => $this->lang->line('text_rest_api_key_time_limit')];
                $this->response($response, self::HTTP_UNAUTHORIZED);
            }

            // If no level is set use 0, they probably aren't using permissions
            $level = isset($this->methods[$controller_method]['level']) ? $this->methods[$controller_method]['level'] : 0;

            // If no level is set, or it is lower than/equal to the key's level
            $authorized = $level <= $this->rest->level;
            // IM TELLIN!
            if ($this->config->item('rest_enable_logging') && $log_method)
            {
                $this->_log_request($authorized);
            }
            if($authorized === FALSE)
            {
                // They don't have good enough perms
                $response = [$this->config->item('rest_status_field_name') => FALSE, $this->config->item('rest_message_field_name') => $this->lang->line('text_rest_api_key_permissions')];
                $this->response($response, self::HTTP_UNAUTHORIZED);
            }
        }

        //check request limit by ip without login
        elseif ($this->config->item('rest_limits_method') == "IP_ADDRESS" && $this->config->item('rest_enable_limits') && $this->_check_limit($controller_method) === FALSE)
        {
            $response = [$this->config->item('rest_status_field_name') => FALSE, $this->config->item('rest_message_field_name') => $this->lang->line('text_rest_ip_address_time_limit')];
            $this->response($response, self::HTTP_UNAUTHORIZED);
        }

        // No key stuff, but record that stuff is happening
        elseif ($this->config->item('rest_enable_logging') && $log_method)
        {
            $this->_log_request($authorized = TRUE);
        }

        // Call the controller method and passed arguments
        try
        {
            call_user_func_array([$this, $controller_method], $arguments);
        }
        catch (Exception $ex)
        {
            if ($this->config->item('rest_handle_exceptions') === FALSE) {
                throw $ex;
            }

            // If the method doesn't exist, then the error will be caught and an error response shown
          $_error = &load_class('Exceptions', 'core');
          $_error->show_exception($ex);
        }
    }

  /**
   * ----------------------------------------------
   * Set response data
   * ----------------------------------------------
   * 
   * @access protected
   * @param status bool status of action
   * @param code int error code
   * @param message content 
   */
  protected static function _set_response_data($status, $code = 1, $message = null) {
    $response = array(
        'status' => $status,
        'code' => $code,
        'message' => $message
      );

    return $response;
  }

  /**
   * ----------------------------------------------
   * Set Default Data
   * ----------------------------------------------
   */
  private function _set_cookie_data() {
    if(!$this->__ISSERVICE__) {
      if(!$this->_access_token_cookie()) {
        setcookie('session_token',$this->MAccess->create(), time() + (86400 * 30), '/');  
      } else {
        setcookie('session_token', base64_encode(json_encode($this->__TOKEN__)), time() + (86400 * 30), '/');  
      }
    }

    if($this->__ISSERVICE__ == false && empty($_COOKIE['rsakey'])) {
      $time = strtotime(date('Y-m-d 23:59:59'));

      $create = $this->MRsakey->create();
      
      setcookie('publickey', $create['key']['public'], $time, '/');
      setcookie('publicHexkey', $create['key']['publicHex'], $time, '/');
      setcookie('expired_key', date('Ymd'), $time, '/');
    }
  }

  /** 
   * ----------------------------------------------
   * get token info
   * ----------------------------------------------
   */
  private function _access_token_info() {
    $rules = $this->_get_rule();
    $token = $this->__ISSERVICE__ ? $this->input->get_request_header('session_token') : (isset($_COOKIE['session_token']) ? $_COOKIE['session_token'] : null);
    $is_check_auth = false;

    // if((empty($rules->authenticate) || !$rules->authenticate) && !$this->__IS_AUTH__) {
    //   $is_check_auth = true;
    // }

    if((!empty($rules->authenticate) && $rules->authenticate) || $this->__IS_AUTH__) {
      if(empty($token)) {
        self::_error(self::SRV_AUTHENTICATION_INVALID, self::HTTP_UNAUTHORIZED);
      }
      else {
        $is_check_auth = true;
      }
    }
    
    

    $token = json_decode(base64_decode(urldecode($token)), true);
        
    // check token id
    if((!isset($token['session']) || !filter_var($token['session'], FILTER_VALIDATE_INT)) && $is_check_auth) {

      $this->_error(self::SRV_NON_AUTHORITATIVE_INFORMATION, self::HTTP_OK);
    }

    // check account id
    if((!isset($token['account_id']) || filter_var($token['account_id'], FILTER_VALIDATE_INT) === false) && $is_check_auth) {
      $this->_error(self::SRV_NON_AUTHORITATIVE_INFORMATION, self::HTTP_OK);
    }    

    // check created time
    if((!isset($token['created_time']) || !filter_var($token['created_time'], FILTER_VALIDATE_INT)) && $is_check_auth) {
      $this->_error(self::SRV_NON_AUTHORITATIVE_INFORMATION, self::HTTP_OK);
    }

    // check expired time
    if((!isset($token['end_time']) || !filter_var($token['end_time'], FILTER_VALIDATE_INT)) && $is_check_auth) {
      $this->_error(self::SRV_NON_AUTHORITATIVE_INFORMATION, self::HTTP_OK);
    } 
    else if($this->__IS_AUTH__ && $token['end_time'] < time() && $is_check_auth) {
      $this->_error(self::SRV_AUTHENTICATION_TIMEOUT, self::HTTP_OK);
    }


    $filter['id'] = $token['session'];
    $filter['created_time'] = $token['created_time'];
    $filter['account_id'] = $token['account_id'];

    $exist = $this->MAccess->exists($filter, '*');

    $exist = $exist[0];

    // check token info
    if((!$exist || hash($exist['algorithm'], $exist['token']) != $token['token']) && $is_check_auth) {
      $this->_error(self::SRV_AUTHENTICATION_INVALID, self::HTTP_OK);
    }

    // get account info
    if ($token['account_id'] != 0) {
      $account = $this->MAccount->account_id_exist_status($token['account_id'], 'active');

      if(!$account && $is_check_auth) {
        $this->_error(self::SRV_ACCOUNT_NOT_FOUND, self::HTTP_OK);
      }

      if(!empty($exist['password']) && $exist['password'] != $account->password && $is_check_auth) {
        self::_error(self::SRV_PASSWORD_CHANGED, self::HTTP_UNAUTHORIZED);
      }else {
        unset($account->password);
      }

      $this->__ACCOUNT__ = $account;
    }

    $this->__TOKEN__ = $token;
  }

  /**
   * ----------------------------------------------
   * Access token cookie
   * ----------------------------------------------
   */
  protected function _access_token_cookie() {
    if(!isset($_COOKIE['session_token'])) {
      return false;
    }
    else {
      $token = $_COOKIE['session_token'];

      $token = json_decode(base64_decode($token), true);

      // check token id
      if(!isset($token['session']) || !filter_var($token['session'], FILTER_VALIDATE_INT)) {
        return false;
      }

      // check account id
      if(!isset($token['account_id']) || filter_var($token['account_id'], FILTER_VALIDATE_INT) === false) {
        return false;
      }    

      // check created time
      if(!isset($token['created_time']) || !filter_var($token['created_time'], FILTER_VALIDATE_INT)) {
        return false;
      }

      // check expired time
      if(!isset($token['end_time']) || !filter_var($token['end_time'], FILTER_VALIDATE_INT)) {
        return false;
      } 
      else if($token['end_time'] < time()) {
        return false;
      }


      $filter['id'] = $token['session'];
      $filter['created_time'] = $token['created_time'];
      $filter['account_id'] = $token['account_id'];

      $exist = $this->MAccess->exists($filter, '*');

      $exist = $exist[0];

      // check token info
      if(!$exist || hash($exist['algorithm'], $exist['token']) != $token['token']) {
        return false;
      }

      // get account info
      if ($token['account_id'] != 0) {
        $account = $this->MAccount->account_id_exist_status($token['account_id'], 'active');

        if(!$account) {
          return false;
        }

        $this->__ACCOUNT__ = $account;
      }

      $token['end_time'] = end_date($exist['remember'], time(), $this->config->item('access_short_time'), $this->config->item('access_long_time'));

      $this->__TOKEN__ = $token;

      return true;
    }
  }
  /**
   * ----------------------------------------------
   * Protect Authenticate
   * ----------------------------------------------
   */
  protected function _check_auth() {
    if($this->__IS_AUTH__ && empty($this->__ACCOUNT__)) {
      if($this->__ISSERVICE__) {
        $this->_error(self::SRV_NON_AUTHORITATIVE_INFORMATION, self::HTTP_OK);
      }
      else {
        redirect('/app/user/signin');
      }
    }
  }

  /**
   * ----------------------------------------------
   * Protect Permission
   * ----------------------------------------------
   */
  protected function _protect_permission() {
    $get_rules = $this->_get_rule();

    if(empty($get_rules->authorize)) {
      return true;
    }

    $rules = (object)$get_rules->authorize;

    $filter = array();

    if(!empty($rules->group)) {
      $filter['group_name'] = ucwords(strtolower(preg_replace('/[\s]{2,}+/',' ',$rules->group)));
    }

    if(!empty($rules->role)) {
      $filter['role_name'] = ucwords(strtolower(preg_replace('/[\s]{2,}+/',' ',$rules->role)));
    }

    if(!empty($rules->permission)) {
      $filter['permission_name'] = strtoupper(preg_replace('/[\s]{1,}+/','_',$rules->permission));
    }

    if(!empty($rules->region)) {
      $filter['region_name'] = ucwords(strtolower(preg_replace('/[\s]{2,}+/',' ',$rules->region)));
    }

    if(empty($filter)) {
      return true;
    }

    if(!empty($this->__ACCOUNT__)) {
      if($this->__ACCOUNT__->id == 1) {
        return true;
      }

      $filter['account_id'] = $this->__ACCOUNT__->id;
    
      if(!$this->MUserPermission->exists($filter)) {
        $this->_error(self::SRV_ACCOUNT_NON_PERMISSION, self::HTTP_OK);
      }
    }

    return true;
  }
}
