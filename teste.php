<?php

error_clear_last();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);




$url ='https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd';// path to your JSON file
  $data = file_get_contents($url);
  $priceInfo = json_decode($data);
  print_r($priceInfo);

  //print_r($priceInfo);
  print_r($priceInfo[33]);
  //print_r($priceInfo[8]->id);
  echo getCoinGecko(33);


function getCoinGecko($currID)
{
  $url ='https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd';// path to your JSON file
  $data = file_get_contents($url);
  $priceInfo = json_decode($data);
  $currprice = $priceInfo[$currID]->current_price;
  return $currprice;
}

?>