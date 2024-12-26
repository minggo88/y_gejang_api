<?php

$mysql_hostname = 'dev.cxuwu04we8ge.ap-northeast-2.rds.amazonaws.com';
$mysql_username = 'admin';
$mysql_password = 'a2633218*';
$mysql_database = 'yeosu_clean_gejang';

        error_reporting(E_ALL);

        ini_set("display_errors", 1);

        date_default_timezone_set('Asia/Seoul');



        $conn = mysqli_connect( $mysql_hostname,$mysql_username, $mysql_password, $mysql_database, "3306" );



        if( empty( $conn ) == true ) {



              echo ( "#############################444################################################" );

              echo ( "</br>dev-api branch default DBMS 접속 호스트 정보가 정확하지 않습니다. </br>\n\n" );

              exit ( "#############################################################################" );



        } else {



              echo ( "##############222##############################################################" );

              echo ( "</br>dev-api default DBMS 접속에 성공하였습니다. </br>\n\n" );

              echo ( "-----------------------------------------------------------------------------" );

              echo ( "<pre>" );

              print_r ( $conn );

              echo ( "</pre>" );

              exit ( "#############################################################################" );



        }



        mysqli_close( $conn );

?>
