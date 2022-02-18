<?php

//Include libraries
require __DIR__ . '/vendor/autoload.php';
    
//Create instance of MongoDB client
$mongoClient = (new MongoDB\Client);

//Select a database
$db = $mongoClient->EcommerceWeb;

//Select a collection 
$collection = $db->All_Products_Store;


if($_SERVER['REQUEST_METHOD'] === 'POST'){
    
$name=$_POST['ProductName'];

$res = $collection->findOne(['Name' => $name]);

if($res){
   echo json_encode($res);
    
}
elseif ($res = $collection->findOne(['Tag.Reference' => $name])){
 	 echo json_encode($res);
 }

 else{
 	echo 0;
 }   
}

?>