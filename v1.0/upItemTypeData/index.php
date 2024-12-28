<?php
// 공통 설정 포함
include __DIR__ . "/../../lib/config.php";

$c_index = setDefault(loadParam('c_index'), '');
$c_text = setDefault(loadParam('c_text'), '');


// 가입

$sql = " UPDATE `yeosu_clean_gejang`.`js_test_item_type`  
			SET `itype_name`='$c_text'  
			WHERE  `itemtype_index`='$c_index';";

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