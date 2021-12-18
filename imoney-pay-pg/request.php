<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$request_array = filter_input_array(INPUT_POST);
	 

                foreach ($request_array as $key => $value) {

                        $requestParamsJoined[] = "$key=$value";
                    }
                 
                $responce_data_hash = hash_request_data($requestParamsJoined, $request_array["SALT"]);
                $request_array["HASH"] = $responce_data_hash;
                echo 'Thanks for Using ImoneyPay. You will be redirected to ImoneyPay Payment Page.';
                 
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
 