<?php 
clearstatcache();

error_clear_last();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('user_agent','Mozilla/4.0 (compatible; MSIE 6.0)');
error_reporting(E_ALL);
include 'geteuro.php';

//$ulog = 0.12371808;
//$ulog = 0.1210235;
//$ulog = 0.14203268;
//$ulog = 0.13981675;
//$ulog = 0.13869427;
$ulog = 0.00069404;

$config='./getbtc.csv';
$btcstat = './getbtc.csv';

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
	echo $timeold . " " . number_format($currold,2) . PHP_EOL;

	try {				
		$surl = "https://www.marketwatch.com/investing/cryptocurrency/btcusd";
		$page = file_get_contents($surl);
		//file_put_contents('getbtc.html',$page);
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

	//preg_match('/priceValue ">\$(\d{0,10},\d{0,10}.\d{0,10})/', $page,$matches,PREG_OFFSET_CAPTURE);
	preg_match('%<bg-quote .*format="0,0.".*channel="/zigman2/quotes/31322028/realtime">(\d{0,10}.\d{0,10})</bg-quote>%', $page,$matches,PREG_OFFSET_CAPTURE);

	//var_dump($matches);
	//echo($matches[1][0]);
	//exit;
	
	if( empty( $matches[1][0] )) exit; // TEST TEST TEST
	if( is_null( $matches[1][0] )) exit; 
	
	$curr = $matches[1][0];
	$curr = floatval( str_replace(",", "", $curr) );

	if (is_null($curr)) exit;
	$ulogprice = round( (($ulog * $curr) - ($ulog * $currold)) , 4);	
	$datetime = new DateTime();
	$differ = ($curr - $currold);
	$perc = ($curr / $currold);
	echo $datetime->format('Y\-m\-d\ H:i:s') . " " . number_format($curr,2) . PHP_EOL;
	$str = strlen($datetime->format('Y\-m\-d\ H:i:s') . " " . number_format($curr,2));
	$diff=$timeoldparse->diff($datetime);
	$difa = 0.01;
	$geteuro = GetEuro();	
	PrintRepo();

	/*
	if ($differ > 0)
	{	
		echo str_repeat("_", 70).PHP_EOL;
		echo "\e[42m". "[diff]" . str_pad(" ", $str - 6 - (strlen(round($differ,2)))," ",STR_PAD_LEFT) . round($differ,2) . "$ " . $perc . " " . (($perc * 100)-100) . "%". "\e[0m". PHP_EOL;
		echo "\e[42m". "[diff] datetime " . $diff->d . " " . $diff->h .":".$diff->i.":".$diff->s .  "\e[0m". PHP_EOL;	
		echo "// ".round(($ulog * $curr),2)." $ "."// ". round($ulogprice,2) . " $"." ".round(GetEuro()*$ulogprice,2)." €".PHP_EOL;
		$ihave = round(($ulog * $curr),2) . "$";		
		if ($perc > (1 + $difa)){
			echo str_repeat(">", 60).PHP_EOL;
			cli_beep(); // beep
		}
	}
	if ($differ < 0)
	{
		echo str_repeat("_", 70).PHP_EOL;
		echo "\e[1;37;41m". "[diff] " . str_pad(" ", $str - 7  - (strlen(round($differ,2)))," ",STR_PAD_LEFT) . round($differ,2) . "$ " . $perc . " " . (($perc * 100)-100) . "%". "\e[0m".PHP_EOL;	
		echo "\e[1;37;41m". "[diff] datetime " . $diff->d . " " . $diff->h .":".$diff->i.":".$diff->s .  "\e[0m". PHP_EOL;
		echo "// ".round(($ulog * $curr),2)." $ "."// ". round($ulogprice,2) . " $"." ".round(GetEuro()*$ulogprice,2)." €".PHP_EOL;	
		$ihave = round(($ulog * $curr),2)."$";
		if ($perc < (1-$difa))
		{
			echo str_repeat("<", 60).PHP_EOL;
			cli_beep(); // beep
		}
	}
	*/

	if(($j+1)<$i) 	echo "@ " . $j;
	echo " ".PHP_EOL;

	// date , btc, I have
	file_put_contents( $btcstat, $datetime->format('Y\-m\-d\ H:i:s').";".$curr.";".$ihave.";".round($ulogprice,2)."\n" , FILE_APPEND );
	//file_put_contents( $config, $datetime->format('Y\-m\-d\ H:i:s') . ";" . $curr );
	if(($j+1)<$i)	
		sleep($clock);
	
}




?>
