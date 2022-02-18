<?php

//Include libraries
require __DIR__ . '/vendor/autoload.php';
    
//Create instance of MongoDB client
$mongoClient = (new MongoDB\Client);

//Select a database
$db = $mongoClient->EcommerceWeb;

//Select a collection 
$collection = $db->Orders; 

//extract data sent by POST method 
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    
$id=$_POST['order'];


$searchid = $collection->findOne(array('_id' => new MongoDB\BSON\ObjectId($id)));

if ($searchid){
    $ordertobedeleted = $collection->deleteOne(array('_id' => new MongoDB\BSON\ObjectId($id)));

if($ordertobedeleted){
    echo 1;  
    
}

else {
    echo 0;
}
}
else {
echo 0;

}

}


?>