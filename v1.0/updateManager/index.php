<?php
// 공통 설정 포함
include __DIR__ . "/../../lib/config.php";

// 전체데이터 가져오기

$m_index = setDefault(loadParam('up_index'), '');
$m_id = setDefault(loadParam('up_id'), '');
$m_password = setDefault(loadParam('up_pw'), '');
$m_name = setDefault(loadParam('up_name'), '');
$m_call = setDefault(loadParam('up_call'), '');


// 가입

$sql = " UPDATE `kkikda`.`js_test_manager` 
			SET `m_name`='$m_name' , `m_call`='$m_call' , `m_id`='$m_id' , `m_password`='$m_password' 
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