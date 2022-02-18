<?php
require __DIR__ . '/vendor/autoload.php';
    
//Create instance of MongoDB client
$mongoClient = (new MongoDB\Client);

//Select a database
$db = $mongoClient->EcommerceWeb;

//Select a collection 
$collection = $db->All_Products_Store;

if(isset($_POST['selected'])){
 $selected = $_POST['selected'];
 //$arr = array('_id'=>(new \MongoId($selected))->toBSONType());
 $obj = $collection->findOne(array(
    '_id' => new MongoDB\BSON\ObjectId($selected)
));
 
echo json_encode($obj);
}
else{
    echo 0;
}
////Edit Product Part

    

   

    

?>