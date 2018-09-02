<?php
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
 
    function signup($email, $username, $password){
        $conn = new PDO('mysq:host=localhost;dbname=atlet','root','');
        //$conn = new PDO('mysql:host=mysql.idhostinger.com;dbname=u883464978_mone','u883464978_dolbe','Janssen8');
 
        $return = null;
 
        $pass_salt = $password.$username;
        $hash = md5($pass_salt);
 
        $query = "INSERT INTO users(username,email,password) VALUES('".$username."','".$email."','".$hash."')";
        $data = $conn -> query($query);
 
 
        if($data) {
            $return['success'] = true;  
        }
        else {
            $return['success'] = false;
        }
 
        echo json_encode($return);
    }
?>