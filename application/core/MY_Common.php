<?php
/**
 * Vienvong
 *
 * 
 */
defined('BASEPATH') OR exit('No direct script access allowed');

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
