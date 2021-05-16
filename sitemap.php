<?php
ini_set('display_errors', 0);
error_reporting(E_ERROR | E_WARNING);
setlocale(LC_TIME, 'tr_TR.UTF-8');
date_default_timezone_set('Europe/Istanbul');
header("Content-Type: text/xml;charset=UTF-8");

require_once('_core/Autoloader.php');
_core\Autoloader::register();
$Response = new _core\Response();
$site = 'https://www.frelens.com/';

$Cdn = $Response->SiteBilgi()['Cdn'];

$Db = new \_core\Sql('FR_App');
$Modul = $Response->UrlOku(2);
$Sayfa = $Response->UrlOku(3);


$AccountCount = $Db->Sorgu("COUNT(id) AS id", "Hesap", "durum=1", 1)['id'];
$Accountlimit = 300;
$AcoountPageCount = ceil($AccountCount / $Accountlimit);

$IlanCount = $Db->Sorgu("COUNT(i.id) AS id", "Ilan AS i, Hesap AS h", "i.durum=1 AND h.id=i.Hesap_id AND h.durum=1", 1)['id'];
$Ilanlimit = 300;
$IlanPageCount = ceil($IlanCount / $Ilanlimit);


if (!$Modul) {


    echo '<?xml version="1.0" encoding="UTF-8"?>
   <sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <sitemap>
        <loc>' . $site . 'sitemap/pages</loc>
    </sitemap>    
    <sitemap>
        <loc>' . $site . 'sitemap/uyeler</loc>
    </sitemap>
    <sitemap>
        <loc>' . $site . 'sitemap/images</loc>
    </sitemap>';
    for ($i = 0; $i < $AcoountPageCount; $i++) {
        echo '<sitemap>
        <loc>' . $site . 'sitemap/uye/' . ($i + 1) . '</loc>
    </sitemap>';
    }

    echo '<sitemap>
        <loc>' . $site . 'sitemap/kategoriler</loc>
    </sitemap>';

    for ($i = 0; $i < $IlanPageCount; $i++) {
        echo '<sitemap>
        <loc>' . $site . 'sitemap/ilan/' . ($i + 1) . '</loc>
    </sitemap>';
    }

    echo '</sitemapindex>';
} elseif ($Modul == 'uye') {
    $baslangic = ($Sayfa - 1) * $Accountlimit;
    echo '<?xml version="1.0" encoding="UTF-8"?>
<urlset
      xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
      xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';
    $Hesap = $Db->Sorgu("kadi", "Hesap", "durum=1", "$baslangic,$Accountlimit");
    foreach ($Hesap as $key => $value) {
        echo ' <url>
            <loc>' . $site . $value['kadi'] . '</loc>
            <changefreq>hourly</changefreq>
              <priority>0.9</priority>
            </url>';
    }
    echo '
</urlset>';


} elseif ($Modul == 'uyeler') {
    echo '<?xml version="1.0" encoding="UTF-8"?>
<urlset
      xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
      xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';

    $AcoountPageCount1 = ceil($AccountCount / 40);
    for ($i = 0; $i < $AcoountPageCount1; $i++) {
        echo '<url>
            <loc>' . $site . 'uyeler/' . ($i + 1) . '</loc>
            <changefreq>hourly</changefreq>
              <priority>0.9</priority>
            </url>';
    }
    echo '
</urlset>';


} elseif ($Modul == 'kategoriler') {
    //Sayfalama Yapılacak
    echo '<?xml version="1.0" encoding="UTF-8"?>
<urlset
      xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
      xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';
    $KategoriCount = $Db->Sorgu("COUNT(id) AS id", "Kategori", NULL, 1);
    $Kategoris = $Db->Sorgu("link", "Kategori");
    foreach ($Kategoris as $index => $kategoris) {
        echo '<url>
            <loc>' . $site . 'frelens/' . $kategoris['link'] . '</loc>
            <changefreq>hourly</changefreq>
              <priority>0.9</priority>
            </url>';
    }
    echo '
</urlset>';


} elseif ($Modul == 'ilan') {
    $baslangic = ($Sayfa - 1) * $Ilanlimit;
    echo '<?xml version="1.0" encoding="UTF-8"?>
<urlset
      xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
      xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';
    $Ilan = $Db->Sorgu("i.Hesap_id,i.link,h.kadi", "Ilan AS i, Hesap AS h", "i.durum=1 AND h.id=i.Hesap_id AND h.durum=1", "$baslangic,$Ilanlimit");
    foreach ($Ilan as $key => $value) {
        echo ' <url>
    <loc>' . $site . '' . $value['kadi'] . '/' . $value['link'] . '</loc>
    <changefreq>hourly</changefreq>
      <priority>0.9</priority>
  </url>';

    }
    echo '
</urlset>';


} elseif ($Modul == 'pages') {
    echo '<?xml version="1.0" encoding="UTF-8"?>
<urlset
      xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
      xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
            <url>
  <loc>' . $site . '</loc>
  <changefreq>hourly</changefreq>
  <priority>1.00</priority>
</url>
<url>
  <loc>' . $site . 'index.html</loc>
  <changefreq>hourly</changefreq>
   <priority>0.9</priority>
</url>
<url>
  <loc>' . $site . 'frelens</loc>
  <changefreq>hourly</changefreq>
   <priority>0.9</priority>
</url>
<url>
  <loc>' . $site . 'login</loc>
  <changefreq>hourly</changefreq>
   <priority>0.9</priority>
</url>
<url>
  <loc>' . $site . 'register</loc>
  <changefreq>hourly</changefreq>
   <priority>0.9</priority>
</url>
<url>
  <loc>' . $site . 'ogrenci</loc>
  <changefreq>hourly</changefreq>
   <priority>0.9</priority>
</url>
<url>
  <loc>' . $site . 'isveren</loc>
  <changefreq>hourly</changefreq>
   <priority>0.9</priority>
</url>
<url>
  <loc>' . $site . 'blog</loc>
  <changefreq>hourly</changefreq>
   <priority>0.9</priority>
</url>


            ';
    $Sayfa = $Db->Sorgu("link,tur", "Icerik", "durum=1");
    foreach ($Sayfa as $key => $value) {
        if ($value['tur'] == 0) $link = 'pages/' . $value['link']; else $link = $value['link'];
        echo ' <url>
    <loc>' . $site . $link . '</loc>
    <changefreq>hourly</changefreq>
      <priority>0.9</priority>
  </url>';

    }
    echo '
</urlset>';


} elseif ($Modul == 'images') {
    echo '<?xml version="1.0" encoding="UTF-8"?>
<urlset
      xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
      xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
            <url>';
    $Ilan = $Db->Sorgu("i.Hesap_id,i.link,h.kadi,i.id AS id,h.resim", "Ilan AS i, Hesap AS h", "i.durum=1 AND h.id=i.Hesap_id AND h.durum=1");
    foreach ($Ilan as $index => $item) {
        //Kullanıcı Resmi
        echo '<loc>' . $site . $item['kadi'] .'</loc>';
        echo '<image:image>
            <image:loc>' . $Cdn . $item['resim'] . '</image:loc>
            </image:image>';

        //ilan Resimleri
        echo '<loc>' . $site . $item['kadi'] . '/' . $item['link'] . '</loc>';
        $Resims = $Db->Sorgu("resim", "Resim", "Ilan_id='$item[id]' AND Hesap_id='$item[Hesap_id]'");
        if(count($Resims)>0) {
            foreach ($Resims as $index => $resim) {
                echo '<image:image>
            <image:loc>' . $Cdn . $resim['resim'] . '</image:loc>
            </image:image>';
            }
        }else{
            echo '<image:image>
            <image:loc>' . $Cdn . 'default1.png</image:loc>
            </image:image>';
        }


    }

    echo '</url>
</urlset>';
}
