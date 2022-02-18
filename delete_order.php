<?php

//Include libraries
require __DIR__ . '/vendor/autoload.php';
    
//Create instance of MongoDB client
$mongoClient = (new MongoDB\Client);

//Select a database
$db = $mongoClient->EcommerceWeb;

//Select a collection 
$collection = $db->Orders;
/*$result= $collection->insertOne([
    'OrderID' => "8d9G7s348S_22J",
    'Status'=>"Delivered",
    'CustomerInfo'=>[
        'Email'=>'rana@gmail.com'
    ],
    'PurchaseDate'=>'02/03/2022',
    'TotalPrice'=>'1050.50',
    'VAT'=>'35%']);
    printf("Inserted %d document(s)\n", $result->getInsertedCount());
    */
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    
$name=$_POST['order'];

$res = $collection->deleteOne(['OrderID' => $name]);

if($res){
   echo 1;
    
}
else {
    echo 0;
}

}

?>