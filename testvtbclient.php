<?php
  	$data = '{"statusCode":"00","amount":10000,"terminalId":"0001","bankTransactionId":"187Zk-78bC1Y6rb","requestId":"187Zk-78bC1Y6rb","merchantName":"sab","merchantId":"sabmerchant","transactionDate":"20190524095120","orderId":"109584","statusMessage":"Tru tien thanh cong, so trace 2937 TTQR-109584-000002937-NGUYEN BICH HANG-VietinBank-********2429","productId":""}';
		//$data= json_decode($data,true); //thong tin lay ve từ MQ.
	  	// $stringSend= array();
	  	//tạo url để truy cập trang web.
	  	$url= 'http://web2.com/app/Plugin/kiosk/controller/callBackVietinbankAPIController.php';
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

		$server_output = curl_exec ($ch); //gán dữ liệu từ trang web trả về vào thằng $server_output.

		curl_close ($ch);
		echo trim($server_output); //thực hiện việc xóa các khaongr trắng của dãy dữ liệu nhận về.
		// $result = '';
		// if (preg_match('#{(.*?)}#', $server_output, $match)) {
		// 	echo $result = $match[1];
		// }