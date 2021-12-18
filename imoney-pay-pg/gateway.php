<?php
ob_start();
session_start();
$url = "http://localhost:8080/api/user/account";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$token=isset($_SESSION['id_token'])?$_SESSION['id_token']:"";
$headers = array(
   "Accept: application/json",
   "Authorization: Bearer ".$token ,
);

//print_r($headers); die;
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$resp = curl_exec($curl);
$array = json_decode($resp);
curl_close($curl);

//print_r($array); die;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $billAmount = $_POST["billAmount"]; 
    $percentase=($billAmount*1/100);
    //echo $_SESSION['id_token']; die;
   
    $request_array = array(
        "SALT" => '35cc02c8de354b4a', 
        "PAY_ID" => '1004510802155833', 
        "ORDER_ID" => 'Order10056400059'.rand(10,100000),
        "AMOUNT"=>($billAmount*100)+$billAmount,
        "TXNTYPE"=>'SALE',
        "CUST_NAME"=> "ashish",
        "CUST_STREET_ADDRESS1"=>"New Delhi",
        "CUST_ZIP" =>'273010',
        "CUST_PHONE"=>"8800578866",
        "CUST_EMAIL"=>"dwkrupadhyay@gmail.com",
        "CUST_ID"=>$_SESSION['id_token'],
        "PRODUCT_DESC"=>strtoupper($_POST["billtype"])."-".$_POST["serviceNumber"]."-".$_POST["billOperator"]."-".$billAmount,
        "CURRENCY_CODE"=>"356",
        "URL"=>"https://prod.imoneypay.in/pgui/jsp/paymentrequest",
        'RETURN_URL'=>"https://imoneypay.live/imoney-pay-pg/response.php"
        //http://localhost:8080/ipaymobile/
     );

    // print_r($request_array);die;
	//$request_array = filter_input_array(INPUT_POST);
                    foreach ($request_array as $key => $value) {

                        $requestParamsJoined[] = "$key=$value";
                    }
                 
                $responce_data_hash = hash_request_data($requestParamsJoined, $request_array["SALT"]);
                $request_array["HASH"] = $responce_data_hash;
               //print_r($request_array); die;
                echo 'Thanks for Using ImoneyPay. You will be redirected to ImoneyPay Payment Page.';
               // print_r($request_array );die;
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

}exit(0);


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