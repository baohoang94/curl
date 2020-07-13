<?php
// error_reporting(0);
include 'Nusoap/nusoap.php';
include 'Crypt/RSA.php';
function errorType($code){
	switch ($code){
		case '0':
			return 'Giao dịch chưa xác định ('.$code.')';
			break;
		case '-1':
			return 'Lỗi hệ thống ('.$code.')';
			break;
		case '-55':
			return 'Số dư tài khoản không đủ để thực hiện ('.$code.')';
			break;
		case '-99':
			return 'Lỗi chưa xác định ('.$code.')';
			break;
		case '-290':
			return 'Thông tin lệnh nạp tiền hợp lệ. Đang chờ kết quả xử lý ('.$code.')';
			break;
		case '-302':
			return 'Partner không tồn tại hoặc đang tạm dừng hoạt động ('.$code.')';
			break;
		case '-304':
			return 'Dịch vụ này không tồn tại hoặc đang tạm dừng ('.$code.')';
			break;
		case '-305':
			return 'Chữ ký không hợp lệ ('.$code.')';
			break;
		case '-306':
			return 'Mệnh giá không hợp lệ hoặc đang tạm dừng ('.$code.')';
			break;
		case '-307':
			return 'Tài khoản nạp tiền không tồn tại hoặc không hợp lệ ('.$code.')';
			break;
		case '-308':
			return 'RequesData không hợp lệ ('.$code.')';
			break;
		case '-309':
			return 'Ngày giao dịch truyền không đúng ('.$code.')';
			break;
		case '-310':
			return 'Hết hạn mức cho phép sử dụng dịch vụ này ('.$code.')';
			break;
		case '-311':
			return 'RequesData hoặc PartnerCode không đúng ('.$code.')';
			break;
		case '-315':
			return 'Phải truyền CommandType ('.$code.')';
			break;
		case '-316':
			return 'Phải truyền version ('.$code.')';
			break;
		case '-317':
			return 'Số lượng thẻ không hợp lệ ('.$code.')';
			break;
		case '-318':
			return 'ServiceCode không đúng ('.$code.')';
			break;
		case '-320':
			return 'Hệ thống gián đoạn ('.$code.')';
			break;
		case '-348':
			return 'Tài khoản bị Block Cho phép hoàn tiên ('.$code.')';
			break;
		case '-350':
			return 'Tài khoản không tồn tại ('.$code.')';
			break;
		case '-500':
			return 'Loại thẻ này trong kho hiện đã hết hoặc tạm ngừng xuất ('.$code.')';
			break;
		case '-501':
			return 'Giao dịch không thành công ('.$code.')';
			break;
		case '-502':
			return 'Không tồn tại giao dịch ('.$code.')';
			break;
		case '-503':
			return 'Đối tác không đươc thực hiện chức năng này ('.$code.')';
			break;
		case '-504':
			return 'Mã giao dịch này đã check quá tối đa số lần cho phép ('.$code.')';
			break;
		case '-505':
			return 'Số lần check vượt quá hạn mức cho phép trong ngày ('.$code.')';
			break;
		case '-509':
			return 'Giao dịch bị hủy (thất bại) ('.$code.')';
			break;
		case '-600':
			return 'Quá hạn mức ('.$code.')';
			break;
	}
	return 'Lỗi không xác định ('.$code.')';
}
function Decrypt($input, $key_seed){
	$input = base64_decode($input);
	$key = substr(md5($key_seed),0,24);
	$text=mcrypt_decrypt(MCRYPT_TRIPLEDES, $key, $input, MCRYPT_MODE_ECB,'12345678');
	$block = mcrypt_get_block_size('tripledes', 'ecb');
	$packing = ord($text{strlen($text) - 1});
	if($packing and ($packing < $block)){
		for($P = strlen($text) - 1; $P >= strlen($text) - $packing; $P--){
			if(ord($text{$P}) != $packing){
				$packing = 0;
			}
		}
	}
	$text = substr($text,0,strlen($text) - $packing);
	return $text;
}
$ServiceCode = array(
	'VTC0027', // Mã thẻ Viettel
	'VTC0154', // Mã thẻ Vietnamobile
	'VTC0029', // Mã thẻ Mobi
	'VTC0028', // Mã thẻ Vina
	'VTC0114', // Mã thẻ Vcoin
	'VTC0067', // Mã thẻ Zing
	'VTC0068', // Mã thẻ Gate
	'VTC0319', // Mã thẻ Sò
	// '',
	);

$Quantity = 1; // Số lượng
$ServiceCode = $ServiceCode[0]; // Mã dịch vụ
$Amount = '10000'; // Giá tiền
$OrgTransID = $_SERVER['REQUEST_TIME']; // Mã giao dịch
$TransDate = date('YmdHis'); // Thời gian
$partnerCode = 'partner'; // Partner code

$private_key = '-- PRIVATE KEY --'; // Private key
$triple_key = 'abcdefghijklmnos'; // TripleDES Key
$url='https://pay.vtc.vn/WS/GoodsPaygate.asmx?WSDL'; // Link service

//  Mua Card
// Tạo chữ ký
$rsa = new Crypt_RSA();
$rsa->loadKey($private_key);
$rsa->setSignatureMode(CRYPT_RSA_SIGNATURE_PKCS1);
$signature = base64_encode($rsa->sign($ServiceCode.'-'.$Amount.'-'.$Quantity.'-'.$partnerCode.'-'.$TransDate.'-'.$OrgTransID));
// Post data
// $client = new nusoap_client($url, true);
$param['requesData']='<?xml version="1.0" encoding="utf-8"?>
       <RequestData xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">
       <ServiceCode>'.$ServiceCode.'</ServiceCode>
       <Amount>'.$Amount.'</Amount>
       <Quantity>'.$Quantity.'</Quantity>
       <TransDate>'.$TransDate.'</TransDate>
       <OrgTransID>'.$OrgTransID.'</OrgTransID>
       <DataSign>'.$signature.'</DataSign>
      </RequestData>';
$param['partnerCode']=$partnerCode;
$param['commandType']='BuyCard';
$param['version']='1.0';
// $result = $client->call('RequestTransaction', $param);
$ch = curl_init();
			// if($ch){
			// 	echo 'curl_init_success';
			// }else{
			// 	echo 'curl_init_fail';
			// }
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$param);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$server_output = curl_exec ($ch); //gán dữ liệu từ trang web trả về vào thằng $server_output.

		curl_close ($ch);
		echo trim($server_output); //thực hiện việc xóa các khoảng trắng của dãy dữ liệu nhận về.
// Băm kết quả
$result = explode('|', $result);
if($result[0]==1){
	// Giao dịch thành công
	// Tạo chữ ký
	$rsa = new Crypt_RSA();
	$rsa->loadKey($private_key);
	$rsa->setSignatureMode(CRYPT_RSA_SIGNATURE_PKCS1);
	$signature = base64_encode($rsa->sign($ServiceCode.'-'.$Amount.'-'.$partnerCode.'-'.$result[2]));
	// Post data
	$client = new nusoap_client($url, true);
	$param['requesData']='<?xml version="1.0" encoding="utf-8"?>
	       <RequestData xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">
			<ServiceCode>'.$ServiceCode.'</ServiceCode>
			<Account>null(empty)</Account>
			<Amount>'.$Amount.'</Amount>
			<TransDate>null(empty)</TransDate>
			<OrgTransID>'.$result[2].'</OrgTransID>
			<DataSign>'.$signature.'</DataSign>
	     </RequestData>';
	$param['partnerCode']=$partnerCode;
	$param['commandType']='GetCard';
	$param['version']='1.0';
	$result = $client->call('RequestTransaction', $param);
	$result = Decrypt($result['RequestTransactionResult'], $triple_key);
	// Băm kết quả
	$result = explode('|', $result);
	// Băm lấy thông tin thẻ
	$result = explode(':', $result[2]);
	if($result[0]&&$result[1]&&$result[3]){
		echo 'Ma the: '.$result[0].' - Serial: '.$result[1].' - Date: '.$result[3];
	}else{
		echo 'Không lấy được thông tin thẻ';
	}	
}else{
	// Giao dịch lỗi
	echo errorType($result[0]);
}