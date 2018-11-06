<?php

    if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Allow-Headers: X-App-Token, Content-Type');
    }

    include 'config/db_con.php';
    //$conn = new PDO('mysql:host=localhost;dbname=piranha','root','');
    //$conn = new PDO('mysql:host=mysql.idhostinger.com;dbname=u883464978_mone','u883464978_dolbe','Janssen8');
 
    //$return = null;
 
//  $query = $conn->prepare("SELECT artifactID FROM users WHERE username = '$username' LIMIT 1");
    $data = $conn->query("SELECT id, nama, tanggallahir, email, mulai_latihan, point, exp FROM atlet WHERE nama IS NOT NULL AND nama != '' ORDER BY 7 DESC ");
 
    $profile = array();
 
    foreach ($data as $row) {
        $exp = $row[6];
        $data_level = $conn->query("SELECT level, exp_max from level WHERE exp_max > '".$exp."' limit 1");
        foreach ($data_level as $level) {
            $level_skg = $level[0]; 
        }


        array_push($profile, array(
            'id' => $row[0],
            'nama' => $row[1],
            'dateofbirth' => $row[2],
            'email' => $row[3],
            'mulai_latihan' => $row[4],
            'point' => $row[5],
            'exp' => $row[6],
            'level' => $level_skg
        ));
    }
 
    echo json_encode($profile);
?>