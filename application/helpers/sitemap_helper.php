<?php
 /**
  *
  * Chuyển đổi chuỗi kí tự thành dạng slug dùng cho việc tạo friendly url.
  *
  * @access    public
  * @param    string
  * @return    string
  */
  if ( ! function_exists('add_siteindex'))
  {
  	function add_siteindex($article)
    {

      $xml_src = APPPATH . '../sitemap.xml';

      // XPath-Querys 
      $parent_path = "urlset"; 
      $next_path = "id{$article['id']}"; 

      // Create a new DOM document 
      $dom = new DOMDocument(); 
      $dom->load($xml_src); 

      // Find the parent node 
      // $xpath = new DOMXpath($dom); 
      // var_dump($xpath);
      // Find parent node 
      $parent = $dom->getElementsByTagName($parent_path); 

      // new node will be inserted before this node 
      $next = $dom->getElementsByTagName($next_path); 

      if($next->length == 0) {
        // $string = "\n<url>\n\t<loc>https://vienvong.com/publish/detail/{$article['id']}/{$article['friendly']}</loc>\n\t<changefreq>{$article['actived_date']}</changefreq>\n\t<id{$article['id']}>{$article['id']}</id{$article['id']}>\n</url>";
        
        // Create the new element 
        $element = $dom->createElement('url'); 
        $loc = $dom->createElement('loc', "https://vienvong.com/publish/detail/{$article['id']}/{$article['friendly']}");
        $freq = $dom->createElement('changefreq', date('Y-m-d h:i:s'));
        $id = $dom->createElement('id'.$article['id'], $article['id']);

        $element->appendChild($dom->createTextNode("\n\t"));
        $element->appendChild($loc);
        $element->appendChild($dom->createTextNode("\n\t"));
        $element->appendChild($freq);
        $element->appendChild($dom->createTextNode("\n\t"));
        $element->appendChild($id);
        $element->appendChild($dom->createTextNode("\n"));

        $element = $dom->importNode($element, true);

        // Insert the new element 
        $parent->item(0)->appendChild($element); 
        $parent->item(0)->appendChild($dom->createTextNode("\n"));
        $dom->saveXML();
        $dom->save($xml_src);
      }
    }
  }