<?php 

//error header
error_clear_last();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// https://www.php.net/manual/en/function.getopt.php
$optind = null;
$opts = getopt('n:');
var_dump($opts);

/*
// make loop
$i=10; //Time delay    
for($j=1;$j<$i;$j++)  
{  
    echo $j . PHP_EOL;  
    sleep(2);
    //do something to delay the execution by $i seconds  
} 
*/

?> 