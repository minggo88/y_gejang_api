<?php
include dirname(__file__) . "/../../lib/ExchangeApi.php";
// if($_SERVER['REMOTE_ADDR']!='61.74.240.65') {$exchangeapi->error('001','시스템 정검중입니다.');}
$exchangeapi->set_logging(true);
// $exchangeapi->set_log_dir(__dir__.'/../../log/'.basename(__dir__).'/');
// if(__API_RUNMODE__=='live'||__API_RUNMODE__=='loc') {
	$exchangeapi->set_log_dir($exchangeapi->log_dir.'/'.basename(__dir__).'/');
// } else {
	// $exchangeapi->set_log_dir(__dir__.'/');
// }
$exchangeapi->set_log_name('');
$exchangeapi->write_log("REQUEST: " . json_encode($_REQUEST));
// -------------------------------------------------------------------- //

// 거래소 api는 토큰을 전달 받을때만 작동하도록 되어 있어서 로그인시 token을 생성해 줍니다.
// $exchangeapi->token = session_create_id();
session_start();
session_regenerate_id(); // 로그인할때마다 token 값을 바꿉니다.

$dataArray = setDefault(loadParam('dataArray'), '');
// 이제 PHP에서 $dataArray를 원하는 방식으로 처리할 수 있습니다.

$exchangeapi->set_db_link('master');

$exchangeapi->transaction_start();// DB 트랜젝션 시작


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

$exchangeapi->query($insert_sql);

$exchangeapi->transaction_end('commit');// DB 트랜젝션 끝


// response
//$exchangeapi->success(array('token'=>"success",'my_wallet_no'=>"1111",'userno'=>"2222"));
$exchangeapi->success($insert_sql);

// --------------------------------------------------------------------------- //
