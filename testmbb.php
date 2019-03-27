<?php
	$data = '{"statusCode":"00","amount":4500,"requestId":"11369","merchantName":"sab","merchantId":"sabmerchant","transactionDate":"20190322113417","orderId":"11369","statusMessage":"Tru tien thanh cong","productId":""}';
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
	echo trim($server_output); //thực hiện iệc xóa các khaongr trắng của dãy dữ liệu nhận về.
	// }else{
	// 	echo 'data_is_not_array';
	// }	

?>