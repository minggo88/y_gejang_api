<?php
// 공통 설정 포함
include __DIR__ . "/../../lib/config.php";


$c_index = setDefault(loadParam('c_index'), '');
$c_state = setDefault(loadParam('c_state'), '');


// 가입

$sql = " UPDATE `yeosu_clean_gejang`.`js_test_sms`  
			SET `complete`='$c_state'  
			WHERE  `sms_index`='$c_index';";

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