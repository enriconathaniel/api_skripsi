<?php

    if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Allow-Headers: X-App-Token, Content-Type');
    }

    $id = $_POST['id'];
 
    $conn = new PDO('mysql:host=localhost;dbname=piranha','root','');
    //$conn = new PDO('mysql:host=mysql.idhostinger.com;dbname=u883464978_mone','u883464978_dolbe','Janssen8');
 
    //$return = null;
 
//  $query = $conn->prepare("SELECT artifactID FROM users WHERE username = '$username' LIMIT 1");
    $data = $conn->query("SELECT id, nama, harga, gambar FROM reward");
 
    $reward = array();
 
    foreach ($data as $row) {
        array_push($reward, array(
            'id' => $row[0],
            'nama' => $row[1],
            'harga' => $row[2],
            'gambar' => $row[3]
        ));
    }
 
    echo json_encode($reward);
?>