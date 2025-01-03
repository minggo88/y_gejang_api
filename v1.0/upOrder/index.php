<?php

// 공통 설정 포함
include __DIR__ . "/../../lib/config.php";

$dataArray = setDefault(loadParam('dataArray'), '');
$item = isset($dataArray['order_item']) ? $dataArray['order_item'] : '';
$item2 = isset($dataArray['order_item2']) ? $dataArray['order_item2'] : '';
$item3 = isset($dataArray['order_item3']) ? $dataArray['order_item3'] : '';
$item4 = isset($dataArray['order_item4']) ? $dataArray['order_item4'] : '';
$item5 = isset($dataArray['order_item5']) ? $dataArray['order_item5'] : '';

$send_date= $dataArray['send_date'];
$send_call= $dataArray['send_call'];
$payment_type= $dataArray['payment_type'];
$payment= $dataArray['payment'];
$payment_name= $dataArray['payment_name'];
$item_cnt = $dataArray['item_cnt'];
$item_cnt2 = $dataArray['item_cnt2'];
$item_cnt3 = $dataArray['item_cnt3'];
$item_cnt4 = $dataArray['item_cnt4'];
$item_cnt5 = $dataArray['item_cnt5'];
$box_count = $dataArray['box_cnt'];
$receive_name = $dataArray['receive_name'];
$receive_call = $dataArray['receive_call'];
$receive_address_num = $dataArray['receive_address_num'];
$receive_address = $dataArray['receive_address'];
$receive_code = $dataArray['receive_code'];
$move = $dataArray['move'];
$send_message = $dataArray['send_message'];
$order_index = $dataArray['order_index'];

/*$item2 = $dataArray[0]['item2'];
$item_cnt2 = $dataArray[0]['item_cnt2'];
$item3 = $dataArray[0]['item3'];
$item_cnt3 = $dataArray[0]['item_cnt3'];
$item4 = $dataArray[0]['item4'];
$item_cnt4 = $dataArray[0]['item_cnt4'];
$item5 = $dataArray[0]['item5'];
$item_cnt5 = $dataArray[0]['item_cnt5'];*/

//메인반출내용
$up_sql = 
    "UPDATE yeosu_clean_gejang.js_test_order
		SET payment_type='$payment_type', payment='$payment', payment_name='$payment_name', 
            order_item= '$item' LIMIT 1), item_cnt='$item_cnt', 
            order_item2= '$item2', item_cnt2='$item_cnt2', 
            order_item3= '$item3', item_cnt3='$item_cnt3', 
            order_item4= '$item4', item_cnt4='$item_cnt4', 
            order_item5= '$item5', item_cnt5='$item_cnt5', 
            send_call='$send_call', receive_address='$receive_address', 
			receive_name='$receive_name', receive_call='$receive_call', receive_address_num='$receive_address_num', send_date='$send_date', 
			box_cnt='$box_count', receive_code='$receive_code', move='$move', send_message='$send_message' 
		WHERE order_index='$order_index';";
// 쿼리 실행
$result = mysqli_query($conn, $up_sql);

if ($result) {
    // 성공 시 반환
    echo json_encode([
        "success" => true,
        "sql" => $up_sql
    ]);
} else {
    // 실패 시 반환
    echo json_encode([
        "success" => false,
        "error" => mysqli_error($conn),
        "sql" => $up_sql
    ]);
}

// 연결 종료
mysqli_close($conn);
?>