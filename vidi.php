<?php 
clearstatcache();

error_clear_last();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo str_repeat(">", 60).PHP_EOL;
			cli_beep(); // beep
			echo "marko".PHP_EOL;
echo str_repeat("<", 60).PHP_EOL;
			cli_beep(); // beep
			echo "slavko";


function cli_beep() // beep
{
	echo "\x07";
}
?>