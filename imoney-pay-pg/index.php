<?php
/*These are mandatory fields
* control sandbox and Production.
* ture = for sandbox;
* false = for Production
*/
$RequestUrlTypeSandbox = true;

// Merchant Id and salt is given by PG.
$MerchantId = "";
$Salt = "";

$Amount ="";


$CurrencyType = "INR";
$CustomerName ="";
$OrderId ="";
$CustomerId ="";
$CustomerAddress ="";
$CustomerZipCode ="";
$CustomerEmail ="";
$CustomerMobile ="";
$ProductDesc = "";




/*
* function for Url status 
* if RequestUrlTypeSandbox = true (it is in sandbox Mode)
* else RequestUrlTypeSandbox = false (it is in Production Mode)
*/
function UrlStatus()
{
  if($GLOBALS['RequestUrlTypeSandbox'] == true ){
   return  $actionUrl ="https://test.imoneypay.in/pgui/jsp/paymentrequest";
   
 }else{
   return  $actionurl ="https://prod.imoneypay.in/pgui/jsp/paymentrequest";
 }

}

/* function for generating return URL.
*
*/
function getReturnUrl()
{
   $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    return $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . 'response.php';
     
}

function currencyType()
{
 if($GLOBALS['CurrencyType'] == "INR"){
    return 356;
 }
elseif($GLOBALS['CurrencyType'] == "USD"){
    return 840;
}
elseif ($GLOBALS['CurrencyType'] == "GBP") {
    return 826;
}
elseif ($GLOBALS['CurrencyType'] == "EUR") {
    return 978;
}else{
    return 356;
}
}

/*
* function for calculating amount
*/
function AmountCalculation(){
    if($GLOBALS['Amount']!=""){
        
        return $GLOBALS['Amount']*100;
    }else{
        return 0;
    }
}

/*
*   Return MerchantId
*/
function MerchantId(){
    return $GLOBALS['MerchantId'];
   // return $GLOBALS['MerchantId'];
}

/*
* Return Salt
*/
function Salt(){
    return $GLOBALS['Salt'];
}

/*
* Return OrderId
*/
function OrderId(){
    if($GLOBALS['OrderId'] == ""){
        $order =  "Order" . rand(10000,99999999);
        return $order;
    }else{
        return $GLOBALS['OrderId'];
    }
    
}

/*
* Return CustomerID
*/
function CustomerId(){
    return "CUSTID".$GLOBALS['OrderId'].rand(10,100000);
}

/*
* Return CustomerName
*/
function CustomerName(){
    return $GLOBALS['CustomerName'];
}

/*
* Return CustomerID
*/
function CustomerAddress(){
    return $GLOBALS['CustomerAddress'];
}

/*
* Return Product Description
*/
function CustomerMobile(){
    return $GLOBALS['CustomerMobile'];
}

/*
* Return Product Description
*/
function CustomerZipCode(){
    return  $GLOBALS['CustomerZipCode'];
}

/*
* Return Product Description
*/
function CustomerEmail(){
    return $GLOBALS['CustomerEmail'];
}

/*
* Return Product Description
*/
function ProductDesc(){
    return $GLOBALS['ProductDesc'];
}


?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Demo Merchant Checkout Page</title>
 
<style type="text/css">
body {
	width:100%;
	margin: 0 auto;
	background-color:#e4eff5;
}
.new {
	width: 500px;
	margin:20px auto 0 auto; padding:0; font:normal 12px arial; color:#555; background:#fff; border:1px solid #d0d0d0; border-radius:5px; 
-webkit-box-shadow: -1px 3px 8px -1px rgba(0,0,0,0.75);
-moz-box-shadow: -1px 3px 8px -1px rgba(0,0,0,0.75);
box-shadow: -1px 3px 8px -1px rgba(0,0,0,0.75);
}
.signupbox { margin:20px auto 0 auto; padding:0; font:normal 12px arial; color:#555; background:#fff; border:1px solid #d0d0d0; border-radius:5px; 
-webkit-box-shadow: -1px 3px 8px -1px rgba(0,0,0,0.75);
-moz-box-shadow: -1px 3px 8px -1px rgba(0,0,0,0.75);
box-shadow: -1px 3px 8px -1px rgba(0,0,0,0.75);}
.signup-headingbg { background:#194e84; background-image:-webkit-linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent);background-image:linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent);background-size:5px 5px; height:35px; border-bottom:1px solid #dadada; font:bold 16px Tahoma; color:#ffffff; vertical-align:middle; }
.signuptextfield { display: block;  width:98%;  height: 15px;  padding: 6px 7px;  padding:6px\9; margin-left:10px;  font-size: 12px;  font-family: 'Titillium Web', sans-serif;
  line-height: 1.428571429;  color: #555; margin-bottom:5px;  background-color: #fff;  background-image: none;  border: 1px solid #ccc;
  border-radius: 4px;  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);  box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
  -webkit-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;  transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
  }		  
.signuptextfield:focus {  border-color: #66afe9;  outline: 0;  -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102, 175, 233, .6);
  box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102, 175, 233, .6); }
.labelfont {font:bold 11px Arial; color:#607a8c; text-decoration:none;}  		  
.signupbutton { background-color:#5cb85c; border:1px solid #4cae4c; width:40%; height:35px;  font:bold 14px Tahoma; text-align:center; color:#fff; cursor:pointer; border-radius:5px;}
.signupbutton:hover { background-color:#449d44; border:1px solid #398439; width:40%; height:35px;  font:bold 14px Tahoma; text-align:center; color:#fff; cursor:pointer; border-radius:5px;}
.borderleftradius { border-top-left-radius:5px; }
.borderrightradius { border-top-right-radius:5px; }
.gradientbg {/* IE10 Consumer Preview */ 
background-image: -ms-linear-gradient(top, #FEFEFF 0%, #BFD3E1 100%);

/* Mozilla Firefox */ 
background-image: -moz-linear-gradient(top, #FEFEFF 0%, #BFD3E1 100%);

/* Opera */ 
background-image: -o-linear-gradient(top, #FEFEFF 0%, #BFD3E1 100%);

/* Webkit (Safari/Chrome 10) */ 
background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0, #FEFEFF), color-stop(1, #BFD3E1));

/* Webkit (Chrome 11+) */ 
background-image: -webkit-linear-gradient(top, #FEFEFF 0%, #BFD3E1 100%);

/* W3C Markup, IE10 Release Preview */ 
background-image: linear-gradient(to bottom, #FEFEFF 0%, #BFD3E1 100%);}

img {
  display: block;
  margin-left: auto;
  margin-right: auto;

</style>
</head>
<body>
 
<div class="new">
    <div>
        <img src="images/logo.png";/>
    </div>

			<form method="post" action="request.php">
			  <table width="500" border="0" align="center" cellpadding="0" cellspacing="0" class="gradientbg">
				  <tr>
						<td colspan="3" align="center" valign="middle"></td>

				</tr>
					<tr>
					  <td colspan="3" align="center" valign="middle" class="signup-headingbg borderleftradius borderrightradius">PHP Plugin</td>
				  </tr>
					<tr>
					  <td align="right" valign="middle">&nbsp;</td>
					  <td align="center" valign="middle">&nbsp;</td>
					  <td align="center" valign="middle">&nbsp;</td>
		        </tr>
                <tr>
                        <td width="28%" align="right" valign="middle" class="labelfont">URL: </td>
                      <td width="65%" align="left" valign="middle"><input
                            type="text" name="URL"   class="signuptextfield" value="<?php echo UrlStatus() ?>" autocomplete="off" /></td>
                      <td width="7%" align="left" valign="middle">&nbsp;</td>
                </tr>
                 <tr>
                        <td width="28%" align="right" valign="middle" class="labelfont">SALT: </td>
                      <td width="65%" align="left" valign="middle"><input
                            type="text" name="SALT"   class="signuptextfield" value="<?php echo Salt() ?>" autocomplete="off" /></td>
                      <td width="7%" align="left" valign="middle">&nbsp;</td>
                </tr>
                
					<tr>
						<td width="28%" align="right" valign="middle" class="labelfont">PAY ID: </td>
					  <td width="65%" align="left" valign="middle"><input
							type="text" name="PAY_ID" class="signuptextfield" value="<?php echo MerchantId()?>" autocomplete="off" /></td>
					  <td width="7%" align="left" valign="middle">&nbsp;</td>
				</tr>
					<tr>
						<td width="28%" align="right" valign="middle" class="labelfont">ORDER ID: </td>
					  <td width="65%" align="left" valign="middle"><input
							type="text"  name="ORDER_ID" class="signuptextfield" value="<?php echo OrderId()?>" autocomplete="off" /></td>
						<td width="7%" align="left" valign="middle">&nbsp;</td>
				</tr>
					<tr>
						<td width="28%" align="right" valign="middle" class="labelfont">AMOUNT: </td>
					  <td width="65%" align="left" valign="middle"><input
							type="text" name="AMOUNT" class="signuptextfield" value="<?php echo AmountCalculation()?>"  autocomplete="off"/></td>
						<td width="7%" align="left" valign="middle">&nbsp;</td>
				</tr>
					<tr>
						<td width="28%" align="right" valign="middle" class="labelfont">TXNTYPE: </td>
					  <td width="65%" align="left" valign="middle"><input
							type="text" name="TXNTYPE" class="signuptextfield" value="SALE" autocomplete="off"/></td>
						<td width="7%" align="left" valign="middle">&nbsp;</td>
				</tr>
					<tr>
						<td width="28%" align="right" valign="middle" class="labelfont">CUSTOMER NAME: </td>
					  <td width="65%" align="left" valign="middle"><input
							type="text" name="CUST_NAME" class="signuptextfield" value="<?php echo CustomerName()?>" autocomplete="off"/></td>
						<td width="7%" align="left" valign="middle">&nbsp;</td>
				</tr>			
							
					<tr>
						<td width="28%" align="right" valign="middle" class="labelfont">CUSTOMER ADDRESS: </td>
					  <td width="65%" align="left" valign="middle"><input
							type="text" name="CUST_STREET_ADDRESS1" class="signuptextfield" value="<?php echo CustomerAddress()?>" autocomplete="off"/></td>
						<td width="7%" align="left" valign="middle">&nbsp;</td>
				</tr>					
					<tr>
						<td width="28%" align="right" valign="middle" class="labelfont">CUSTOMER ZIP: </td>
					  <td width="65%" align="left" valign="middle"><input
							type="text" name="CUST_ZIP" value="<?php echo CustomerZipCode()?>" class="signuptextfield" autocomplete="off"/></td>
						<td width="7%" align="left" valign="middle">&nbsp;</td>
				</tr>
					<tr>
						<td width="28%" align="right" valign="middle" class="labelfont">CUSTOMER PHONE: </td>
					  <td width="65%" align="left" valign="middle"><input
							type="text" name="CUST_PHONE" value="<?php echo CustomerMobile()?>" class="signuptextfield" autocomplete="off"/></td>
						<td width="7%" align="left" valign="middle">&nbsp;</td>
				</tr>
					<tr>
						<td width="28%" align="right" valign="middle" class="labelfont">CUSTOMER EMAILID: </td>
					  <td width="65%" align="left" valign="middle"><input
							type="text" name="CUST_EMAIL" class="signuptextfield" value="<?php echo CustomerEmail()?>" autocomplete="off"/></td>
						<td width="7%" align="left" valign="middle">&nbsp;</td>
				</tr>
				<tr>
						<td width="28%" align="right" valign="middle" class="labelfont">CUSTOMER ID</td>
					  <td width="65%" align="left" valign="middle"><input
							type="text" name="CUST_ID" class="signuptextfield" value="<?php echo CustomerId() ?>" autocomplete="off"/></td>
						<td width="7%" align="left" valign="middle">&nbsp;</td>
				</tr>
					<tr>
						<td width="28%" align="right" valign="middle" class="labelfont">PRODUCT DESC: </td>
					  <td width="65%" align="left" valign="middle"><input
							type="text" name="PRODUCT_DESC" class="signuptextfield" value="<?php echo ProductDesc()?>" autocomplete="off"/></td>
						<td width="7%" align="left" valign="middle">&nbsp;</td>
				</tr>
					<tr>
						<td width="28%" align="right" valign="middle" class="labelfont">CURRENCY CODE: </td>
					  <td width="65%" align="left" valign="middle"><input
							type="text" name="CURRENCY_CODE" class="signuptextfield" value="<?php echo currencyType() ?>"autocomplete="off" /></td>
						<td width="7%" align="left" valign="middle">&nbsp;</td>
				</tr>
					<tr>

					<td width="28%" align="right" valign="middle" class="labelfont">RETURN URL: </td>
					<td width="65%" align="left" valign="middle"><input
							type="text" name="RETURN_URL" class="signuptextfield" value="<?php echo getReturnUrl() ?>"autocomplete="off" /></td>
					<td width="7%" align="left" valign="middle">&nbsp;</td>
				</tr>
					 
					<tr>
					  <td colspan="3" align="center" valign="middle">&nbsp;</td>
			    </tr>
					<tr>
						<!-- <td width="50%" align="right" ></td> -->
						<td colspan="3" align="center" valign="middle">
						<input type="submit" id="button" class="signupbutton" value="Pay Now" />						
						</td>
				</tr>
					<tr>
					  <td colspan="3" align="center" valign="middle">&nbsp;</td>
			    </tr>
			  </table>
			</form>
</div></body>
</html>












