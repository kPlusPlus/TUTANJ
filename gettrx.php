<?php 

error_clear_last();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'geteuro.php';

//$ulog = 0.12371808;
//$ulog = 0.4263185;
//$ulog = 1298.26754;
$ulog = 2854.143;
$config = 'gettrx.csv';
$btcstat = 'gettrx.csv';
$API = 1;

if (count($argv) > 1){
	$i = $argv[1]; //Time delay from argument
	if ($i == "g") $i = 99999;
}
else
{
	$i=2; //Time delay
}

if (count($argv) > 2) {
	$clock = $argv[2];
}
else
{
	$clock = 60;
}

for($j=1;$j<$i;$j++)  
{  
	//$read = file_get_contents($config);
	$read = last_line($config); // TEST TEST TEST TEST
	$readarr = explode(';', $read);
	$currold = floatval($readarr[1]);
	$timeold = $readarr[0];
	$timeoldparse = new DateTime($timeold);
	$ihave = 0;
	echo $timeold . " " . number_format($currold,6) . PHP_EOL;

if($API != 1) {
	try {		
		//$surl = "https://coinmarketcap.com/currencies/bitcoin/#charts";
		//$surl = "https://www.marketwatch.com/investing/cryptocurrency/trxusd";
		$surl = "https://www.coingecko.com/en/coins/tron";
		$page = file_get_contents($surl);
		if($page === false)	{
			echo "NO PAGE CONTENT".PHP_EOL;
			exit;
		}
	} 
	catch (Exception $err)  
	{
		echo "error 1. some internet problem ".$err;
		echo $err->getMessage();
		exit(); // TODO Test
	}

	preg_match('%data-coin-symbol="trx" data-target="price.price">\$(\d{0,10}.\d{0,10})%', $page,$matches,PREG_OFFSET_CAPTURE);
	
	$curr = $matches[1][0];
	$curr = floatval( str_replace(",", "", $curr) );	
}

if ($API == 1)
{
	$curr = getCoinGeckoAPI('tron');
}
	if (is_null($curr)) exit;
	$ulogprice = round( (($ulog * $curr) - ($ulog * $currold)) , 6);	
	$datetime = new DateTime("now");
	$differ = ($curr - $currold);
	$perc = ($curr / $currold);
	echo $datetime->format('Y\-m\-d\ H:i:s') . " " . number_format($curr,6) . PHP_EOL;
	$str = strlen($datetime->format('Y\-m\-d\ H:i:s') . " " . number_format($curr,2));
	$diff=$timeoldparse->diff($datetime);
	$difa = 0.01;
	$factorassist = 1;
	$geteuro = GetEuro();	
	PrintRepo();
	
	if(($j+1)<$i) 	echo "@ " . $j;
	echo " ".PHP_EOL;

	// date , btc, I have
	file_put_contents( $btcstat, $datetime->format('Y\-m\-d\ H:i:s').";".$curr.";".$ihave.";".round($ulogprice,2)."\n" , FILE_APPEND );
	//file_put_contents( $config, $datetime->format('Y\-m\-d\ H:i:s') . ";" . $curr );
	if(($j+1)<$i)	
		sleep($clock);
	
}


?>