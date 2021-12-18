<?php
include_once("../api/billpay.php");

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

 
                if ($responce_data_hash == $receivedHash && $RESPONSE_CODE == 000 && $STATUS == "Captured") {
                      $RESPONSE_MESSAGE = "Transaction Successful";
                      billPayment($_REQUEST); die;
                      
                }else{
                     $RESPONSE_MESSAGE = "Payment failed ";
                     billPayment($_REQUEST); die;
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



 




?>	



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PG PHP7 Kit</title>
</head>
<style type="text/css">
    .main {
        margin-left:30px;
        font-family:Verdana, Geneva, sans-serif, serif;
    }
    .text {
        float:left;
        width:180px;
    }
    .dv {
        margin-bottom:5px;
    }
</style>
<body>
<div class="main">
    <div>
        <img src="images/logo.png" />
    </div>
    <div>
        <h3> PHP Kit Response</h3>
    </div>
 
    <div class="dv">
    <span class="text"><label>Order ID:</label></span>
    <span><?php echo $ORDER_ID; ?></span>
    </div>
    
    <div class="dv">
    <span class="text"><label>Amount:</label></span>
    <span><?php echo $AMOUNT; ?></span>    
    </div>
    
    <div class="dv">
    <span class="text"><label>Product Info:</label></span>
    <span><?php echo $PRODUCT_DESC; ?></span>
    </div>
    
    <div class="dv">
    <span class="text"><label>Customer Name:</label></span>
    <span><?php echo $CUST_NAME; ?></span>
    </div>
    
    <div class="dv">
    <span class="text"><label>Email ID:</label></span>
    <span><?php echo $CUST_EMAIL; ?></span>
    </div>
    
    <div class="dv">
    <span class="text"><label>PG Ref No:</label></span>
    <span><?php echo $PG_REF_NUM; ?></span>
    </div>
    
    <div class="dv">
    <span class="text"><label>TXN ID:</label></span>
    <span><?php echo $TXN_ID; ?></span>
    </div>
    
    <div class="dv">
    <span class="text"><label>Transaction Status:</label></span>
    <span><?php echo $STATUS; ?></span>
    </div>
    
    <div class="dv">
    <span class="text"><label>Message:</label></span>
    <span><?php echo $RESPONSE_MESSAGE; ?></span>
    </div>
</div>
</body>
</html>
