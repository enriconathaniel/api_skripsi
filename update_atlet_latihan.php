<?php 

	if (isset($_SERVER['HTTP_ORIGIN'])) {
	    header("Access-Control-Allow-Origin: *");
	    header('Access-Control-Allow-Credentials: true');
	    header('Access-Control-Allow-Headers: X-App-Token, Content-Type');
   	}

	//ngambil data dari mobile
	$requestBody = json_decode(file_get_contents('php://input'), true);

	//set data yang uda diambil
	$id = $requestBody['id_user'];
	//$nim = '14110110026';
	$point_tambah = 25;
	$exp_tambah = 25;
	//select db
	include 'config/db_con.php';
	//$conn = new PDO('mysql:host=localhost;dbname=piranha','root','');
	
	$query = "UPDATE atlet 
			SET point = point + '".$point_tambah."',
				exp = exp + '".$exp_tambah."'
			WHERE id ='".$id."' ";

	$data = $conn->query($query);

	$return = null;

	if($data){
		$return['insert'] = true;
	} else{
		$return['insert'] = false;
	}

	echo json_encode($return);

?>

