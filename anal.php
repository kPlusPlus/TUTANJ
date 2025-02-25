<?php 

error_clear_last();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

# include_once "P://temp/f_strcsv.php";
include_once "f_strcsv.php";
# $btcstat = __DIR__ . DIRECTORY_SEPARATOR . 'getbtc_all.csv';
# $btcstat = 'P://temp/getbtc_all.csv';
$btcstat = 'getbtc_all.csv';
$read = file_get_contents($btcstat);

$data = str_getcsv($read , "\n");
$length = count($data);

$arr = array();
for($i=0; $i<$length; $i++)
{
	if (strpos($data[$i],";0$") == false) // clear fake
	{
		$dd = str_getcsv($data[$i], ";");
		array_push($arr, $dd);
	}
}

foreach ($arr as $c => $key) {
	$dateTime[] = $key[0];	
}

array_multisort($dateTime,SORT_ASC,SORT_STRING,$arr);
//print_r($arr);

//echo str_putcsv($arr,false,";",'"');
echo str_putcsv($arr,false,";",'') . PHP_EOL;
echo file_put_contents("getbtcFULL.csv", str_putcsv($arr) );
echo "\n".count($arr)."\n";
?>
