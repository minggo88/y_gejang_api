<?php
// 공통 설정 포함
include __DIR__ . "/../../lib/config.php";

// 파라미터 처리
$m_id = mysqli_real_escape_string($conn, setDefault(loadParam('add_id'), ''));
$m_password = mysqli_real_escape_string($conn, setDefault(loadParam('add_pw'), ''));
$m_name = mysqli_real_escape_string($conn, setDefault(loadParam('add_name'), ''));
$m_call = mysqli_real_escape_string($conn, setDefault(loadParam('add_call'), ''));
$m_use = mysqli_real_escape_string($conn, setDefault(loadParam('add_use'), ''));

// SQL 쿼리 작성
$sql = "INSERT INTO `yeosu_clean_gejang`.`js_test_manager` 
        (`m_id`, `m_password`, `m_name`, `m_call`, `m_use`) 
        VALUES ('$m_id', '$m_password', '$m_name', '$m_call', '$m_use');";

// SQL 실행
$result = mysqli_query($conn, $sql);

if ($result) {
    // 결과 반환
    echo json_encode([
        "success" => true,
        "sql" => $sql
    ]);
} else {
    // SQL 오류 디버깅 메시지
    echo json_encode([
        "success" => false,
        "error" => mysqli_error($conn),
        "sql" => $sql
    ]);
}

// 연결 종료
mysqli_close($conn);
?>