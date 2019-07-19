<?php
    $url = 'https://sandbox.safaricom.co.ke/mpesa/c2b/v1/registerurl';

    //Fill in the request parameters with valid values
    //when on live server change links to match those
    //obtain short code from test codes of dev portal

	$access_token = 'hQDeVJhYInPVDiKrhMDRv71GrteT';
	$shortCode = '600611';
	$confirmationUrl = __DIR__.'\c2b_api\test\confirmation_url.php';
	$validationUrl = __DIR__.'\c2b_api\test\validation_url.php';
    
    $curl = curl_init();
    
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer ' .$access_token)); //setting custom header
	$curl_post_data = array(
	  //Fill in the request parameters with valid values
	  'ShortCode' => $shortCode,
	  'ResponseType' => 'Confirmed',
	  'ConfirmationURL' => $confirmationUrl,
	  'ValidationURL' => $validationUrl
    );
    
    $data_string = json_encode($curl_post_data);
    
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
    
    $curl_response = curl_exec($curl);
    
    print_r($curl_response);
    
	echo $curl_response;
?>