<?php

    if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Allow-Headers: X-App-Token, Content-Type');
    }
    
    $requestBody = json_decode(file_get_contents('php://input'), true);

    
    // $nama = $_POST['nama'];
    // $harga = $_POST['harga'];
    // $gambar = $_POST['gambar'];
    $id_reward = $requestBody['id_reward']
    $nama_barang = $requestBody['nama_barang'];
 
    include 'config/db_con.php';
    //$conn = new PDO('mysql:host=localhost;dbname=piranha','root','');
    //$conn = new PDO('mysql:host=mysql.idhostinger.com;dbname=u883464978_mone','u883464978_dolbe','Janssen8');
    $query = "INSERT INTO reward(id_reward,nama_barang) VALUES('".$id_reward."','".$nama_barang."')";
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