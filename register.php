<?php

    if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Allow-Headers: X-App-Token, Content-Type');
    }

     $requestBody = json_decode(file_get_contents('php://input'), true);
    
    // $nama = $_POST['nama'];
    // $tanggallahir = $_POST['tanggallahir'];
    // $email = $_POST['email'];
    // $password = $_POST['password'];

      $nama = $requestBody['nama'];
      $tanggallahir = $requestBody['tanggallahir'];
      $email = $requestBody['email'];
      $password = $requestBody['password'];
        
    //function register($nama, $tanggallahir, $email, $password){
    $pass_salt = $password.$email;
    $hash = md5($pass_salt);
    //echo $hash;
        $conn = new PDO('mysql:host=localhost;dbname=piranha','root','');
        //$conn = new PDO('mysql:host=mysql.idhostinger.com;dbname=u883464978_mone','u883464978_dolbe','Janssen8');

        $query = "INSERT INTO atlet(nama,tanggallahir,email,password) VALUES('".$nama."','".$tanggallahir."','".$email."','".$hash."')";

        //echo $query;
        $data = $conn -> query($query);

        $return = null;
 
        
 
        
        
       // echo $data;
        
        if($data) {
            $return['success'] = true;  
        }
        else {
            $return['success'] = false;
        }
 
        echo json_encode($return);


    //}
?>