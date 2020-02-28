<?php 
    include('simple_html_dom.php');
    //dường dẫn cần lấy tin
    $url = 'https://vnexpress.net/the-thao';
    $html = file_get_html($url);    
    //tìm theo thẻ
    foreach ($noidung = $html->find('.title_news a') as $e) {
        $a = array();
        //lấy thuộc tính của thẻ
        $url = $e->href;
        $html = file_get_html($url);
        $a[]=$e->innertext;        
        $a[]=str_replace("https://vnexpress.net","http://localhost",$e->href);
        // echo '</br>';
        // echo $e->href;
        // echo "</br>";
       foreach ($noidung = $html->find('article.content_detail.fck_detail.width_common.block_ads_connect') as $e2) {
           $a[]=$e2->innertext;
           echo "</br>";
       }
      print_r($a);
    }
    ?>