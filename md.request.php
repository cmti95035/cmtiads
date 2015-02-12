<?php
/* mAdserve Ad Request */

require_once 'init.php';

error_reporting(0);

require_once 'functions/r_f.php';
$fp = file_put_contents( '/Users/zhiminhe/logs/cmtiads_requests.log', $_SERVER['QUERY_STRING'] . PHP_EOL .PHP_EOL, FILE_APPEND);
ad_request($_GET);

?>