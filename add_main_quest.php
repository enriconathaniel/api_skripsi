<?php

    if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Allow-Headers: X-App-Token, Content-Type');
    }

    $requestBody = json_decode(file_get_contents('php://input'), true);

    

    $id_atlet = $requestBody['id_atlet'];
    $id_gaya = $requestBody['id_gaya'];
    $waktu_target = $requestBody['waktu_target'];
    $point = $requestBody['point'];
    $exp = $requestBody['exp'];
    $status = 0;
 
    include 'config/db_con.php';
    $query = "INSERT INTO main_quest(id_atlet, id_gaya, target, point, exp, status) VALUES('".$id_atlet."','".$id_gaya."','".$waktu_target."','".$point."','".$exp."','".$status."')";

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