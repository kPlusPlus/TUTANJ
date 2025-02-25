<?php

error_clear_last();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/* -------------------------------- */
$timeoldparse = new DateTime();
$timeoldparse = date_create('2023-02-11 11:43:18');
$datetime = new DateTime();

$interval = date_diff($timeoldparse, $datetime);
echo $interval->format("%H:%I:%S (Full days: %a)"), "\n";

?>