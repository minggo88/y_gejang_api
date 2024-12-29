<?php
// 공통 설정 포함
include __DIR__ . "/../../lib/config.php";

function sendSMS($to, $message) {
	// 한국 전화번호를 +82 형식으로 변환
	if (substr($to, 0, 3) == '010') {
		$to = '+82' . substr($to, 1); // 010 제거하고 +82 추가
	}

	$apiKey = 'f2b33afd';     // Nexmo API Key
    $apiSecret = 'xZOmlCRtz8QssuUs'; // Nexmo API Secret
		
	$url = 'https://rest.nexmo.com/sms/json';

	$data = [
		'from' => 'YOUR_BRAND_NAME', // 발신자 이름 (번호가 아니어도 됨)
		'text' => $message,
		'to' => $to,  // 수정된 수신자 번호
		'api_key' => $apiKey,
		'api_secret' => $apiSecret,
	];

	$options = [
		CURLOPT_URL => $url,
		CURLOPT_POST => true,
		CURLOPT_POSTFIELDS => http_build_query($data),
		CURLOPT_RETURNTRANSFER => true,
	];

	$ch = curl_init();
	curl_setopt_array($ch, $options);
	
	$response = curl_exec($ch);
	
	if (curl_errno($ch)) {
		echo 'Error:' . curl_error($ch);
	} else {
		echo "Response: " . $response;
	}

	curl_close($ch);
}




$c_index = setDefault(loadParam('c_index'), '');
$c_name = setDefault(loadParam('c_name'), '');
$c_call = setDefault(loadParam('c_call'), '');
$c_address1 = setDefault(loadParam('c_address1'), '');
$c_address2 = setDefault(loadParam('c_address2'), '');
$c_order = setDefault(loadParam('c_order'), '');
$c_ordernum = setDefault(loadParam('c_ordernum'), '');
$c_sendtext = setDefault(loadParam('c_sendtext'), '');


// --------------------------------------------------------------------------- //

$sql = " UPDATE `yeosu_clean_gejang`.`js_test_order` 
			SET `complete`='Y', 'complete_manager' = '1'
			WHERE  `sms_index`='$c_index';";

// 쿼리 실행
$result = mysqli_query($conn, $sql);

sendSMS($c_call, $c_sendtext);

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