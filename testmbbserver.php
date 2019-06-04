<?php
	// if (!empty($_POST)) {
		$data = '{"mobile":"098654321","bankCode":"970432","accountNo":"112001891","payDate":"20190524083345","addtionalData":"Sab Test","debitAmount":"10000","respCode":"00","respDesc":"Transaction success","traceTransfer":"1704","messageType":"1","orderCode":"123456","userName":"Nguyen Van An","checkSum":"dc4c486ffe7de7cc5fd9143ff38164c5","realAmount":"9500","promotionCode":"123","rate":"10"}';
		//$data= json_decode($data,true); //thong tin lay ve từ MQ.
	  	// $stringSend= array();
	  	//tạo url để truy cập trang web.
	  	$url= 'http://web2.com/callBackMbbankAPI';
	  	// $url= 'http://210.245.26.70/callBackMbbankAPI';
	  	// if(is_array($data)){
			// $stringSend = http_build_query($data);
		// print_r($stringSend);
		$ch = curl_init();
			// if($ch){
			// 	echo 'curl_init_success';
			// }else{
			// 	echo 'curl_init_fail';
			// }
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$data);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	                'Content-Type: application/json',
	                'signature: noi dung chu ky so cua ben ngan hang')
	            ); // gửi chữ ký qua header
		$server_output = curl_exec ($ch); //gán dữ liệu từ trang web trả về vào thằng $server_output.

		curl_close ($ch);
		echo trim($server_output); //thực hiện việc xóa các khaongr trắng của dãy dữ liệu nhận về.
		// }else{
		// 	echo 'data_is_not_array';
		// }
	// }
		/*<!-- <!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Test MBB</title>
</head>
<body>
	<form action="" method="post" style="margin: 50px">
		<input type="number" name="orderid" value="" placeholder="Nhập mã giao dịch" required="">
		<input type="submit" name="submit" value="Gửi">
	</form>
</body>
</html> -->*/
?>
