<?php

error_clear_last();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'geteuro.php';

echo GetEuro().PHP_EOL;






$testvariable = 123;
echo $testvariable.PHP_EOL;
testsada($testvariable);
echo $testvariable.PHP_EOL;


function testsada($testvariable)
{
	$testvariable = $testvariable * 1000;
}


$a = 3; /* global scope */ 
function test()
{ 
	global $a;
    echo $a.PHP_EOL; /* reference to local scope variable */ 
    //$a = floatval($a) + floatval(1);
    $a = ($a) * (5);
} 


test();
echo $a.PHP_EOL;

?>