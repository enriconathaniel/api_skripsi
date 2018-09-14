<?php 

	if (isset($_SERVER['HTTP_ORIGIN'])) {
	    header("Access-Control-Allow-Origin: *");
	    header('Access-Control-Allow-Credentials: true');
	    header('Access-Control-Allow-Headers: X-App-Token, Content-Type');
   	}

	//ngambil data dari mobile
	$requestBody = json_decode(file_get_contents('php://input'), true);


	//set data yang uda diambil
	$id = $requestBody['id'];
	$password = $requestBody['password'];
	//$token_onesignal = $requestBody['token_onesignal'];


	//masukkin db
	//include 'config/db_umnspa.php';
	include 'config/db_con.php';
	//$conn = new PDO('mysql:host=localhost;dbname=piranha','root','');

	$query = "SELECT email, password, id, role FROM atlet WHERE id = '".$id."' LIMIT 1";
	$data = $conn->query($query);

	$return = null;
	foreach ($data as $row) {
		$hashedPassword = md5($password.$row[0]);
		if(strcmp($row['password'], $hashedPassword) == 0){
			$return['success'] = true;
			$return['email'] = $row['email'];
		}
		else{
			$return['success'] = false;
		}
	}

	echo json_encode($return);
?>