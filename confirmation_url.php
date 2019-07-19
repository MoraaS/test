<?php
require 'config.php';
    header("Content-Type: application/json");

    $response = '{ "ResultCode": 0, 
                    "ResultDesc": "Confirmation Received Successfully" }';

    //Retrieving data from mpesa and saving
    //file_get_contents reads file to string
    //response from mpesa stream

    $mpesaResponse = file_get_contents('php://input');

    //log the response
    $logFile = "M_PESAConfirmationResponse.txt";
    $jsonMpesaResponse = json_decode($mpesaResponse, true); //use this to save to db

    //transaction in an array to be able to execute as an array

    $transaction = array(
        ":TransactionType"      =>$jsonMpesaResponse['TransactionType'],
        ":TransID"              =>$jsonMpesaResponse['TransID'],
        ":TransTime"            =>$jsonMpesaResponse['TransTime'],
        ":TransAmount"          =>$jsonMpesaResponse['TransAmount'],
        ":BusinessShortCode"    =>$jsonMpesaResponse['BusinessShortCode'],
        ":BillRefNumber"        =>$jsonMpesaResponse['BillRefNumber'],
        ":InvoiceNumber"        =>$jsonMpesaResponse['InvoiceNumber'],
        ":OrgAccountBalance"    =>$jsonMpesaResponse['OrgAccountBalance'],
        ":ThirdPartyTransID"    =>$jsonMpesaResponse['ThirdPartyTransID'],
        ":MSISDN"               =>$jsonMpesaResponse['MSISDN'],
        ":FirstName"            =>$jsonMpesaResponse['FirstName'],
        ":MiddleName"           =>$jsonMpesaResponse['MiddleName'],
        ":LastName"             =>$jsonMpesaResponse['LastName']
    );
    
    
    // write the M-PESA Response to file
    $log = fopen($logFile, "a");
    fwrite($log, $mpesaResponse);
    fclose($log);

    insert_response($transaction);
    echo $response;
    ?>