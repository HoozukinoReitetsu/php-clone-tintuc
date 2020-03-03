<?php 
    include('simple_html_dom.php');
    $conn=mysqli_connect('localhost','root','','tin tức');
    if (!$conn) {
    exit('Kết nối không thành công!');
}
    // thành công
    echo 'Kết nối thành công!';
    // //dường dẫn cần lấy tin
    $url = 'https://vnexpress.net/the-thao';
    $html = file_get_html($url);    
    // //tìm theo thẻ
    foreach ($noidung = $html->find('.title_news a') as $e) {
        $a = array();
        // lấy thuộc tính của thẻ
        $url = $e->href;
        $html = file_get_html($url); 
        $a[]=addslashes($e->plaintext);     
        $a[]=str_replace("https://vnexpress.net","http://localhost",$e->href);
        $a[1]=str_replace("#box_comment","",$a[1]); 
        $a[0]=chop($a[0]);     
        echo "<br>" .$a[0];
       foreach ($noidung = $html->find('article.content_detail.fck_detail.width_common.block_ads_connect') as $e2) {
           $a[]=$e2->innertext;
       }
       if($a[0]!=""){
        $sql="INSERT INTO `tintuc`(`title`, `href`, `decription`) VALUES ('$a[0]','$a[1]','$a[2]')";
         unset($a);
       }
          if (mysqli_query($conn, $sql)) {
             
      echo "New record created successfully";
} else {
    //   echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
    }
    mysqli_close($conn);
    ?>