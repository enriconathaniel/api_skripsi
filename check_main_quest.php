<?php

    if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Allow-Headers: X-App-Token, Content-Type');
    }
    
    // $requestBody = json_decode(file_get_contents('php://input'), true);
    $id_atlet = $_POST['id'];

    // $id_atlet = $requestBody['id'];


    include 'config/db_con.php';
    //$conn = new PDO('mysql:host=localhost;dbname=piranha','root','');
    //$conn = new PDO('mysql:host=mysql.idhostinger.com;dbname=u883464978_mone','u883464978_dolbe','Janssen8');
 
    //$return = null;
 
    $query = "SELECT id, id_user, id_gaya, tanggal, waktu FROM history_latihan WHERE id_user = '".$id_atlet."' ";
    $query2 = "SELECT id, id_atlet, id_gaya, target, point, exp, status FROM main_quest WHERE id_atlet = '".$id_atlet."' ";

    $data = $conn->query($query);
    $data2 = $conn->query($query2);
    $waktu_latihan = array();
    $result = array();
    $success = 0;
    // foreach ($data as $row) {
         
    //     array_push($waktu_latihan, array(
    //          'waktu' => $row[4],
    //         'id_gaya' => $row[2]
    //     ));
    // }

    foreach ($data2 as $row) {

        foreach ($data as $wl) {
            //if gaya id sama dan waktunya lebih kecil dari target             
            if($row[2] == $wl[2] && $row[3]>=$wl[4]){
                          

                $id_main_quest = $row[0];
                $point_atlet = (int)$row[4];
                $exp_atlet = (int)$row[5];
                $query_check_status = "SELECT status FROM main_quest WHERE id = '".$id_main_quest."'";
                $data_check_status = $conn->query($query_check_status);
                foreach ($data_check_status as $status) {
                    $success = 2;
                    if($status[0] == '0'){
                        $query3 = "UPDATE main_quest SET status = 1 WHERE id = '".$id_main_quest."'";
                        $data3 = $conn->query($query3);
                        $query4 = "UPDATE atlet SET point = point + '".$point_atlet."', exp = exp + '".$exp_atlet."' WHERE id = '".$id_atlet."'";
                        $data4 = $conn->query($query4); 
                        $success = 1;                       
                    }
                }


            }
        }
       


    }
    if($success == 1){
        array_push($result, array(
            'success' => true,
            'message' => 'succesully updated'
        ));
    }else if($success == 2){
        array_push($result, array(
            'success' => true,
            'message' => 'already updated'
        ));
    }else{
        array_push($result, array(
            'success' => false,
            'message' => 'no matching data'
        ));
    }
 
    echo json_encode($result);
?>