<?php
//Include libraries
require 'vendor/autoload.php';
    
//Create instance of MongoDB client
$mongoClient = new MongoDB\Client;

if($mongoClient){
//Select a database
$db = $mongoClient->EcommerceWeb;

//Select a collection 
$collection = $db->Employees_Data;


/* Extract the data that was sent to the server By the POST method and Search the collection 
for existing employee. */

if (isset($_POST['email']) && isset($_POST['password'])) {
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
//convert to PHP array
$query = array("email" => $email, "password" => $password);

$result = $collection->findOne($query);


//send the found result back.
if(!empty($result)){
   echo 1; 
    }
else {
    echo 0;
    }
}
}


else{
    echo  "data baseconnection error";
}
?>

