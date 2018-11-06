<?php

    if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Allow-Headers: X-App-Token, Content-Type');
    }

    include 'config/db_con.php';
    //$conn = new PDO('mysql:host=localhost;dbname=piranha','root','');
    //$conn = new PDO('mysql:host=mysql.idhostinger.com;dbname=u883464978_mone','u883464978_dolbe','Janssen8');
 
    //$return = null;
 
//  $query = $conn->prepare("SELECT artifactID FROM users WHERE username = '$username' LIMIT 1");
    $data = $conn->query("SELECT id, nama, tanggallahir, email, mulai_latihan, point, exp FROM atlet WHERE nama IS NOT NULL AND nama != '' ORDER BY 6 DESC");
    
    $profile = array();
    $total_point = 0;
    $point_kumpul = 0;
    $status = 0;
    foreach ($data as $row) {
        $id_atlet = $row[0];
        

        $data_point = $conn->query("SELECT history_reward.id, history_reward.id_user, reward.nama , reward.harga , history_reward.tanggal FROM history_reward JOIN reward ON history_reward.id_reward = reward.id");

        foreach($data_point as $check_data){
            if($id_atlet == $check_data[1]){
                $total_point = $total_point + $check_data[3];
                $status = 1 ;
            }
            else if($id_atlet !== $check_data[1]){
                $total_point = 0;
            }
        }
        //echo $total_point;
        if($status ==1){
            $point_kumpul = $row[5] + $total_point;
        }
        else if($status ==0){
            $point_kumpul = $row[5];
        }
        
        

        array_push($profile, array(
            'id' => $row[0],
            'nama' => $row[1],
            'dateofbirth' => $row[2],
            'email' => $row[3],
            'mulai_latihan' => $row[4],
            'point' => $point_kumpul,
            'exp' => $row[6]
        ));
    }

    usort($profile, function($a, $b)
        {
            return $a['point'] < $b['point'];
        });
 
    echo json_encode($profile);
?>