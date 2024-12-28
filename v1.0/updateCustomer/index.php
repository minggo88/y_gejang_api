<?php
// 공통 설정 포함
include __DIR__ . "/../../lib/config.php";


$c_index = setDefault(loadParam('up_index'), '');
$c_name = setDefault(loadParam('up_name'), '');
$c_call = setDefault(loadParam('up_call'), '');
$c_address1 = setDefault(loadParam('up_address1'), '');
$c_address2 = setDefault(loadParam('up_address2'), '');


// 가입

$sql = " UPDATE `yeosu_clean_gejang`.`js_test_customer` 
			SET `c_name`='$c_name', `c_call`='$c_call', `c_address1`='$c_address1', `c_address2`='$c_address2' 
			WHERE  `test_customer_index`='$c_index';";

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