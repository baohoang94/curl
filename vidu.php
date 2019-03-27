<?php
// Tạo mới một CURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// Cấu hình cho CURL
curl_setopt($ch, CURLOPT_URL, "https://ketqua.net/");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 
// Thực thi CURL
$html = curl_exec($ch);
 
// Ngắt CURL, giải phóng
curl_close($ch);
 
// In kết quả ra màn hình
echo $html;

?>