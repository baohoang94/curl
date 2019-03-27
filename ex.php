<?php
// URL có chứa hai thông tin name và diachi
$url = 'http://localhost/curl/get.php?name=NguyenVanCuong&diachi=Q12TPHCM';
 
// Khởi tạo CURL
$ch = curl_init($url);
 
// Thiết lập có return
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 
$result = curl_exec($ch);
 
curl_close($ch);
 
echo ($result);
?>