<?php

//Include libraries
require __DIR__ . '/vendor/autoload.php';
    
//Create instance of MongoDB client
$mongoClient = (new MongoDB\Client);

//Select a database
$db = $mongoClient->EcommerceWeb;

//Select a collection 
$collection = $db->All_Products_Store;

//Extract the data that was sent to the server By the POST method 
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    
$path=$_POST['Img'];
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
$dataArray = [ $tag => [
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
 
//Search the collection for similler product to stop inserting the same product twice 
$findReference = $collection->findOne($dataArray);

//Only if there is no similler product in the collection then add the new product.
if(empty($findReference)){

//Add the new product to the database
$insertResult = $collection->insertOne($dataArray);

//Echo feedback to user in both cases (if seccessful or failed process of adding product).
if($insertResult->getInsertedCount()){
    echo 1;
    
}
else {
    echo 0;
}
}
else{
    echo 0;
}
}


else {
    echo 'Error adding product';
}

