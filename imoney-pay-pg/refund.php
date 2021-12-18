<?php
$sandbox = true;
$PAY_ID = "";
$ORDER_ID = "";
$AMOUNT ="100";
$CURRENCY_CODE ="356";
$SALT ="";
$PG_REF_NUM = "";
//txn_type = "REFUND"
$TXNTYPE = "REFUND";
//refund_order_id is always unique
$REFUND_ORDER_ID = "Order" . rand(10,9999);

//use this function to get refund
$refundStatus = processRefund($sandbox,$PAY_ID,$ORDER_ID,$AMOUNT,$TXNTYPE,$CURRENCY_CODE,$SALT,$PG_REF_NUM,$REFUND_ORDER_ID);

print_r($refundStatus);
 

function processRefund($sandbox,$PAY_ID,$ORDER_ID,$AMOUNT,$TXNTYPE,$CURRENCY_CODE,$SALT,$PG_REF_NUM,$REFUND_ORDER_ID){

$data = array("PAY_ID" => $PAY_ID, 'ORDER_ID' => $ORDER_ID, 'AMOUNT' => $AMOUNT, 'TXNTYPE' => $TXNTYPE, 'CURRENCY_CODE' => $CURRENCY_CODE, 'PG_REF_NUM' => $PG_REF_NUM, 'REFUND_ORDER_ID' => $REFUND_ORDER_ID); 

foreach ($data as $key => $value) {
        $responceParamsJoined[] = "$key=$value";
}

$HASH = GenHash($responceParamsJoined,$SALT);
$data["HASH"] = $HASH;

 if ($sandbox == true) {
                $url = "https://test.imoneypay.in/pgws/transact";
            } else {
                $url = "https://prod.imoneypay.in/pgws/transact";
            }

$postvars =  json_encode($data); 
   
$cURL = curl_init();

curl_setopt($cURL, CURLOPT_URL,$url);
curl_setopt($cURL, CURLOPT_POST, 1);
curl_setopt($cURL, CURLOPT_POSTFIELDS,$postvars);
curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);
curl_setopt($cURL, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json',                                                                                
    'Content-Length: ' . strlen($postvars))                                                                       
);

$server_output = curl_exec($cURL);
$refundArray = json_decode($server_output, true);
curl_close ($cURL);
return $refundArray;
}

function GenHash($data, $SALT){

	sort($data);
    $merchant_data_string = implode('~', $data);
    $format_Data_string = $merchant_data_string . $SALT;
    $hashData_uf = hash('sha256', $format_Data_string);
    $hashData = strtoupper($hashData_uf);
    return $hashData;
    
}

?>