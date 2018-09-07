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
    //$data = $conn->query("SELECT id, deskripsi, point, max_umur, min_exp, max_exp, repetition FROM quest");
    
    $data = $conn->query("SELECT quest.id, quest.deskripsi, quest.point, quest.max_umur, quest.min_exp, quest.max_exp, quest.repetition, gaya_renang.nama_gaya, gaya_renang.jarak, quest.waktu_target FROM quest JOIN gaya_renang ON quest.id_gaya = gaya_renang.id");
    
    $quest = array();
 
    foreach ($data as $row) {
        array_push($quest, array(
            'id' => $row[0],
            'deskripsi' => $row[1],
            'point' => $row[2],
            'max_umur' => $row[3],
            'min_exp' => $row[4],
            'max_exp' => $row[5],
            'repetition' => $row[6],
            'gaya_renang_nama' => $row[7],
            'gaya_renang_jarak' => $row[8],
            'quest_waktu_target' => $row[9]
        ));
    }
 
    echo json_encode($quest);
?>