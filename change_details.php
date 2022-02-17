<?php

//Include libraries
require __DIR__ . '/vendor/autoload.php';
    
//Create instance of MongoDB client
$mongoClient = (new MongoDB\Client);

//Select a database
$db = $mongoClient->EcommerceWeb;

//Extract the customer details 
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
$Street= filter_input(INPUT_POST, 'Street', FILTER_SANITIZE_STRING);
$Address = filter_input(INPUT_POST, 'Address', FILTER_SANITIZE_STRING);
$City = filter_input(INPUT_POST, 'City', FILTER_SANITIZE_STRING);
$Region = filter_input(INPUT_POST, 'Region', FILTER_SANITIZE_STRING);
$Zip = filter_input(INPUT_POST, 'Zip', FILTER_SANITIZE_STRING);

$NewAddress=$Street." ".$Address.", ".$City." ".$Region.", ".$Zip;
//Criteria for finding document to replace
$replaceCriteria = [
    "email" => $email
];

//Data to replace
$customerData = [
    '$set' =>["address" => $NewAddress]
];

//Replace customer data for this email
$updateRes = $db->Customers_Data->updateOne($replaceCriteria, $customerData);
    
//Echo result back to user
if($updateRes->getModifiedCount() == 1){
header("Location: user.php"); 
exit();
}
else
    echo 'Customer replacement error.';


