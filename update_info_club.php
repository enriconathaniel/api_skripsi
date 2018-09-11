<?php 

	if (isset($_SERVER['HTTP_ORIGIN'])) {
	    header("Access-Control-Allow-Origin: *");
	    header('Access-Control-Allow-Credentials: true');
	    header('Access-Control-Allow-Headers: X-App-Token, Content-Type');
   	}

	//ngambil data dari mobile
	$requestBody = json_decode(file_get_contents('php://input'), true);

	//set data yang uda diambil
	$clubinfo = $requestBody['clubinfo'];
	//$nim = '14110110026';

	//select db
	$conn = new PDO('mysql:host=localhost;dbname=piranha','root','');
	
	$query = "UPDATE klub SET clubinfo = '".$clubinfo."' ;";

	$data = $conn->query($query);

	$return = null;

	if($data){
		$return['insert'] = true;
	} else{
		$return['insert'] = false;
	}

	echo json_encode($return);

?>