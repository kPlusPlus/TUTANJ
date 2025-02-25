<?php
require_once "vendor/autoload.php";
use Codenixsv\CoinGeckoApi\CoinGeckoClient;
error_clear_last();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function TESTIS() {
    $arrContextOptions=array(
        "ssl"=>array(
            "verify_peer"=>false,
            "verify_peer_name"=>false,
        ),
    );     
    $req_url = 'https://coinmarketcap.com/watchlist/';
    $req_url = 'https://www.coingecko.com/en/coins/ethereum';
    $response_coinmarketcap = file_get_contents($req_url, false, stream_context_create($arrContextOptions));
    echo $response_coinmarketcap;
}

function GetEuro() {

    $arrContextOptions=array(
        "ssl"=>array(
            "verify_peer"=>false,
            "verify_peer_name"=>false,
        ),
    ); 
    
// Fetching JSON
    $req_url = 'https://api.exchangerate-api.com/v4/latest/USD';
    $response_json = file_get_contents($req_url, false, stream_context_create($arrContextOptions));

// Continuing if we got a result
    if(false !== $response_json) {

    // Try/catch for json_decode operation
        try {

    // Decoding
            $response_object = json_decode($response_json);

    // YOUR APPLICATION CODE HERE, e.g.
    //$base_price = 12; // Your price in USD
    //$EUR_price = round(($base_price * $response_object->rates->EUR), 2);
    //echo $response_object->rates->EUR;
            $USD_TO_EURO = $response_object->rates->EUR;
            return $USD_TO_EURO;
        }
        catch(Exception $e) {
        // Handle JSON parse error...
            return 0;
        }
    }
}


function cli_beep() // beep
{
    echo "\x07";
}


function last_line($cfile)
{
    $retValll = "";
    $file = file($cfile);    
    $readLines = max(0, count($file) - 0) - 1; //n being non-zero positive integer

    if($readLines > 0) {        
        for ($i = $readLines; $i < count($file); $i++) {        
            $retValll .= $file[$i];            
        }        
        return $retValll;
    } else {        
        return '';
    }
}


//function for display
function PrintRepo()
{
    global $differ,$diff,$str,$ulog,$ulogprice,$curr,$factorassist,$perc,$difa,$geteuro,$ihave;
    $ihave = round(($ulog * $curr),2) . "$";
    $ihaveuro = round(($ulog * $curr * $geteuro),2) . "€";
    
    if (php_sapi_name() === 'cli') {
        if ($differ > 0)
        {   
            echo str_repeat("_", 70).PHP_EOL;
            echo "\e[42m". "[diff]" . str_pad(" ", $str - 6 - (strlen(round($differ,2)))," ",STR_PAD_LEFT) . round($differ,2) . "$ " . $perc . " " . (($perc * 100)-100) . "%". "\e[0m". PHP_EOL;
            echo "\e[42m". "[diff] datetime " . $diff->d . " " . $diff->h .":".$diff->i.":".$diff->s .  "\e[0m". PHP_EOL;   
            echo "// ".$ihave." ".$ihaveuro." // ". round($ulogprice,2) . " $"." ".round($geteuro*$ulogprice,2)." €".PHP_EOL;
            if ($perc > ($factorassist + $difa)){
                echo str_repeat(">", 60).PHP_EOL;
                cli_beep(); // beep
            }
        }
        if ($differ < 0)
        {
            echo str_repeat("_", 70).PHP_EOL;
            echo "\e[1;37;41m". "[diff] " . str_pad(" ", $str - 7  - (strlen(round($differ,2)))," ",STR_PAD_LEFT) . round($differ,2) . "$ " . $perc . " " . (($perc * 100)-100) . "%". "\e[0m".PHP_EOL; 
            echo "\e[1;37;41m". "[diff] datetime " . $diff->d . " " . $diff->h .":".$diff->i.":".$diff->s .  "\e[0m". PHP_EOL;
            echo "// ".$ihave." ".$ihaveuro." // ". round($ulogprice,2) . " $"." ".round($geteuro*$ulogprice,2)." €".PHP_EOL;       
            if ($perc < ($factorassist - $difa))
            {
                echo str_repeat("<", 60).PHP_EOL;
                cli_beep(); // beep
            }
        }
    }
    else
    {
        $newline = "<br>\n";
        if ($differ > 0)
        {               
            echo $newline.str_repeat("_", 70).$newline;
            echo " ". "<br>[diff]" . str_pad(" ", $str - 6 - (strlen(round($differ,2)))," ",STR_PAD_LEFT) . round($differ,2) . "$ " . $perc . " " . (($perc * 100)-100) . "%". " ". $newline;
            echo " ". "<br>[diff] datetime " . $diff->d . " " . $diff->h .":".$diff->i.":".$diff->s .  " ". $newline;   
            echo "// ".$ihave." ".$ihaveuro." // ". round($ulogprice,2) . " $"." ".round($geteuro*$ulogprice,2)." €".$newline;
            if ($perc > ($factorassist + $difa)){
                echo str_repeat(">", 60).$newline;
                cli_beep(); // beep
            }
        }
        if ($differ < 0)
        {            
            echo $newline.str_repeat("_", 70).$newline;
            echo " ". "<br>[diff] " . str_pad(" ", $str - 7  - (strlen(round($differ,2)))," ",STR_PAD_LEFT) . round($differ,2) . "$ " . $perc . " " . (($perc * 100)-100) . "%". " ".$newline; 
            echo " ". "<br>[diff] datetime " . $diff->d . " " . $diff->h .":".$diff->i.":".$diff->s .  " ". $newline;
            echo "// ".$ihave." ".$ihaveuro." // ". round($ulogprice,2) . " $"." ".round($geteuro*$ulogprice,2)." €".$newline;       
            if ($perc < ($factorassist - $difa))
            {
                echo str_repeat("<", 60).PHP_EOL;
                cli_beep(); // beep
            }
        }
    }
}


function file_get_contents_curl($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //Set curl to return the data instead of printing it to the browser.
    curl_setopt($ch, CURLOPT_URL, $url);
    $data = curl_exec($ch);    
    curl_close($ch);    
    return $data;
}


function file_get_contents_curl_asta($url) {
    
    $certificate_location = "D:\ca-bundle.crt"; // modify this line accordingly (may need to be absolute)

    
    $ch = curl_init();
     $user_agent='Mozilla/5.0 (Windows NT 6.1; rv:8.0) Gecko/20100101 Firefox/8.0';
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
          curl_setopt($ch, CURLOPT_AUTOREFERER, false);
    curl_setopt($ch, CURLOPT_VERBOSE, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);

        curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSLVERSION,CURL_SSLVERSION_DEFAULT);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $webcontent= curl_exec ($ch);
        $error = curl_error($ch); 
        curl_close ($ch);

    /*
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //Set curl to return the data instead of printing it to the browser.
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST , "GET");
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch,CURLOPT_HTTPHEADER , [
		"X-RapidAPI-Host: coingecko.p.rapidapi.com",
		"X-RapidAPI-Key: 032ddd33c9mshc4cde9525b63098p1f98f0jsn6c06c0f4e40c"
	]);

    */

    return $datawebcontent;
}



//TODO: test test test
function getCoinGecko($currID)
{
  $url ='https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd';// path to your JSON file
    curl_setopt($url, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($url, CURLOPT_SSL_VERIFYPEER, false);
  $data = file_get_contents($url);
  $priceInfo = json_decode($data);  
  $currprice = $priceInfo[$currID]->current_price;
  return $currprice;
}

function getCoinGeckoSSL($currID)
{
  $url ='https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd';// path to your JSON file
  $data = file_get_contents_curl_asta($url);

    echo $data;    
    exit();

  $priceInfo = json_decode($data);
  $currprice = $priceInfo[$currID]->current_price;
  return $currprice;
}

function getCoinGeckoAPI($currName)
{
    $client = new CoinGeckoClient();
    //$data = $client->simple()->getPrice('bitcoin', 'usd');
    $data = $client->simple()->getPrice($currName, 'usd');
    $priceInfo = $data[$currName]['usd'];
    return $priceInfo;
}




// TEST
//echo GetEuro();

//echo getCoinGeckoAPI("moviebloc");

//echo getCoinGeckoAPI('bitcoin'). " call 1";
//echo getCoinGeckoAPI('moviebloc'). " call 2";
//echo getCoinGeckoAPI('moviebloc'). " call 3";
//echo getCoinGeckoSSL(1);

/*
echo getCoinGeckoAPI('ethereum');

$client = new CoinGeckoClient();
//$data = $client->simple()->getPrice('0x,bitcoin', 'usd');
$data = $client->simple()->getPrice('ethereum', 'usd');
//$data = $client->simple()->getSupportedVsCurrencies();
//$data = $client->coins()->getList();
print_r( $data );
*/

?>

