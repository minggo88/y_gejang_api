<?php

// 공통 설정 포함
include __DIR__ . "/../../lib/config.php";

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
$query = "SELECT * FROM js_test_manager WHERE m_id = ? AND m_password = ?";
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
            "user_id" => $row['m_id']
        ],
    ]);
} else {
    // 사용자 인증 실패
    //http_response_code(401);
    echo json_encode(["success" => false, "error" => "Invalid credentials."]);
}

// 연결 종료
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>