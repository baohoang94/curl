<?php
/*// Tạo mới một CURL
$ch = curl_init();
 
// Cấu hình cho CURL
curl_setopt($ch, CURLOPT_URL, "http://vmsdev2.sab.com.vn/topupCouponb2b");
 
// Thực thi CURL
curl_exec($ch);
 
// Ngắt CURL, giải phóng
curl_close($ch);
exit;*/
// set_time_limit(0);
	/*$data = '{
     "machineId": "0000000009792818",
     "goodId": "VTC0027100",
     "quantity": "01",
     "time": "1524369875",
     "transactionId": "3",
     "phoneNumber": "1577354009"
  }';*/
	//$data= json_decode($data,true); //thong tin lay ve từ MQ.
	$data = [
		// "coupon"=> "0378136745123456",
		"codeCoupon"=> "0378136745",
		"pinCoupon"=> "136745",
	     "goodId"=> "1708",
	     "goodName"=> "đậu phộng nước cốt dừa 35g",
	     "goodPrice"=> "10000",
	     "idSale"=> "",
	     "machineId"=> "000000007590ba70",
	     "moneyAvailable"=> "0",
	     "moneyCalculate"=> "30000",
	     "moneyInput"=> "0",
	     "period"=> "201911",
	     "quantity"=> "3",
	     "reducedValue"=> "0",
	     "saleSessionId"=> "1",
	     "slotId"=> "18",
	     "status"=> "1",
	     "time"=> time(),
	     "transactionId"=> "69",
	     "transferId"=> "",
	     "typePay"=> "1"
	];
  	//tạo url để truy cập trang web.
  	// $url= 'http://210.245.26.70/priceSaleAPI';
  	$url= 'http://vms.sab.com.vn/getInfoCouponAPI';
  	// $url= 'http://web2.com/checkCouponAPI';
  	if(is_array($data)){
		$stringSend= http_build_query($data);
		// $stringSend= json_encode($data);
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
		// curl_setopt($ch, CURLOPT_TIMEOUT,60);
		$server_output = curl_exec ($ch); //gán dữ liệu từ trang web trả về vào thằng $server_output.
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close ($ch);
		// var_dump($httpcode);
		echo trim($server_output); //thực hiện việc xóa các khoảng trắng của dãy dữ liệu nhận về.
	}else{
		echo 'data_is_not_array';
	}
?>