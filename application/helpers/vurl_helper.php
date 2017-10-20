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

    if(!empty($page_index)) {
      if(filter_var($explode[$page_index], FILTER_VALIDATE_INT)) {
        $explode[$page_index] = $number;
      }
    } else {
      if(filter_var($explode[count($explode) - 1], FILTER_VALIDATE_INT)) {
        $explode[count($explode) - 1] = $number;
      } else {
        $explode[count($explode)] = $number;
      }
    }

    $uri = implode('/', $explode);

    return str_replace('//', '/', DIRECTORY_SEPARATOR . $uri);
  }
}

/**
  * Pagination link
  *
  * @access   public
  * @param    string url need paginate
  * @param    int current page
  * @param    int number to paginate
  * @return   string html
  */
if(! function_exists('pagination_render')) 
{
  function pagination_render($pages, $url = null, $current_page = 1) {

    if(empty($url)) {
      $CI = &get_instance();

      $url = $CI->uri->uri_string;

      $explode = explode('/', $url);

      $current_page = filter_var(end($explode), FILTER_VALIDATE_INT) ? end($explode) : 1;
    }

    $pagination = '<nav class="pagination">';
    
    if($current_page > 1){
        $pagination .= '<a class="page-numbers prev" href="'.page_link_render($current_page - 1).'">Prev</a>';
    }
    
    $pagination .= '<a class="page-numbers current" href="'.page_link_render(1).'">1</a>';

    if($current_page - 3 > 1){
        $pagination .= '<span class="page-numbers dots">…</span>';
    }
    if($current_page - 2 > 1){
        $pagination .= '<a class="page-numbers prev" href="'.page_link_render($current_page - 2).'">'.($current_page - 2).'</a>';
    }

    if($current_page - 1 > 1){
        $pagination .= '<a class="page-numbers prev" href="'.page_link_render($current_page - 1).'">'.($current_page - 1).'</a>';
    }
    
    if($current_page > 1 && $current_page < $pages){
        $pagination .= '<a class="page-numbers prev" href="'.page_link_render($current_page).'">'.($current_page).'</a>';
    }

    if($current_page + 1 < $pages){
        $pagination .= '<a class="page-numbers prev" href="'.page_link_render($current_page + 1).'">'.($current_page + 1).'</a>';
    }
    if($current_page + 2 < $pages){
        $pagination .= '<a class="page-numbers prev" href="'.page_link_render($current_page + 2).'">'.($current_page + 2).'</a>';
    }
    if($current_page + 3 < $pages){
        $pagination .= '<span class="page-numbers dots">…</span>';
    }
    
    if($current_page <= $pages && $pages > 1){
        $pagination .= '<a class="page-numbers current" href="'.page_link_render($pages).'">'.($pages).'</a>';
    }

    if($current_page < $pages){
        $pagination .= '<a class="page-numbers next" href="'.page_link_render($current_page + 1).'">Next</a>';
    }        
    
    $pagination .= '</nav>';

    return $pagination;
  }
}