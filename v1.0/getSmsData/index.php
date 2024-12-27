<?php

// 공통 설정 포함
include __DIR__ . "/../../lib/config.php";

// 전체데이터 가져오기
$sql = " SELECT 
			sms_index, 
			CASE 
				WHEN cu.c_name IS NULL THEN sms.call 
				ELSE CONCAT(cu.c_name, '(', sms.call, ')') 
			END AS name, 
			tvalue, 
			stime, 
			complete, 
			complete_manager
		FROM 
			js_test_sms AS sms
		LEFT JOIN 
			js_test_customer AS cu 
		ON 
			sms.call = cu.c_call
		WHERE 
			complete <> 'D'
		ORDER BY  
			complete = 'N' DESC, 
			sms_index DESC";


$result = mysqli_query($conn, $query);

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
