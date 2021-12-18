<?php
ob_start();
session_start();

$Salt = "";
$RESPONSE_MESSAGE = '';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

               if($_REQUEST['CUST_ID']){
                $_SESSION['id_token'] = $_REQUEST['CUST_ID'];  
                $_SESSION['is_loging']=1;
               }
                $responce_array = filter_input_array(INPUT_POST);

                foreach ($responce_array as $key => $value) {
                    if ($key == 'HASH') {
                        continue;
                    } else {
                        $responceParamsJoined[] = "$key=$value";
                    }
                }
                
                $responce_data_hash = hash_responce_data($responceParamsJoined, $Salt);
                 
                 if (isset($_REQUEST['HASH'])){
                    $receivedHash = $_REQUEST['HASH'];
                }else{
                    $receivedHash = "NA";
                }
                if (isset($_REQUEST['ORDER_ID'])){
                    $ORDER_ID = $_REQUEST['ORDER_ID'];
                    
                }else{
                    $ORDER_ID = "NA";
                }
                 if (isset($_REQUEST['RESPONSE_CODE'])){
                    $RESPONSE_CODE = $_REQUEST['RESPONSE_CODE'];
                    
                }else{
                    $RESPONSE_CODE = "NA";
                }
                 if (isset($_REQUEST['PG_REF_NUM'])){
                    $PG_REF_NUM = $_REQUEST['PG_REF_NUM'];
                     
                }else{
                    $PG_REF_NUM = "NA";
                }
                 if (isset($_REQUEST['TXN_ID'])){
                    $TXN_ID = $_REQUEST['TXN_ID'];
                     
                }else{
                    $TXN_ID = "NA";
                }
                 if (isset($_REQUEST['STATUS'])){
                    $STATUS = $_REQUEST['STATUS'];
                    
                }else{
                    $STATUS = "NA";
                }
                 if (isset($_REQUEST['AMOUNT'])){
                    $AMOUNT = $_REQUEST['AMOUNT']/100;
                     
                }else{
                    $AMOUNT = "NA";
                }
                 if (isset($_REQUEST['PRODUCT_DESC'])){
                    $PRODUCT_DESC = $_REQUEST['PRODUCT_DESC'];
                     
                }else{
                    $PRODUCT_DESC = "NA";
                }
                 if (isset($_REQUEST['CUST_NAME'])){
                    $CUST_NAME = $_REQUEST['CUST_NAME'];
                     
                }else{
                    $CUST_NAME = "NA";
                }
                 if (isset($_REQUEST['CUST_EMAIL'])){
                    $CUST_EMAIL = $_REQUEST['CUST_EMAIL'];
                     
                }else{
                    $CUST_EMAIL = "NA";
                }
                 if (isset($_REQUEST['PG_REF_NUM'])){
                    $PG_REF_NUM =  $_REQUEST['PG_REF_NUM'];
                     
                }else{
                    $PG_REF_NUM = "NA";
                }

                pgResponseCapture($_REQUEST);
                if ($responce_data_hash == $receivedHash && $RESPONSE_CODE == 000 && $STATUS == "Captured") {
                      $RESPONSE_MESSAGE = "Transaction Successful";
                    
                }else{
                     $RESPONSE_MESSAGE = "Payment failed ";
                }

                }else exit(0);

 
function hash_responce_data($array, $salt_key) {
    sort($array);
    $merchant_data_string = implode('~', $array);
    $format_Data_string = $merchant_data_string . $salt_key;
    $hashData_uf = hash('sha256', $format_Data_string);
    $hashData = strtoupper($hashData_uf);
    return $hashData;
}

function pgResponseCapture($pgResponse){

       $post = [
           'responseDateTime' => $pgResponse['RESPONSE_DATE_TIME'],
           'responseCode' => $pgResponse['RESPONSE_CODE'],
           'customerId'=>$pgResponse['CUST_ID'],
           'customerPhone'=>$pgResponse['CUST_PHONE'],
           'currencyCode'=> $pgResponse['CURRENCY_CODE'],
           'status'=> $pgResponse['STATUS'],
           'productDesc'=> $pgResponse['PRODUCT_DESC'],
           'pgRefNumber'=> $pgResponse['PG_REF_NUM'],
           'amount'=> $pgResponse['AMOUNT']/100,
           'responseMessage'=> $pgResponse['RESPONSE_MESSAGE'],
           'customerEmail'=> $pgResponse['CUST_EMAIL'],
           'cardIssuerCountry'=> $pgResponse['RESPONSE_CODE'],
           'txnId'=> $pgResponse['TXN_ID'],
           'txnType'=> $pgResponse['TXNTYPE'],
           'hash'=> $pgResponse['HASH'],
           'paymentType'=> $pgResponse['PAYMENT_TYPE'],
           'returnUrl'=> $pgResponse['RETURN_URL'],
           'payId'=> $pgResponse['PAY_ID'],
           'orderId'=> $pgResponse['ORDER_ID'],
           'totalAmount'=> $pgResponse['AMOUNT']/100,
           'customerName'=> $pgResponse['CUST_NAME'],
           'billNumber'=>$pgResponse['PRODUCT_DESC'],
           'acqId'=>$pgResponse['ACQ_ID'],
           'cardMask'=>$pgResponse['CARD_MASK'],
           'rrn'=>$pgResponse['RRN'],
           'cardIssueBank'=>$pgResponse['CARD_ISSUER_BANK']
    
       ];
    

       $ch = curl_init('http://165.22.208.28:8080/api/pg');
       $payload = json_encode($post);
       $token=isset($pgResponse['CUST_ID'])?$pgResponse['CUST_ID']:""; 
       $headers = array(
           "Accept: application/json",
           "Authorization: Bearer ".$token,
           "Content-Type: application/json"
        );
       curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
       curl_setopt($ch, CURLINFO_HEADER_OUT, true);
       curl_setopt($ch, CURLOPT_POST, true);
       curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    
       // Submit the POST request
       $resultp = curl_exec($ch);
       $result = json_decode($resultp); 
       json_encode($result); 
       curl_close($ch);
    
       header('Location: '.'https://imoneypay.live/orders.php?msg='.$pgResponse['RESPONSE_MESSAGE'].
       "&pg_status=".$pgResponse['STATUS'].
       "&transid=".$pgResponse['TXN_ID'].
       "&orderid=".$pgResponse['ORDER_ID'].
       "&responsecode=".$pgResponse['RESPONSE_CODE']);
    }
?>	


