<?php
// 공통 설정 포함
include __DIR__ . "/../../lib/config.php";


$m_index = setDefault(loadParam('up_index'), '');
$m_use = setDefault(loadParam('up_use'), '');

// 가입

$sql = " UPDATE `kkikda`.`js_test_manager` 
			SET `m_use`='$m_use'  
			WHERE  `m_index`='$m_index';";

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