<?php
// 공통 설정 포함
include __DIR__ . "/../../lib/config.php";

$m_id = setDefault(loadParam('add_id'), '');
$m_password = setDefault(loadParam('add_pw'), '');
$m_name = setDefault(loadParam('add_name'), '');
$m_call = setDefault(loadParam('add_call'), '');
$m_use = setDefault(loadParam('add_use'), '');


// 가입

$sql = " INSERT INTO `yeosu_clean_gejang`.`js_test_manager` (`m_id`, `m_password`, `m_name`, `m_call`, `m_use`) 
VALUES ('$m_id', '$m_password', '$m_name', '$m_call', '$m_use');";

$result = mysqli_query($conn, $sql);

if ($result) {
    // 결과 반환
    echo json_encode([
        "success" => true,
		"sql" => $sql
    ]);
	
} else {
    // 사용자 인증 실패
    echo json_encode(["success" => false, "error" => "Invalid credentials."]);
}

// 연결 종료
mysqli_close($conn);
?>
