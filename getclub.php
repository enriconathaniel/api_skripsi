<?php
    $id = $_POST['id'];
 
    $conn = new PDO('mysql:host=localhost;dbname=piranha','root','');
    //$conn = new PDO('mysql:host=mysql.idhostinger.com;dbname=u883464978_mone','u883464978_dolbe','Janssen8');
 
    //$return = null;
 
//  $query = $conn->prepare("SELECT artifactID FROM users WHERE username = '$username' LIMIT 1");
    $data = $conn->query("SELECT id, email, club_info FROM club");
 
    $club = array();
 
    foreach ($data as $row) {
        array_push($club, array(
            'id' => $row[0],
            'email' => $row[1],
            'club_info' => $row[2]
        ));
    }
 
    echo json_encode($club);
?>