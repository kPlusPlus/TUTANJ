<?php
error_clear_last();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$surl = "https://www.marketwatch.com/investing/cryptocurrency/btcusd";
$page = file_get_contents($surl);

preg_match('%<bg-quote .*format="0,0.".*channel="/zigman2/quotes/31322028/realtime">(\d{0,10}.\d{0,10})</bg-quote>%', $page, $matches, PREG_OFFSET_CAPTURE);

var_dump($matches);
echo $matches[0][0];
echo $matches[1][0];
?>