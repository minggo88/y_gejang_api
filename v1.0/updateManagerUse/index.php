<?php
// 공통 설정 포함
include __DIR__ . "/../../lib/config.php";

// 파라미터 가져오기
function loadParam($key, $default = null) {
    return isset($_REQUEST[$key]) ? $_REQUEST[$key] : $default;
}

function setDefault($value, $default) {
    return empty($value) ? $default : $value;
}

$m_index = setDefault(loadParam('up_index'), '');
$m_use = setDefault(loadParam('up_use'), '');

// 유효성 검증
if (empty($m_index) || empty($m_use)) {
    echo json_encode(["success" => false, "error" => "Missing parameters."]);
    exit;
}

// 쿼리 생성
$sql = "UPDATE `yeosu_clean_gejang`.`js_test_manager` 
        SET `m_use` = '$m_use'  
        WHERE `m_index` = '$m_index';";

// 쿼리 실행
$result = mysqli_query($conn, $sql);

if ($result) {
    // 성공 시 반환
    echo json_encode([
        "success" => true,
        "sql" => $sql
    ]);
} else {
    // 실패 시 반환
    echo json_encode([
        "success" => false,
        "error" => mysqli_error($conn),
        "sql" => $sql
    ]);
}

// 연결 종료
mysqli_close($conn);
?>