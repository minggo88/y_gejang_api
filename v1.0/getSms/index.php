<?php
// 공통 설정 포함
include __DIR__ . "/../../lib/config.php";

// -------------------------------------------------------------------- //


// 거래소 api는 토큰을 전달 받을때만 작동하도록 되어 있어서 로그인시 token을 생성해 줍니다.
// $exchangeapi->token = session_create_id();

// 로그인 세션 확인.
// $exchangeapi->checkLogout();

$mobile = setDefault(loadParam('call'), '');
$text = setDefault(loadParam('text'), '');


// --------------------------------------------------------------------------- //


// 가입

$sql = " INSERT INTO `kkikda`.`js_test_sms` (`call`, `tvalue`) VALUES ('$mobile', '$text') ";

$result = mysqli_query($conn, $query);

/*if (!$res0ult) {
	echo json_encode(["success" => false, "error" => "Invalid credentials.".mysqli_error($conn)]);
} else {
	
	while ($row = mysqli_fetch_assoc($result)) {
		echo json_encode([
			"success" => true,
			"payload" => [$row],
		]);
		
	}
	
}*/
echo json_encode(["success" => true, "payload" => [$result]);

// response
//$exchangeapi->success(array('token'=>"success",'my_wallet_no'=>$mobile,'userno'=>$text));
