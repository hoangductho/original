<?php
 /**
  *
  * Chuyển đổi chuỗi kí tự thành dạng slug dùng cho việc tạo friendly url.
  *
  * @access    public
  * @param    string
  * @return    string
  *
  * @example 
    <?xml version="1.0" encoding="UTF-8"?>
    <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
            xmlns:news="http://www.google.com/schemas/sitemap-news/0.9">
      <url>
        <loc>http://www.example.org/business/article55.html</loc>
        <news:news>
          <news:publication>
            <news:name>The Example Times</news:name>
            <news:language>en</news:language>
          </news:publication>
          <news:genres>PressRelease, Blog</news:genres>
          <news:publication_date>2008-12-23</news:publication_date>
          <news:title>Companies A, B in Merger Talks</news:title>
          <news:keywords>business, merger, acquisition, A, B</news:keywords>
          <news:stock_tickers>NASDAQ:A, NASDAQ:B</news:stock_tickers>
        </news:news>
      </url>
    </urlset>
  */
  if ( ! function_exists('add_siteindex'))
  {
  	function add_siteindex($article)
    {

      $xml_src = APPPATH . '../sitemap.xml';

      // XPath-Querys 
      $parent_path = "urlset"; 
      
      // Create a new DOM document 
      $dom = new DOMDocument(); 
      $dom->validateOnParse = true;
      $dom->load($xml_src); 

      // Find parent node 
      $parent = $dom->getElementsByTagName($parent_path); 

      // new node will be inserted before this node 
      $selector = new DOMXPath($dom);

      $next = $selector->query("//*[@id='article_{$article['id']}']");

      if($next->length == 0) {
        $CI = &get_instance();
        $render = new DOMDocument();

        $element = $CI->load->view('sitemap/sitemap', $article, true);

        $render->validateOnParse = true;
        $render->loadXML($element);

        $element = $render->getElementsByTagName('url'); 

        $element = $dom->importNode($element[0], true);

        // Insert the new element 
        $parent->item(0)->appendChild($element); 
        $parent->item(0)->appendChild($dom->createTextNode("\n"));
        $dom->saveXML();
        $dom->save($xml_src);
      }
    }
  }