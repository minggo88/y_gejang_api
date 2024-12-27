<?php
// CORS 설정 (필요에 따라 수정 가능)
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
$social_id = isset($request['social_id']) ? $request['social_id'] : null;
$userpw = isset($request['userpw']) ? $request['userpw'] : null;
$os = isset($request['os']) ? $request['os'] : null;

// 필수 값 확인
if (!$social_id || !$userpw || !$os) {
    http_response_code(400);
    echo json_encode(["success" => false, "error" => "Missing required parameters."]);
    exit;
}

// 사용자 인증 로직
$query = "SELECT * FROM users WHERE social_id = ? AND userpw = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "ss", $social_id, $userpw);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// 사용자 확인
if ($row = mysqli_fetch_assoc($result)) {
    // 사용자 인증 성공
    echo json_encode([
        "success" => true,
        "payload" => [
            "user_id" => $row['id']
        ],
    ]);
} else {
    // 사용자 인증 실패
    http_response_code(401);
    echo json_encode(["success" => false, "error" => "Invalid credentials."]);
}

// 연결 종료
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>