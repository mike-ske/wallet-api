<?php

require_once 'HTTP/Request2.php';
$request = new HTTP_Request2();
$request->setUrl('https://sandbox.wallets.africa/bills/airtime/providers');
$request->setMethod(HTTP_Request2::METHOD_POST);
$request->setConfig(array(
  'follow_redirects' => TRUE
));

//require SDK
use AfricasTalking\SDK\AfricasTalking;

$username = 'alumona';
$publickey = 'hfucj5jatq8h';
$apiSecretkey = 'uvjqzm5x16bw';

//initialize SDK
$at = new AfricasTalking($username, $apisecretkey)


//get airtime service
$airtime = $at->airtime();


$request->setHeader(array(
  'Content-Type' => 'application/json'
  'Authorization: Bearer '.$publickey.''
));


//fetch data from form field
    $number = $_POST['number'];
    $network = $_POST['network'];
    $amount = $_POST['amount'];
    $currencyCode = "NGN";


$request->setBody('{
\n  "Code": '.$currencyCode.',
\n  "Amount": '.$amount.',
\n  "PhoneNumber": '.$number.',
\n  "SecretKey": '.$apiSecretkey.'
\n}');
try {
  $response = $request->send();/
  if ($response->getStatus() == 200) {
    echo $response->getBody();
  }
  else {
    echo 'Unexpected HTTP status: ' . $response->getStatus() . ' ' .
    $response->getReasonPhrase();
  }
}
catch(HTTP_Request2_Exception $e) {
  echo 'Error: ' . $e->getMessage();
}

?>