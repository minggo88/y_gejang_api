<?php
include __DIR__ . "/../../lib/config.php";

function sendSMS($to, $message) {
    global $conn;

    $sql = "SELECT guest_key FROM js_config_sms WHERE CODE = 'aligo';";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die(json_encode([
            "success" => false,
            "error" => "Database query failed: " . mysqli_error($conn)
        ]));
    }

    $api_info = mysqli_fetch_assoc($result);
    if (empty($api_info['guest_key'])) {
        die(json_encode([
            "success" => false,
            "error" => "API 인증키를 가져오지 못했습니다."
        ]));
    }

    $accountSid = $api_info['guest_key'];

    $sms_url = "https://apis.aligo.in/send/";
    $sms = [
        'user_id' => 'ngng123',
        'key' => $accountSid,
        'sender' => '01039275103',
        'receiver' => $to,
        'msg' => $message
    ];

    foreach (['user_id', 'key', 'sender', 'receiver', 'msg'] as $key) {
        if (empty($sms[$key])) {
            die(json_encode([
                "success" => false,
                "error" => "Missing required parameter: $key"
            ]));
        }
    }

    $oCurl = curl_init();
    curl_setopt($oCurl, CURLOPT_URL, $sms_url);
    curl_setopt($oCurl, CURLOPT_POST, 1);
    curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($oCurl, CURLOPT_POSTFIELDS, $sms);
    curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
    $ret = curl_exec($oCurl);

    if ($ret === false) {
        die(json_encode([
            "success" => false,
            "error" => "cURL Error: " . curl_error($oCurl)
        ]));
    }

    curl_close($oCurl);

    $retArr = json_decode($ret, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        die(json_encode([
            "success" => false,
            "error" => "Invalid JSON response from API",
            "raw_response" => $ret
        ]));
    }

    if (isset($retArr['result_code']) && $retArr['result_code'] != '1') {
        die(json_encode([
            "success" => false,
            "error" => "API Error: " . $retArr['message'],
            "result_code" => $retArr['result_code']
        ]));
    }

    echo json_encode([
        "success" => true,
        "payload" => $retArr
    ]);
}

$call = setDefault(loadParam('call'), '01039275103');
$message = setDefault(loadParam('message'), '한글메시지입니다');
sendSMS($call, $message);
?>
