<?php
	// $data = '{"Title":"TopupTelco","machineId":"000000008afe4a73", "slotId":"80", "numberPhone":"0906210885", "saleSessionId":3, "BillStatus": "Tang thai cua bill","BillAmount":"20000"}';
	$data = [
		"coupon" => "",
	     "goodId" => "VTC0028300",
	     "goodName" => "Birdy sữa",
	     "goodPrice" => "50000",
	     "idSale" => "",
	     "machineId" => "000000008afe4a73",
	     "moneyAvailable" => "0",
	     "moneyCalculate" => "500000",
	     "moneyInput" => "0",
	     "period" => "202001",
	     "quantity" => "3",
	     "reducedValue" => "0",
	     "saleSessionId" => "7",
	     "slotId" => "110",
	     "status" => "4",
	     "time" => time(),
	     "transactionId" => "23",
	     "transferId" => "",
	     "numberPhone" => "0906210885",
	     "Title" => "CheckServiceAvailable",
	     "typePay" => "1"
	];

  	define('DOMAIN', 'http://web2.com/');
  	
	$url = DOMAIN.'checkServiceAvailable';
	$services = [
		'TopupTelco' => [
			'VTC0056',
			'VTC0329',
			'VTC0057',
			'VTC0201',
			'VTC0058',
			'VTC0130',
			'VTC0176',
			'VTC0177',
			// 'VTC0057',
		],
		'BuyCard' => [
			'VTC0027',
			'VTC0028',
			'VTC0029',
			// 'VTC0057',
		]
	];

	if (!empty($data['goodId'])) {
		$serviceCode = substr($data['goodId'],0,7);
		foreach ($services as $key => $value) {
			if (in_array($serviceCode, $value)) {
				$data['commandType'] = $key;
				break;
			}
		}
	}

	if (!empty($data['Title']) && ($data['Title'] == 'CheckServiceAvailable')) {
		$url = DOMAIN.'checkServiceAvailable';
	} elseif (!empty($data['commandType'])) {
		switch ($data['commandType']) {
			case 'TopupTelco':
				$url = DOMAIN.'topupTelcoVtcAPI';
				break;
			case 'BuyCard':
				$url = DOMAIN.'buyCardVtcAPI';
				break;
			default:
				$url = DOMAIN.'checkServiceAvailable';
				break;
		}
	}
	$stringSend = http_build_query($data);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $stringSend);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$server_output = curl_exec($ch);
	curl_close($ch);
	echo $server_output;
?>