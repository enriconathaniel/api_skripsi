<?php

    if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Allow-Headers: X-App-Token, Content-Type');
    }
    
    include 'config/db_con.php';
    //$conn = new PDO('mysql:host=localhost;dbname=piranha','root','');
    //$conn = new PDO('mysql:host=mysql.idhostinger.com;dbname=u883464978_mone','u883464978_dolbe','Janssen8');
 
    //$return = null;
 
//  $query = $conn->prepare("SELECT artifactID FROM users WHERE username = '$username' LIMIT 1");
    $data = $conn->query("SELECT reward_barang.id, reward_barang.id_reward, reward.nama, reward_barang.nama_barang, reward.harga
                        FROM reward_barang
                        JOIN reward ON reward_barang.id_reward = reward.id;");
 
    $reward_barang = array();
    
    $gold = array();
    $silver = array();
    $bronze = array();
    $harga_gold = 0;
    $harga_silver = 0;
    $harga_bronze = 0;


    foreach ($data as $row) {
      
      if($row[2] == "Gold"){
        array_push($gold, array('id'=> $row[0], 'nama_barang' => $row[3]));
        $harga_gold = $row[4];
      }elseif($row[2] == "Silver"){
        array_push($silver, array('id'=> $row[0], 'nama_barang' => $row[3]));
        $harga_silver = $row[4];
      }else{
        array_push($bronze, array('id'=> $row[0], 'nama_barang' => $row[3]));
        $harga_bronze = $row[4];
      }
        
    }

      array_push($reward_barang, array(
            'jenis' => 'gold',
            'nama_barang' => $gold,
            'harga' => $harga_gold
            
          ),
          array(
            'jenis' => 'silver',
            'nama_barang' => $silver,
            'harga' => $harga_silver
            
          ),
          array(
            'jenis' => 'bronze',
            'nama_barang' => $bronze,
            'harga' => $harga_bronze
            
          ));
 
    echo json_encode($reward_barang);
?> 