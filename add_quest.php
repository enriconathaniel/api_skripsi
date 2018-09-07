<?php

    if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Allow-Headers: X-App-Token, Content-Type');
    }

    $requestBody = json_decode(file_get_contents('php://input'), true);

    // $deskripsi = $_POST['deskripsi'];
    // $point = $_POST['point'];
    // $max_umur = $_POST['max_umur'];
    // $min_exp = $_POST['min_exp'];
    // $max_exp = $_POST['max_exp'];
    // $repetition = $_POST['repetition'];
    // $waktu_target = $$_POST['waktu_target'];

    $deskripsi = $requestBody['deskripsi'];
    $point = $requestBody['point'];
    $max_umur = $requestBody['max_umur'];
    $min_exp = $requestBody['min_exp'];
    $max_exp = $requestBody['max_exp'];
    $repetition = $requestBody['repetition'];
    $id_gaya = $requestBody['id_gaya'];
    $waktu_target = $requestBody['waktu_target'];
 
    $conn = new PDO('mysql:host=localhost;dbname=piranha','root','');
    //$conn = new PDO('mysql:host=mysql.idhostinger.com;dbname=u883464978_mone','u883464978_dolbe','Janssen8');
    $query = "INSERT INTO quest(deskripsi, point, max_umur, min_exp, max_exp, repetition, id_gaya ,waktu_target) VALUES('".$deskripsi."','".$point."','".$max_umur."','".$min_exp."','".$max_exp."','".$repetition."','".$id_gaya."','".$waktu_target."')";

    $data = $conn -> query($query);
    $return = null;
 
    // $query = $conn->prepare("SELECT id FROM users WHERE email = '$email' LIMIT 1");
    // $query->execute();
    // $row = $query->fetch();
 
    // $userID = $row[0];
 
    
 
    if($data) {
        $return['insert'] = true;   
    }
    else {
        $return['insert'] = false;
    }
 
    echo json_encode($return);

    
    
?>