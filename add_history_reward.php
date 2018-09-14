<?php

    if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Allow-Headers: X-App-Token, Content-Type');
    }
    
    $requestBody = json_decode(file_get_contents('php://input'), true);

    

//    $id_user = $_POST['id_user'];
 //   $id_reward = $_POST['id_reward'];
    
    
    $id_user = $requestBody['id_user'];
    $id_reward = $requestBody['id_reward'];
    $date = date("Y-m-d");
    
    include 'config/db_con.php';
    //$conn = new PDO('mysql:host=localhost;dbname=piranha','root','');
    //$conn = new PDO('mysql:host=mysql.idhostinger.com;dbname=u883464978_mone','u883464978_dolbe','Janssen8');
    //$query = "INSERT INTO reward(nama,harga,gambar) VALUES('".$nama."','".$harga."','".$gambar."')";

    $query = "INSERT INTO history_reward(id_user,id_reward,tanggal) VALUES('".$id_user."','".$id_reward."','".$date."')";
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