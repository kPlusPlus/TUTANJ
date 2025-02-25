<?php 
clearstatcache();

error_clear_last();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$ulog = 657.19775;


$config='./getdai.csv';
$btcstat = $config;
$surl = "https://coinmarketcap.com/currencies/multi-collateral-dai/"; // TEST TEST TEST TEST

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
	echo $timeold . " " . number_format($currold,12) . PHP_EOL;

	try {				
		//
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
	
	preg_match('/priceValue___11gHJ">\$(\d{0,10}.\d{0,10})/', $page,$matches,PREG_OFFSET_CAPTURE);

	//var_dump($matches);
	//echo($matches[1][0]);
	//exit;
		
	if( empty( $matches[1][0] )) exit; // TEST TEST TEST
	if( is_null( $matches[1][0] )) exit; 
	
	$curr = $matches[1][0];
	echo($curr.PHP_EOL);
	exit;
	

	$curr = floatval( str_replace(",", "", $curr) );

	if (is_null($curr)) exit;
	$ulogprice = round( (($ulog * $curr) - ($ulog * $currold)) , 4);	
	$datetime = new DateTime();
	$differ = ($curr - $currold);
	$perc = ($curr / $currold);
	echo $datetime->format('Y\-m\-d\ H:i:s') . " " . number_format($curr,12) . PHP_EOL;
	$str = strlen($datetime->format('Y\-m\-d\ H:i:s') . " " . number_format($curr,12));
	$diff=$timeoldparse->diff($datetime);
	$difa = 0.01;
	if ($differ > 0)
	{	
		echo str_repeat("_", 70).PHP_EOL;
		echo "\e[42m". "[diff]" . str_pad(" ", $str - 6 - (strlen(round($differ,2)))," ",STR_PAD_LEFT) . round($differ,2) . "$ " . $perc . " " . (($perc * 100)-100) . "%". "\e[0m". PHP_EOL;
		echo "\e[42m". "[diff] datetime " . $diff->d . " " . $diff->h .":".$diff->i.":".$diff->s .  "\e[0m". PHP_EOL;	
		echo "// ".round(($ulog * $curr),2)." $ "."// ". round($ulogprice,2) . " $".PHP_EOL;
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
		echo "// ".round(($ulog * $curr),2)." $ "."// ". round($ulogprice,2) . " $".PHP_EOL;	
		$ihave = round(($ulog * $curr),2)."$";
		if ($perc < (1-$difa))
		{
			echo str_repeat("<", 60).PHP_EOL;
			cli_beep(); // beep
		}
	}

	if(($j+1)<$i) 	echo "@ " . $j;
	echo " ".PHP_EOL;
	echo number_format($curr, 12). " " . $ihave;

	// date , btc, I have
	file_put_contents( $btcstat, $datetime->format('Y\-m\-d\ H:i:s').";". number_format($curr, 12) .";".$ihave.";".round($ulogprice,2)."\n" , FILE_APPEND );
	//file_put_contents( $config, $datetime->format('Y\-m\-d\ H:i:s') . ";" . $curr );
	if(($j+1)<$i)	
		sleep($clock);
	
}


function cli_beep() // beep
{
	echo "\x07";
}

function last_line($cfile)
{
	$retValll = "";
	$file = file($cfile);
	//$readLines = max(0, count($cfile) - n) - 1; //n being non-zero positive integer
	$readLines = max(0, count($file) - 0) - 1; //n being non-zero positive integer

	if($readLines > 0) {
		//echo "majmune jedan" . PHP_EOL;
		//echo count($file) . PHP_EOL;
		//echo $readLines . PHP_EOL;
		for ($i = $readLines; $i < count($file); $i++) {
			//echo $file[$i];
			$retValll .= $file[$i];
			//echo nl2br("\n");
		}
		//echo "eee".$retValll . PHP_EOL;
		//echo $retValll;
		return $retValll;
	} else {
		//echo 'file does not have required no. of lines to read';
		//echo '';
		return '';
	}
}

?>
