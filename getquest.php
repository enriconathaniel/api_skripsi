<?php
    $id = $_POST['id'];
 
    $conn = new PDO('mysql:host=localhost;dbname=piranha','root','');
    //$conn = new PDO('mysql:host=mysql.idhostinger.com;dbname=u883464978_mone','u883464978_dolbe','Janssen8');
 
    //$return = null;
 
//  $query = $conn->prepare("SELECT artifactID FROM users WHERE username = '$username' LIMIT 1");
    $data = $conn->query("SELECT id, deskripsi, point, max_umur, min_exp, max_exp, repetition FROM quest");
 
    $quest = array();
 
    foreach ($data as $row) {
        array_push($quest, array(
            'id' => $row[0],
            'deskripsi' => $row[1],
            'point' => $row[2],
            'max_umur' => $row[3],
            'min_exp' => $row[4],
            'max_exp' => $row[5],
            'repetition' => $row[6]
        ));
    }
 
    echo json_encode($quest);
?>