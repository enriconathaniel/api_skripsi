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
	$token_onesignal = $requestBody['token_onesignal'];

	//var_dump(file_get_contents('php://input'));

	//echo $token_onesignal;

	// $email = 'janssen@student.umn.ac.id';
	// $password = '15011996';
	// $token_onesignal = 'asd';
	//60566

	// $email = 'patricko.franschay@student.umn.ac.id';
	// $password = '30101996';
	// $token_onesignal = 'asd';


	//hashing password
	//$hash = md5($password.$type);

	//masukkin db
	include 'config/db_umnspa.php';

	$query = "SELECT nim,password,notification FROM mahasiswa WHERE email LIKE '".$email."' LIMIT 1";
	$data = $conn->query($query);

	$return = null;
	foreach ($data as $row) {

		if(strcmp($row['password'], $password) == 0){

			$query_token = "UPDATE mahasiswa 
			  		SET token_onesignal = '".$token_onesignal."' WHERE email = '".$email."'";

			$data_update = $conn->query($query_token);

			if($data_update){
				$return['nim'] = $row['nim'];
				$return['notification'] = $row['notification'];
				$return['token'] = true;
			}
			else{
				$return['token'] =  false;
			}
			
			if($return['token'] == true){

				include 'get_api.php';

				$api = 'select_idMoodle.php';
				$param = ["email" => $email];

				$res = json_decode(get_api($api,$param));
				//print_r($res);

				$return['id_moodle'] = $res->id_moodle;

				$return['success'] = true;
			}
		}
		else{
			$return['success'] = false;
		}
	}

	echo json_encode($return);
?>