<?php
 /**
  *
  * Chuyển đổi chuỗi kí tự thành dạng slug dùng cho việc tạo friendly url.
  *
  * @access    public
  * @param    string
  * @return    string
  */
  if ( ! function_exists('upload_base64'))
  {
  	function upload_base64($data64, $path = null)
    {
    	try {
    		$filter = array(
    			'options' => array(
    				'regexp' => '/^data:image\/[a-zA-Z]{2,9};base64,/'
    			)
    		);

			if(!filter_var($data64, FILTER_VALIDATE_REGEXP, $filter)) {
				return $data64;
			}

			list($type, $data) = explode(';', $data64);
			list($method, $data)      = explode(',', $data);

			// $size = getimagesize($data64);

	    	if(strlen(base64_decode($data64)) < 100 * 1024) {
				$decoded = base64_decode($data);
				$name = md5($data64);

				if(empty($path)) {
					$path = date('Y') . DIRECTORY_SEPARATOR . date('m') . DIRECTORY_SEPARATOR . date('d'). DIRECTORY_SEPARATOR;
				}

				$path = APPPATH . '..' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . $path;
				list(, $type)      = explode('/', $type);

				switch ($type) {
					case 'jpeg':
						$type = 'jpg';
						break;
					case 'png':
						$type = 'png';
						break;
					case 'bmp':
						$type = 'bmp';
						break;
					case 'gif':
						$type = 'gif';
						break;
					
					default:
						# code...
						break;
				}

				if (!file_exists($path)) {
				    mkdir($path, 0755, true);
				}

				$path = $path . $name . '.' . $type;
		    	
		        file_put_contents($path, $decoded);

		        return str_replace(APPPATH . '..', '', $path);
	    	}
	    	else {
	    		return false;
	    	}
    	} catch (Exception $e) {
    		return false;
    	}
    	
    }
  }