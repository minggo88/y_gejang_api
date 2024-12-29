<?php
// 공통 설정 포함
include __DIR__ . "/../../lib/config.php";


$dataArray = setDefault(loadParam('dataArray'), '');
// 이제 PHP에서 $dataArray를 원하는 방식으로 처리할 수 있습니다.



$send_name= $dataArray[0]['send_name'];
$send_call= $dataArray[0]['send_call'];
$send_address= $dataArray[0]['send_address'];
$payment_type= $dataArray[0]['payment_type'];
$payment= $dataArray[0]['payment'];
$payment_name= $dataArray[0]['payment_name'];
$item = $dataArray[0]['item'];
$item_cnt = $dataArray[0]['item_cnt'];
$receive_name = $dataArray[0]['receive_name'];
$receive_call = $dataArray[0]['receive_call'];
$receive_address_num = $dataArray[0]['receive_address_num'];
$receive_address = $dataArray[0]['receive_address'];
$item2 = $dataArray[0]['item2'];
$item_cnt2 = $dataArray[0]['item_cnt2'];
$item3 = $dataArray[0]['item3'];
$item_cnt3 = $dataArray[0]['item_cnt3'];
$item4 = $dataArray[0]['item4'];
$item_cnt4 = $dataArray[0]['item_cnt4'];
$item5 = $dataArray[0]['item5'];
$item_cnt5 = $dataArray[0]['item_cnt5'];

$insert_sql = " INSERT INTO yeosu_clean_gejang.js_test_order (payment_type, payment, payment_name, item_cnt, order_item, send_name, send_call, send_address, receive_address, receive_name, receive_call, receive_address_num, item_cnt2, order_item2, item_cnt3, order_item3, item_cnt4, order_item4, item_cnt5, order_item5) 
	VALUES('$payment_type', '$payment', '$payment_name', '$item_cnt', '$item', '$send_name', '$send_call', '$send_address', '$receive_address', '$receive_name', '$receive_call', '$receive_address_num', '$item_cnt2', '$item2', '$item_cnt3', '$item3', '$item_cnt4', '$item4', '$item_cnt5', '$item5');";

// SQL 실행
$result = mysqli_query($conn, $insert_sql);

if ($result) {
    // 결과 반환
    echo json_encode([
        "success" => true,
        "sql" => $insert_sql
    ]);
} else {
    // SQL 오류 디버깅 메시지
    echo json_encode([
        "success" => false,
        "error" => mysqli_error($conn),
        "sql" => $insert_sql
    ]);
}

// 연결 종료
mysqli_close($conn);
?>