<?php

	 if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Allow-Headers: X-App-Token, Content-Type');
    }

    // $requestBody = json_decode(file_get_contents('php://input'), true);


	$id_gaya = $_POST['id_gaya'];
	$id_user = $_POST['id_user'];
	$waktu = $_POST['waktu'];
	$date = date("Y-m-d");
	
    include 'config/db_con.php';
    //$conn = new PDO('mysql:host=localhost;dbname=piranha','root','');
	$query = "INSERT INTO history_latihan(id_user, id_gaya, tanggal, waktu) VALUES('".$id_user."','".$id_gaya."','".$date."','".$waktu."')";
	$data = $conn -> query($query);


	if($data){
    	$return['insert'] = true;
    }else{
    	$return['insert'] = false;
    }
	  

    echo json_encode($return);

?>