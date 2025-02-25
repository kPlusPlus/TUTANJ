<?php

error_clear_last();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "vendor/autoload.php";
use Codenixsv\CoinGeckoApi\CoinGeckoClient;

$client = new CoinGeckoClient();
$data = $client->simple()->getPrice('bitcoin', 'usd');
print_r($data);
$data = $client->simple()->getPrice('ethereum', 'usd');
print_r($data);
$data = $client->simple()->getPrice('tron', 'usd');
print_r($data);
$data = $client->simple()->getPrice('airswap', 'usd');
print_r($data);
print_r( $data['airswap']['usd']);
$priceinfo = $data['airswap']['usd'];

$data = $client->simple()->getPrice('avalanche-2', 'usd');
print_r($data);
