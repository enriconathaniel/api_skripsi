<?php

    if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Allow-Headers: X-App-Token, Content-Type');
    }
    $requestBody = json_decode(file_get_contents('php://input'), true);
    $id = $requestBody['id'];
    include 'config/db_con.php';
    //$conn = new PDO('mysql:host=localhost;dbname=piranha','root','');
    //$conn = new PDO('mysql:host=mysql.idhostinger.com;dbname=u883464978_mone','u883464978_dolbe','Janssen8');
    
    //$return = null;
 
//  $query = $conn->prepare("SELECT artifactID FROM users WHERE username = '$username' LIMIT 1");
    //$data = $conn->query("SELECT id, deskripsi, point, max_umur, min_exp, max_exp, repetition FROM quest");
    
    $data = $conn->query("SELECT main_quest.id, gaya_renang.nama_gaya, gaya_renang.jarak, main_quest.target FROM main_quest JOIN gaya_renang ON main_quest.id_gaya = gaya_renang.id WHERE main_quest.id_atlet = '".$id."'");
    
    $quest = array();
 
    foreach ($data as $row) {
        array_push($quest, array(
            'id' => $row[0],
            'gaya_renang_nama' => $row[1],
            'gaya_renang_jarak' => $row[2],
            'quest_waktu_target' => $row[3]
        ));
    }
 
    echo json_encode($quest);
?>