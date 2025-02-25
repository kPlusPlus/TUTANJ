<?php

error_clear_last();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "vendor/autoload.php";

//include 'geteuro.php';
//echo GetEuro().PHP_EOL;

// github.com/codenix-sv/coingecko-api
use Codenixsv\CoinGeckoApi\CoinGeckoClient;

$client = new CoinGeckoClient();
//$data = $client->derivatives()->getExchanges();
//$response = $client->getLastResponse();
//$headers = $response->getHeaders();

//$data = $client->simple()->getPrice('0x,bitcoin', 'usd,rub');

//$data = $client->coins()->getList();
//var_dump($data);


//$result = $client->coins()->getCoin('bitcoin', ['tickers' => 'false', 'market_data' => 'false']);
//var_dump($result);


$result = $client->coins()->getHistory('bitcoin', '30-12-2017');
var_dump($result);

?>