<?php
// 공통 설정 포함
include __DIR__ . "/../../lib/config.php";

$type_num = setDefault(loadParam('type_num'), '');
// --------------------------------------------------------------------------- //

// 마스터 디비 사용하도록 설정.
$tradeapi->set_db_link('slave');

// 전체데이터 가져오기
$sql = " SELECT endt_index, endt_text 
	FROM js_test_end_text 
	WHERE 1=1 ";
//$sql .= " AND i_type = '$type_num' ";
$sql .= " ORDER BY endt_text ASC;";
		

$result = mysqli_query($conn, $sql);

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