<?php
$data = '{
    "actionTime": "2019-04-08 11:35:06",
    "id": "3",
    "machineId": "00000000d1278a66",
    "money": "0",
    "moneyCalculate": "22.500",
    "staffCode": "Admin",
    "startTime": "2019-04-03 15:16:54"
}';
$data= json_decode($data);
  	$stringSend= array();
  	$url= 'http://web2.com/saveCollectionAPI';
  	$url= 'http://vmstest.sab.com.vn/saveCollectionAPI';

	foreach($data as $key=>$value){
		$stringSend[]= $key.'='.$value;
	}
	
	$stringSend= implode('&', $stringSend);
	
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS,$stringSend);

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$server_output = curl_exec ($ch);

	curl_close ($ch);

	echo $server_output;
 ?>