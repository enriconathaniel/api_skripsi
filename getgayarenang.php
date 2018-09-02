<?php
    $id = $_POST['id'];
 
    $conn = new PDO('mysql:host=localhost;dbname=piranha','root','');
    //$conn = new PDO('mysql:host=mysql.idhostinger.com;dbname=u883464978_mone','u883464978_dolbe','Janssen8');
 
    //$return = null;
 
//  $query = $conn->prepare("SELECT artifactID FROM users WHERE username = '$username' LIMIT 1");
    $data = $conn->query("SELECT id, nama_gaya, jarak FROM gaya_renang");
 
    $gaya_renang = array();
 
    foreach ($data as $row) {
        array_push($gaya_renang, array(
            'id' => $row[0],
            'nama_gaya' => $row[1],
            'jarak' => $row[2]
        ));
    }
 
    echo json_encode($gaya_renang);
?>