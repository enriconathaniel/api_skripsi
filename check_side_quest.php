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
 
    $query = "SELECT id, nama, tanggallahir, email, password, mulai_latihan, point, exp, role FROM atlet WHERE id = '".$id_atlet."' ";
    $query2 = "SELECT id, deskripsi, tipe, value, point, exp FROM side_quest";
    $date = date("Y-m-d");

    $data = $conn->query($query);
    $data2 = $conn->query($query2);
    $point_atlet_skg =0;
    $exp_atlet_skg = 0;
    $level_sekarang = 0;
    
    foreach ($data as $row_data_atlet) {
        $point_atlet_skg = $row_data_atlet[6];
        $exp_atlet_skg = $row_data_atlet[7];
    }

    //ambil level skrg
    $data_level = $conn->query("SELECT level, exp_max from level WHERE exp_max > '".$exp_atlet_skg."' limit 1");
    foreach ($data_level as $level) {
        $level_sekarang = $level[0];
    }
    
    foreach ($data2 as $row_side_quest) {
        $id_side_quest = $row_side_quest[0];

        if((($row_side_quest[2] == 'Level') && ($row_side_quest[3]<= $level_sekarang))||(($row_side_quest[2] == 'Point') && ($row_side_quest[3]<= $point_atlet_skg))){
            
            //kecapai
            if($row_side_quest[3]<= $level_sekarang){
                //cek dulu udah pernah dimasukin atau belum

                $query_validate_side_quest = "SELECT id, id_atlet, id_side_quest, tanggal, status from history_side_quest WHERE id_atlet ='".$id_atlet."'AND id_side_quest='".$id_side_quest."'";
                $data_validate_side_quest = $conn->query($query_validate_side_quest);
                if($data_validate_side_quest->rowCount() == 0){
                    $query_insert_history = "INSERT INTO history_side_quest(id_atlet, id_side_quest,tanggal, status) VALUES('".$id_atlet."','".$id_side_quest."','".$date."',1)";
                    $data = $conn -> query($query_insert_history);

                    $query_update = "UPDATE atlet SET point = point + '".$row_side_quest[4]."', exp = exp + '".$row_side_quest[5]."' WHERE id = '".$id_atlet."'";
                    $data4 = $conn->query($query_update); 
                        // var_dump($data_insert_history);
                    echo $query_insert_history;
                }
            }
        }
    }

    // $waktu_latihan = array();
    // $result = array();
    // $success = 0;
    // foreach ($data as $row) {
         
    //     array_push($waktu_latihan, array(
    //          'waktu' => $row[4],
    //         'id_gaya' => $row[2]
    //     ));
    // }

    
    // if($success == 1){
    //     array_push($result, array(
    //         'success' => true,
    //         'message' => 'succesully updated'
    //     ));
    // }else if($success == 2){
    //     array_push($result, array(
    //         'success' => true,
    //         'message' => 'already updated'
    //     ));
    // }else{
    //     array_push($result, array(
    //         'success' => false,
    //         'message' => 'no matching data'
    //     ));
    // }
 
    // echo json_encode($result);
?>