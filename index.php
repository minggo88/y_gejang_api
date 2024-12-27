<?php
//include dirname(__file__) . "/../../lib/TradeApi.php";

// 거래소 api는 토큰을 전달 받을때만 작동하도록 되어 있어서 로그인시 token을 생성해 줍니다.
//$tradeapi->token = session_create_id();
session_start();
//session_regenerate_id(); // 로그인할때마다 token 값을 바꿉니다. 

// 로그인 세션 확인.
// $tradeapi->checkLogout();

// validate parameters
$userid = checkEmpty($_REQUEST['userid'], 'social_id');
$userpw = checkEmpty($_REQUEST['userpw'], 'userpw');
//$uuid = checkUUID(checkEmpty($_REQUEST['uuid'], 'UUID'));
//$os = checkEmpty($_REQUEST['os'], 'OS');

// --------------------------------------------------------------------------- //

// 마스터 디비 사용하도록 설정.
//$tradeapi->set_db_link('slave');

$mysql_hostname = 'dev.cxuwu04we8ge.ap-northeast-2.rds.amazonaws.com';
$mysql_username = 'admin';
$mysql_password = 'a2633218*';
$mysql_database = 'yeosu_clean_gejang';

error_reporting(E_ALL);
ini_set("display_errors", 1);

date_default_timezone_set('Asia/Seoul');

$conn = mysqli_connect($mysql_hostname, $mysql_username, $mysql_password, $mysql_database, "3306");
$query = "SELECT * FROM js_test_manager;";
$result = mysqli_query($conn, $query);

// 계정 정보 확인.
/*$member = $tradeapi->get_member_info_by_userid($userid);
if(!$member) {
    $tradeapi->error('041', __('The information does not match. Please check your ID!'));
}

// 비밀번호 확인.
if(md5($userpw) != $member->userpw) {
    $tradeapi->error('031', __('The information does not match. Please check your ID!'));
}


// login - userno, $userid, $name, $level_code)
$_r = $tradeapi->login($member->userno, $member->userid, $member->name, '3');
if(!$_r) {
    $tradeapi->error('007', __('Login failed.'));
}
*/
// response
//$tradeapi->success($result);

if (!$result) {
    http_response_code(500);
    echo json_encode(["error" => "SQL execution failed: " . mysqli_error($conn)]);
    exit;
}

// 결과 데이터를 배열로 변환
$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

// JSON 응답
$response = [
    "userid" => $userid,
    "userpw" => $userpw,
    "result" => $data
];

header("Content-Type: application/json");
echo json_encode($response);

// 연결 해제
mysqli_free_result($result);
mysqli_close($conn);

?>