<?php 

	if (isset($_SERVER['HTTP_ORIGIN'])) {
	    header("Access-Control-Allow-Origin: *");
	    header('Access-Control-Allow-Credentials: true');
	    header('Access-Control-Allow-Headers: X-App-Token, Content-Type');
   	}

	//ngambil data dari mobile
	$requestBody = json_decode(file_get_contents('php://input'), true);


	//set data yang uda diambil
	$email = $requestBody['email'];
	$password = $requestBody['password'];
	//$token_onesignal = $requestBody['token_onesignal'];

	//var_dump(file_get_contents('php://input'));

	//echo $token_onesignal;

	// $email = 'janssen@student.umn.ac.id';
	// $password = '15011996';
	// $token_onesignal = 'asd';
	//60566


	//hashing password
	//$hash = md5($password.$type);

	//masukkin db
	//include 'config/db_umnspa.php';
	$conn = new PDO('mysql:host=localhost;dbname=piranha','root','');

	$query = "SELECT email, password, id FROM atlet WHERE email LIKE '".$email."' LIMIT 1";
	$data = $conn->query($query);

	$return = null;
	foreach ($data as $row) {
		$hashedPassword = md5($password.$email);
		if(strcmp($row['password'], $hashedPassword) == 0){
			$return['success'] = true;
			$return['id'] = $row['id'];
		}
		else{
			$return['success'] = false;
		}
	}

	echo json_encode($return);
?>