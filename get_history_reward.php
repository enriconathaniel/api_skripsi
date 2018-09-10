<?php

    if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Allow-Headers: X-App-Token, Content-Type');
    }
    $requestBody = json_decode(file_get_contents('php://input'), true);

    $id = $requestBody['id'];

    $conn = new PDO('mysql:host=localhost;dbname=piranha','root','');
    //$conn = new PDO('mysql:host=mysql.idhostinger.com;dbname=u883464978_mone','u883464978_dolbe','Janssen8');
    
    //$return = null;
 
//  $query = $conn->prepare("SELECT artifactID FROM users WHERE username = '$username' LIMIT 1");
    $data = $conn->query("SELECT history_reward.id, history_reward.id_user, reward.nama , reward.harga , history_reward.tanggal FROM history_reward JOIN reward ON history_reward.id_reward = reward.id WHERE history_reward.id_user = '".$id."'");
 
    $history_reward = array();
 
    foreach ($data as $row) {
        array_push($history_reward, array(
            'id' => $row[0],
            'nama' => $row[2],
            'harga' => $row[3],
            'tanggal' => date("d-m-Y", strtotime($row[4]))
        ));
    }
 
    echo json_encode($history_reward);
?>