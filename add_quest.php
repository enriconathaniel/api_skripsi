<?php

    if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Allow-Headers: X-App-Token, Content-Type');
    }

    $id = $_POST['id'];
    $deskripsi = $_POST['deskripsi'];
    $point = $_POST['point'];
    $max_umur = $_POST['max_umur'];
    $min_exp = $_POST['min_exp'];
    $max_exp = $_POST['max_exp'];
    $repetition = $_POST['repetition'];
 
    $conn = new PDO('mysql:host=localhost;dbname=piranha','root','');
    //$conn = new PDO('mysql:host=mysql.idhostinger.com;dbname=u883464978_mone','u883464978_dolbe','Janssen8');
 
    $return = null;
 
    // $query = $conn->prepare("SELECT id FROM users WHERE email = '$email' LIMIT 1");
    // $query->execute();
    // $row = $query->fetch();
 
    // $userID = $row[0];
 
    $query = "INSERT INTO quest(id, deskripsi, point, max_umur, min_exp, max_exp, repetition) VALUES(".$id.",".$deskripsi.",".$point.",".$max_umur.",".$min_exp.",".$max_exp.",".$repetition.")";
    $data = $conn -> query($query);
 
    if($data) {
        $return['insert'] = true;   
    }
    else {
        $return['insert'] = false;
    }
 
    echo json_encode($return);
?>