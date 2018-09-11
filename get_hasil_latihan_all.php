<?php
    
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Allow-Headers: X-App-Token, Content-Type');
    }
    
    // $id = $_POST['id'];
 
    $conn = new PDO('mysql:host=localhost;dbname=piranha','root','');
    //$conn = new PDO('mysql:host=mysql.idhostinger.com;dbname=u883464978_mone','u883464978_dolbe','Janssen8');
 
    //$return = null;
 
//  $query = $conn->prepare("SELECT artifactID FROM users WHERE username = '$username' LIMIT 1");
    $data = $conn->query("SELECT history_latihan.id , atlet.nama , gaya_renang.nama_gaya , gaya_renang.jarak , history_latihan.tanggal , history_latihan.waktu FROM history_latihan JOIN gaya_renang ON history_latihan.id_gaya = gaya_renang.id JOIN atlet ON history_latihan.id_user = atlet.id");
 
    $hasil_latihan_all = array();
 
    foreach ($data as $row) {
        array_push($hasil_latihan_all, array(
            'id' => $row[0],
            'nama_atlet' => $row[1],
            'nama_gaya' => $row[2],
            'jarak' => $row[3],
            'tanggal' => date("d-m-Y", strtotime($row[4])),
            'waktu' => $row[5]
        ));
    }
 
    echo json_encode($hasil_latihan_all);
?>