php 7 Kit:

_____________________________________________________________
index.php
_____________________________________________________________

//set sandbox or production Url by (true/false)
$RequestUrlTypeSandbox = true;

// Merchant_Id and Salt is given by I Money Pay for sandbox or production.
$MerchantId = "Merchant_id";
$Salt = "Salt";

//user pass these parameter dynamically 
$Amount = "";
$CurrencyType = "";
$CustomerName ="";
$OrderId ="";
$CustomerId ="";
$CustomerAddress ="";
$CustomerZipCode ="";
$CustomerEmail ="";
$CustomerMobile ="";
$ProductDesc = "";


______________________________________________________________
request.php
______________________________________________________________

This request.php will create the request and send to payment gateway.


______________________________________________________________
response.php
______________________________________________________________

//Enter the Salt which is given by I Money Pay for sandbox or production.
$Salt = "";


______________________________________________________________
refund.php
______________________________________________________________

//set sandbox or production Url by (true/false)
$sandbox = true;

// Merchant_Id and Salt is given by I Money Pay for sandbox or production.
$PAY_ID = "PAY_ID Provided by I Money Pay";
$SALT ="Salt provided by I Money Pay";

// set the orderId,Amount,currency,pg_ref_num of refund.
$ORDER_ID = "";
$AMOUNT ="";
$CURRENCY_CODE ="356";
$PG_REF_NUM = "";

//txn_type = "REFUND" for refund api
$TXNTYPE = "REFUND";

//refund_order_id is always unique(Use random function or generate dynamically)
$REFUND_ORDER_ID = "Order" . rand(10,9999);

______________________________________________________________
status_enquiry.php
______________________________________________________________

//set sandbox or production Url by (true/false)
$sandbox = true;

// Merchant_Id and Salt is given by PG for sandbox or production.
$PAY_ID = "";
$SALT ="";

//set order_id,amount,currency_code
$ORDER_ID = "Order71529623";
$AMOUNT ="20000";
$CURRENCY_CODE ="356";

//txn_type = "STATUS" for status enquiry api
$TXNTYPE = "STATUS";
