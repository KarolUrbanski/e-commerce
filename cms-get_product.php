<?php
require __DIR__ . '/vendor/autoload.php';
    
//Create instance of MongoDB client
$mongoClient = (new MongoDB\Client);

//Select a database
$db = $mongoClient->EcommerceWeb;

//Select a collection 
$collection = $db->All_Products_Store;


//When the post method happen this part convert the data to BSON and the whole POST variable to PHP array to search for data using MongoDB ID and echo the found result. 
if(isset($_POST['selected'])){
 $selected = $_POST['selected'];
 $foundresult = $collection->findOne(array('_id' => new MongoDB\BSON\ObjectId($selected)));
 
echo json_encode($foundresult);
}

else{
    echo 0;
}


    

   

    

?>