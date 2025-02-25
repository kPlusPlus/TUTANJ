<?php

$url="https://api.coindesk.com/v1/bpi/currentprice/BTC.json";
$ch = curl_init();


curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

$result = curl_exec($ch);
curl_close($ch);

echo $result;

?>