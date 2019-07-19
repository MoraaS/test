<?php
    header("Content-Type: application/json");

    $response = '{ "ResultCode": 0, 
                    "ResultDesc": "Confirmation Received Successfully" }';

    //Retrieving data from mpesa and saving
    //file_get_contents reads file to string

    $mpesaResponse = file_get_contents('php://input');

    //log the response
    $logFile = "validationResponse.txt";
    $jsonMpesaResponse = json_decode($mpesaResponse, true); 
    
    // write the M-PESA Response to file
    $log = fopen($logFile, "a");
    fwrite($log, $mpesaResponse);
    fclose($log);

    echo $response;
    ?>