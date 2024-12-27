<?php

$mysql_hostname = 'dev.cxuwu04we8ge.ap-northeast-2.rds.amazonaws.com';
$mysql_username = 'admin';
$mysql_password = 'a2633218*';
$mysql_database = 'yeosu_clean_gejang';

error_reporting(E_ALL);
ini_set("display_errors", 1);

date_default_timezone_set('Asia/Seoul');

$conn = mysqli_connect($mysql_hostname, $mysql_username, $mysql_password, $mysql_database, "3306");


?>