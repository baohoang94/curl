<?php
	$data = array('codeMachine'=>'0000000064b1fce3','data'=>json_encode(array('transactionId'=>'13','statusPay'=>'00')));
	$stringSend= array();
        $url= 'http://210.245.26.70/app/Plugin/kiosk/controller/amqplib/php/sendTransferToKiosk_server.php';

        //$url= 'http://vms.sab.com.vn/app/Plugin/kiosk/controller/amqplib/php/'.$urlSend;


	      // $modelLog= new Log;
  	    // $dataLog['Log']['data_to_function']=$data;
	      // $dataLog['Log']['time']=time();
	      // $dataLog['Log']['urlSend']=$url;
  	    // $modelLog->save($dataLog);

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
echo $server_output;
        curl_close ($ch);

?>