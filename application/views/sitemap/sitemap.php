<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:news="http://www.google.com/schemas/sitemap-news/0.9">
  <url id="<?php echo 'article_' . $id?>">
    <loc>https://vienvong.com/publish/detail/<?php echo $id?>/<?php echo $friendly?></loc>
    <news:news>
      <news:publication>
        <news:name>Viễn Vọng</news:name>
        <news:language>vi</news:language>
      </news:publication>
      <news:publication_date><?php echo date('Y-m-d', strtotime($actived_date));?></news:publication_date>
      <news:title><?php echo $title?></news:title>
      <news:keywords><?php echo $keyword?></news:keywords>
    </news:news>
  </url>
</urlset>