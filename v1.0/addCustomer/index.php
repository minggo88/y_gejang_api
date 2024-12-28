<?php
// 공통 설정 포함
include __DIR__ . "/../../lib/config.php";


$c_name = setDefault(loadParam('add_name'), '');
$c_call = setDefault(loadParam('add_call'), '');
$c_address1 = setDefault(loadParam('add_address1'), '');
$c_address2 = setDefault(loadParam('add_address2'), '');


// --------------------------------------------------------------------------- //

// 가입

$sql = " INSERT INTO `yeosu_clean_gejang`.`js_test_customer` (`c_name`, `c_call`, `c_address1`, `c_address2`) 
		VALUES ('$c_name', '$c_call', '$c_address1', '$c_address2');";

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