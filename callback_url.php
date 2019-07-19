<?php
//this is the entry point to a response can be smth you get to save to db or file
  $c2bCallbackResponse = file_get_contents('php://input');
  $logFile = "stkPushCallbackResponse.json";
  $log = fopen($logFile, "a");
  fwrite($log, $c2bCallbackResponse);
  fclose($log);