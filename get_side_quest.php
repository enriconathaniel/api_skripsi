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
    $data = $conn->query("SELECT id, deskripsi, tipe, value, point, exp FROM side_quest");
    $data_selesai = $conn->query("SELECT id, id_side_quest, tanggal, status from history_side_quest WHERE id_atlet ='".$id."'");

    $arr_data_selesai = array();
    foreach ($data_selesai as $row_selesai) {
        array_push($arr_data_selesai, $row_selesai[1]);
    }
    $side_quest = array();
 
    foreach ($data as $row) {
        if(in_array($row[0], $arr_data_selesai)){
            array_push($side_quest, array(
                'id' => $row[0],
                'deskripsi' => $row[1],
                'tipe' => $row[2],
                'value' => $row[3],
                'point' => $row[4],
                'exp' => $row[5],
                'status' => 'Selesai'
            ));            
        }else{
            array_push($side_quest, array(
                'id' => $row[0],
                'deskripsi' => $row[1],
                'tipe' => $row[2],
                'value' => $row[3],
                'point' => $row[4],
                'exp' => $row[5],
                'status' => 'Belum selesai'
            ));
        }

    }
 
    echo json_encode($side_quest);
?>