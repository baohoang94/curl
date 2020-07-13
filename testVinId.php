<?php
	// $data = '{"coupon":"","machineId":"15226", "goodId":"1302", "quantity":47, "time":1561360066, "typePay": "1"}';
	// $data= json_decode($data,true); //thong tin lay ve từ MQ.
	$data = [
		"coupon"=> "",
	     "goodId"=> "1708",
	     "goodName"=> "đậu phộng nước cốt dừa 35g",
	     "goodPrice"=> "10000",
	     "idSale"=> "",
	     "machineId"=> "123",
	     "moneyAvailable"=> "0",
	     "moneyCalculate"=> "10000",
	     "moneyInput"=> "0",
	     "period"=> "201911",
	     "quantity"=> "1",
	     "reducedValue"=> "0",
	     "saleSessionId"=> "1",
	     "slotId"=> "18",
	     "status"=> "3",
	     "time"=> time(),
	     "transactionId"=> "67",
	     "transferId"=> "",
	     "typePay"=> "7"
	];
  	//tạo url để truy cập trang web.
  	// $url= 'http://210.245.26.70/priceSaleAPI';
  	// $url= 'http://vms.sab.com.vn/priceSaleAPI';
  	$url= 'http://web2.com/getQRZaloPayAPI';
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