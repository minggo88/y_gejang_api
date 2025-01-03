<?php

// 공통 설정 포함
include __DIR__ . "/../../lib/config.php";

//메인반출내용
$search_sql = 
            "SELECT 
                send_date, 
                payment_type, 
                payment, 
                send_call, 
                payment_name, 
                receive_name, 
                it_name.i_value AS order_item, 
                item_cnt, 
                it_name2.i_value AS order_item2, 
                item_cnt2, 
                it_name3.i_value AS order_item3, 
                item_cnt3, 
                it_name4.i_value AS order_item4, 
                item_cnt4, 
                it_name5.i_value AS order_item5, 
                item_cnt5, 
                receive_call, 
                box_cnt, 
                receive_address_num, 
                receive_address, 
                receive_code, 
                move, 
                move_cnt, 
                send_message,
                order_index,
                stime
            FROM 
                js_test_order
            LEFT JOIN 
                js_test_item AS it_name ON order_item = it_name.item_index
            LEFT JOIN 
                js_test_item AS it_name2 ON order_item2 = it_name2.item_index
            LEFT JOIN 
                js_test_item AS it_name3 ON order_item3 = it_name3.item_index
            LEFT JOIN 
                js_test_item AS it_name4 ON order_item4 = it_name4.item_index
            LEFT JOIN 
                js_test_item AS it_name5 ON order_item5 = it_name5.item_index
            ORDER BY 
                stime DESC;";

$result = mysqli_query($conn, $search_sql);

if ($result) {
    $data = []; // 결과를 담을 배열 초기화

    // 결과를 배열에 저장
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row; // 각 행을 배열에 추가
    }

    // 결과 반환
    echo json_encode([
        "success" => true,
        "payload" => $data
    ]);
} else {
    // 사용자 인증 실패
    echo json_encode(["success" => false, "error" => "Invalid credentials."]);
}

// 연결 종료
mysqli_close($conn);
?>