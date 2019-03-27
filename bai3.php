<title>Bài 03: Lấy hình từ site khác bằng PHP CURL</title>
<?php
function curl_download($Url, $saveTo)
{
    // Mở một file mới với đường dẫn và tên file là tham số $saveTo
    $fp = fopen ($saveTo, 'w+');
     
    // Bắt đầu CURl
    $ch = curl_init($Url);
    // Bỏ qua xác nhận ssl
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
    // Thiết lập giả lập trình duyệt
    // nghĩa là giả mạo đang gửi từ trình duyệt nào đó, ở đây tôi dùng Firefox
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0");
     
    // Thiết lập trả kết quả về chứ không print ra
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  
    // Thời gian timeout
    curl_setopt($ch, CURLOPT_TIMEOUT, 1000);
     
    // Lưu kết quả vào file vừa mở
    curl_setopt($ch, CURLOPT_FILE, $fp);
     
    // Thực hiện download file
    $result = curl_exec($ch);
     
    // Đóng CURL
    curl_close($ch);
     
    return $result;
}curl_download('https://freetuts.net/upload/page/images/2014/11/16/31/tong-hop-bai-viet-hoc-jquery-can-ban-den-nang-cao.gif', 'upload/demo.png');

?>