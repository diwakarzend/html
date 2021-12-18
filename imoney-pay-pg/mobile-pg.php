<?php

$url = "http://165.22.208.28:8080/api/pg";

$tokenHeaders = apache_request_headers();
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$token=isset($tokenHeaders['token'])?$tokenHeaders['token']:"";
$headers = array(
   "Accept: application/json",
   "Authorization: Bearer ".$token,
);

curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$resp = curl_exec($curl);
$array = json_decode($resp);

curl_close($curl);




if (isset($array->success) && $array->success==true) {

    $billAmount = $_GET['amt']?$_GET['amt']:0; 

    if($billAmount==0){
        echo "No amount found"; die;
    }
    //$percentase=($billAmount*1/100);
    //echo $_SESSION['id_token']; die;
   
    $request_array = array(
        "SALT" => $array->data->saltId, 
        "PAY_ID" => $array->data->payId, 
        "ORDER_ID" => $array->data->orderId,
        "AMOUNT"=>$billAmount*100,
        "TXNTYPE"=>'SALE',
        "CUST_NAME"=> $array->data->custName,
        "CUST_STREET_ADDRESS1"=>$array->data->address,
        "CUST_ZIP" =>$array->data->zip,
        "CUST_PHONE"=>$array->data->phoneNumber,
        "CUST_EMAIL"=>$array->data->emailId,
        "CUST_ID"=>$token,
        "PRODUCT_DESC"=>"WALLET",
        "CURRENCY_CODE"=>$array->data->currencyCode,
        "URL"=>$array->data->url,
        'RETURN_URL'=>"https://imoneypay.live/imoney-pay-pg/mobile-response.php"
        //http://localhost:8080/ipaymobile/
     );

        foreach ($request_array as $key => $value) {

            $requestParamsJoined[] = "$key=$value";
        }
                 
        $responce_data_hash = hash_request_data($requestParamsJoined, $request_array["SALT"]);
        $request_array["HASH"] = $responce_data_hash;
        //print_r($request_array); die;
        echo 'Thanks for Using Pay2Mobile. You will be redirected to I-moneyPay Payment Page';
        $form = '<form id="checkout_form" name="checkout_form" method="POST" action="' . $request_array["URL"]  . '">';
        foreach($request_array as $key => $value) {

            $form .= '<input type="hidden" name="'.$key.'" value="'.$value.'" />'."\n";
        }
        
        $form .= '</form>';
        $html = '<html><body>';
        
        $html = '<script type="text/javascript">
				window.onload=function(){ 
     			document.checkout_form.submit();};
 
     			</script>';
        $html .= $form;
        $html.= '</body></html>';
        echo $html;
        exit;

}

exit(0);


/*
* function for generating hash
*/
function hash_request_data($array, $salt_key) {

    sort($array);
    $merchant_data_string = implode('~', $array);
    $format_Data_string = $merchant_data_string . $salt_key;
    $hashData_uf = hash('sha256', $format_Data_string);
    $hashData = strtoupper($hashData_uf);
    return $hashData;
}
?>