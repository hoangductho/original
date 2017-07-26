<?php
/**
 * Vienvong
 *
 * 
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * ================================================
 * Setup json formart respond
 * ================================================
 */ 
if ( ! function_exists('set_response_data'))
{
	/**
	 * Determines if the current version of PHP is equal to or greater than the supplied value
	 *
	 * @param	string
	 * @return	bool	TRUE if the current version is $version or higher
	 */
	function set_response_data($status, $code = 1, $message = null) {
		$response = array(
			'status' => $status,
			'code' => $code,
			'message' => $message
			);

		return $response;
	}
}

/**
 * ================================================
 * Local Fullname
 * ================================================
 *
 * @todo Write fullname of user for local
 *
 * @param string first name
 * @param string last name
 * @param string local's language
 * @return string fullname for local
 */
function write_fullname_local($firstname, $lastname, $language) {
	if($language == 'vietnamese' || $language == 'vi') {
		return $lastname . ' ' . $firstname;
	}
	else {
		return $firstname . ' ' . $lastname;
	}
}

/**
 * --------------------------------------------
 * Create Out of Date
 * --------------------------------------------
 *
 * @todo create out of date for the code
 *
 * @param long start time
 * @param int live time (day). Default 1 day
 *
 * @return long out of date
 */
function create_out_date($starttime, $livetime) {

	if(!is_int($starttime) || !is_int($livetime)){
		return 0;
	}

	return $starttime + $livetime * 24 * 3600;
}

/**
 * ------------------------------------------------
 * Get default url
 * ------------------------------------------------
 */
function default_url(){
    // output: /myproject/index.php
    $currentPath = $_SERVER['PHP_SELF']; 

    // output: Array ( [dirname] => /myproject [basename] => index.php [extension] => php [filename] => index ) 
    $pathInfo = pathinfo($currentPath); 

    // output: localhost
    $hostName = $_SERVER['HTTP_HOST']; 

    // output: http://
    $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https'?'https':'http';

    // return: http://localhost/myproject/
    return $protocol.'://'.$hostName.$pathInfo['dirname'];
}

/**
 * ----------------------------------------
 * Random String
 * ----------------------------------------
 *
 * @todo Generate ramdom string with length inputed
 *
 * @param int $length length of string needed
 */  
function RandomString($length = 16) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function end_date($remember, $start, $short, $long) {
	return $remember == 1 ? $start + $long : $start + $short;
}

/**
 * ----------------------------------------
 * Passwor Hashing
 * ----------------------------------------
 *
 * @todo Hash password data
 *
 * @param int $length length of string needed
 */  
function PasswordHashing($password) {
	if(!empty($password)) {
		return sha1($password);
	}
	else {
		return null;
	}
}
/**
 * ----------------------------------------
 * Redirect URL
 * ----------------------------------------
 *
 * @todo redirect to another page
 *
 * @param string url url to redirect
 */
function redirect($url) {
    ob_start();
    header('Location: '.$url);
    ob_end_flush();
    // exit();
}
/**
* 
*/
class VCommon
{
	
	function __construct()
	{
	}
}