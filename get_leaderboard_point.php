<?php

    if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Allow-Headers: X-App-Token, Content-Type');
    }

 
    $conn = new PDO('mysql:host=localhost;dbname=piranha','root','');
    //$conn = new PDO('mysql:host=mysql.idhostinger.com;dbname=u883464978_mone','u883464978_dolbe','Janssen8');
 
    //$return = null;
 
//  $query = $conn->prepare("SELECT artifactID FROM users WHERE username = '$username' LIMIT 1");
    $data = $conn->query("SELECT id, nama, tanggallahir, email, mulai_latihan, point, exp FROM atlet ORDER BY point ASC");
 
    $profile = array();
 
    foreach ($data as $row) {
        array_push($profile, array(
            'id' => $row[0],
            'nama' => $row[1],
            'dateofbirth' => $row[2],
            'email' => $row[3],
            'mulai_latihan' => $row[4],
            'point' => $row[5],
            'exp' => $row[6]
        ));
    }
 
    echo json_encode($profile);
?>