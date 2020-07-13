<?php
	$data = '{"id":"3","machineId":"0123", "startTime":"1563865216", "BillAmount":"10000", "saleSessionId":3, "BillStatus": "Trang thai cua bill"}';
	$data= json_decode($data,true); //thong tin lay ve từ MQ.
  	//tạo url để truy cập trang web.
  	// $url= 'http://210.245.26.70/saveBillStatusAPI';
  	// $url= 'http://vms.sab.com.vn/saveBillStatusAPI';
  	$url= 'http://web2.com/saveAmountAPI';
  	if(is_array($data)){
		$stringSend= http_build_query($data);
		$ch = curl_init();
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