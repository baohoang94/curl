<?php
	$data = '{"coupon":"","machineId":"00000000d1278a66", "goodId":"1133", "quantity":1, "time":'.time().', "typePay": 4}';
	$data= json_decode($data,true); //thong tin lay ve từ MQ.
  	//tạo url để truy cập trang web.
  	$url= 'http://210.245.26.70/priceSaleAPI';
  	// $url= 'http://vms.sab.com.vn/priceSaleAPI';
  	if(is_array($data)){
		$stringSend= http_build_query($data);
		$ch = curl_init();
			// if($ch){
			// 	echo 'curl_init_success';
			// }else{
			// 	echo 'curl_init_fail';
			// }
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$stringSend);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$server_output = curl_exec ($ch); //gán dữ liệu từ trang web trả về vào thằng $server_output.
		curl_close ($ch);
		echo trim($server_output); //thực hiện iệc xóa các khaongr trắng của dãy dữ liệu nhận về.
	}else{
		echo 'data_is_not_array';
	}

?>