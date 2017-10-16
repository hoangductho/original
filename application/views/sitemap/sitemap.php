<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:news="http://www.google.com/schemas/sitemap-news/0.9">
  <url id="<?php echo 'article_' . $id?>">
    <loc>https://vienvong.com/publish/detail/<?php echo $id?>/<?php echo $friendly?></loc>
    <lastmod><?php echo date('Y-m-d\TH:i:sP', strtotime($actived_date));?></lastmod>
    <changefreq>always</changefreq>
    <priority>0.8</priority>
  </url>
</urlset>