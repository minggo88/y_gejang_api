<?php
// CORS 설정
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

// 데이터베이스 연결 설정
$mysql_hostname = 'dev.cxuwu04we8ge.ap-northeast-2.rds.amazonaws.com';
$mysql_username = 'admin';
$mysql_password = 'a2633218*';
$mysql_database = 'yeosu_clean_gejang';

// 에러 보고 활성화
error_reporting(E_ALL);
ini_set("display_errors", 1);

// 데이터베이스 연결
$conn = mysqli_connect($mysql_hostname, $mysql_username, $mysql_password, $mysql_database, "3306");
if (!$conn) {
    http_response_code(500);
    echo json_encode(["success" => false, "error" => "Database connection failed."]);
    exit;
}

// 요청 데이터 가져오기
$request = $_POST;
?>