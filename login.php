<?php
    //Start session management
    session_start();
//Include libraries
require __DIR__ . '/vendor/autoload.php';
    
//Create instance of MongoDB client
$mongoClient = (new MongoDB\Client);

//Select a database
$db = $mongoClient->EcommerceWeb;

//Extract the data that was sent to the server
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

//Create a PHP array with our search criteria
$findCriteria = [
    'email'=> $email,
    'password'=> $password
 ];

 $cursor = $db->Customers_Data->find($findCriteria)->toArray();

if(count($cursor)==0){
    echo "Wrong email or password";
    return;
}
else if(count($cursor)>1){
    echo "error";
    return;
}
echo "ok";
$_SESSION['loggedInUser']=$email;

