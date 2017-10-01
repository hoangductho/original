<?php
 /**
  *
  * Chuyển đổi chuỗi kí tự thành dạng slug dùng cho việc tạo friendly url.
  *
  * @access    public
  * @param    string
  * @return    string
  */
  if ( ! function_exists('url_friendly'))
  {
    function url_friendly($string) {
          $search = array (
              '#(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)#',
              '#(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)#',
              '#(ì|í|ị|ỉ|ĩ)#',
              '#(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)#',
              '#(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)#',
              '#(ỳ|ý|ỵ|ỷ|ỹ)#',
              '#(đ)#',
              '#(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)#',
              '#(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)#',
              '#(Ì|Í|Ị|Ỉ|Ĩ)#',
              '#(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)#',
              '#(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)#',
              '#(Ỳ|Ý|Ỵ|Ỷ|Ỹ)#',
              '#(Đ)#',
              "/[^a-zA-Z0-9\-\_]/",
              ) ;
          $replace = array (
              'a',
              'e',
              'i',
              'o',
              'u',
              'y',
              'd',
              'A',
              'E',
              'I',
              'O',
              'U',
              'Y',
              'D',
              '-',
              ) ;
          $string = preg_replace($search, $replace, $string);
          $string = preg_replace('/(-)+/', '-', $string);
          $string = strtolower($string);
          return $string;
    }
}
/**
 * Rending Page Link
 */
if(! function_exists('page_link_render')) {
  function page_link_render($number, $uri = null, $page_index = null) {
    $CI = null;

    if(empty($uri)) {
      $CI = &get_instance();
      $uri = $CI->uri->uri_string;
    }

    $explode = explode('/', $uri);

    if(!empty($explode[$page_index])) {
      $explode[$page_index] = $number;
    } else {
      $explode[count($explode)] = $number;
    }

    $uri = implode('/', $explode);

    return $uri;
  }
}