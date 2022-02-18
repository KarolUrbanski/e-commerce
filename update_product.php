<?php

//Include libraries
require __DIR__ . '/vendor/autoload.php';
    
//Create instance of MongoDB client
$mongoClient = (new MongoDB\Client);

//Select a database
$db = $mongoClient->EcommerceWeb;

//Select a collection 
$collection = $db->All_Products_Store;

//Extract the data that was sent to the server
if($_SERVER['REQUEST_METHOD'] === 'POST'){
$path=$_POST['Img']; 
$id=$_POST['ID'];
$reference = $_POST['Reference'];
$stock = $_POST['Stock'];
$name = $_POST['ProductName'];
$category = $_POST['Category'];
$description = $_POST['Description'];
$price = $_POST['Price'];
$tax = $_POST['Tax'];
$discount = $_POST['Discount'];


$tag="Tag";

//Convert to PHP array
$dataArray = [
    '_id' => new MongoDB\BSON\ObjectId($id),
     $tag => [
    "Reference" => $reference,
    "StockAmount" => $stock,
    "ImgUrl"=>$path
],
    "Name" => $name, 
    "Description" => $description, 
    "Category" => $category,
    "Tax" => $tax, 
    "Rating" => " ",
    "Discount" => $discount, 
    "Price" => $price
 ];
$res = $collection->UpdateOne(
    [ '_id' => new MongoDB\BSON\ObjectId($id)],
    ['$set' => [  $tag => [
        "Reference" => $reference,
        "StockAmount" => $stock,
        "ImgUrl"=>$path
    ],
        "Name" => $name, 
        "Description" => $description, 
        "Category" => $category,
        "Tax" => $tax, 
        "Rating" => " ",
        "Discount" => $discount, 
        "Price" => $price
        ]
    ]
        
);

if($res){
   echo 1;
    
}
else {
    echo 0;
}

}


else {
    echo 'Error adding customer';
}

