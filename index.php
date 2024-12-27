<?php

$mysql_hostname = 'dev.cxuwu04we8ge.ap-northeast-2.rds.amazonaws.com';
$mysql_username = 'admin';
$mysql_password = 'a2633218*';
$mysql_database = 'yeosu_clean_gejang';

error_reporting(E_ALL);
ini_set("display_errors", 1);

date_default_timezone_set('Asia/Seoul');

$conn = mysqli_connect($mysql_hostname, $mysql_username, $mysql_password, $mysql_database, "3306");

if (empty($conn)) {
    echo ("#############################444################################################");
    echo ("</br>dev-api branch default DBMS 접속 호스트 정보가 정확하지 않습니다. </br>\n\n");
    exit("#############################################################################");
} else {
    echo ("##############4444##############################################################");
    echo ("</br>dev-api default DBMS 접속에 성공하였습니다. </br>\n\n");
    echo ("-----------------------------------------------------------------------------");

    // SQL 실행
    $query = "SELECT * FROM js_test_manager;";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        echo ("SQL 실행에 실패했습니다: " . mysqli_error($conn));
    } else {
        echo ("<pre>");
        while ($row = mysqli_fetch_assoc($result)) {
            print_r($row);
        }
        echo ("</pre>");
    }

    // MySQL 리소스 해제
    mysqli_free_result($result);
}

// 연결 종료
mysqli_close($conn);

exit("#############################################################################");

?>
