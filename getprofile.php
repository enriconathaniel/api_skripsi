<?php

    if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Allow-Headers: X-App-Token, Content-Type');
    }

    $requestBody = json_decode(file_get_contents('php://input'), true);

    $id = $requestBody['id'];
    // $id = $_POST['id'];

    include 'config/db_con.php';
    //$conn = new PDO('mysql:host=localhost;dbname=piranha','root','');
    //$conn = new PDO('mysql:host=mysql.idhostinger.com;dbname=u883464978_mone','u883464978_dolbe','Janssen8');
 
    //$return = null;
 
//  $query = $conn->prepare("SELECT artifactID FROM users WHERE username = '$username' LIMIT 1");
    $data = $conn->query("SELECT id, nama, tanggallahir, email, mulai_latihan, point, exp, password FROM atlet WHERE id = '".$id."'");
 
    $profile = array();
 
    foreach ($data as $row) {
        $exp = $row[6];
        $exp_max=0;
        $exp_min =0;
        $data_level = $conn->query("SELECT level, exp_max from level WHERE exp_max > '".$exp."' limit 1");
        foreach ($data_level as $level) {
            $level_skg = $level[0]; 
            $exp_max = $level[1];
            $level_sebelum = (int)$level_skg -1;      
            $data_level_bawah = $conn->query("SELECT exp_max from level WHERE level = '".$level_sebelum."'");

            foreach ($data_level_bawah as $data_exp_bawah) {
                $exp_min = $data_exp_bawah[0];
            }
        }
        array_push($profile, array(
            'id' => $row[0],
            'nama' => $row[1],
            'dateofbirth' => $row[2],
            'email' => $row[3],
            'mulai_latihan' => $row[4],
            'point' => $row[5],
            'exp' => $row[6],
            'password' => $row[7],
            'level'=> $level_skg,
            'exp_max'=> $exp_max,
            'exp_min'=> $exp_min
        ));
    }
 
    echo json_encode($profile);
?>