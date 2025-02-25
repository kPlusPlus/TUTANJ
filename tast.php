<?php 

clearstatcache();
error_clear_last();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('user_agent','Mozilla/4.0 (compatible; MSIE 6.0)');
error_reporting(E_ALL);

$surl = "https://coinmarketcap.com/currencies/bitcoin/";
$surl = "http://coinmarketcap.com/currencies/bitcoin/";
$surl = "https://www.coindesk.com/price/dogecoin/";
$surl = "https://www.marketwatch.com/investing/cryptocurrency/btcusd";


//$stream = fopen($surl,'r');
//echo $stream;


$page = file_get_contents($surl);
file_put_contents('getbtc.html',$page);
echo $page;


  
?>