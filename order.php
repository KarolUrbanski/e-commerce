<?php

//Include libraries
require __DIR__ . '/vendor/autoload.php';
    
//Create instance of MongoDB client
$mongoClient = (new MongoDB\Client);

//Select a database
$db = $mongoClient->EcommerceWeb;
//Extract the customer details 
$prodIDs= $_POST['prodIDs'];

session_start();   
$email=$_SESSION['loggedInUser'];

//if user is not logged in send him to login page
if(!array_key_exists("loggedInUser", $_SESSION) ){
    header("Location: login.html"); 
    exit();
}

//Convert JSON string to PHP array 
$productArray = json_decode($prodIDs, true);

$options = ['email' => $email];
$customer = $db->Customers_Data->findOne($options);

$totalPrice=0;

$order["CustomerInfo"]=[
    "first-name"=>$customer["first-name"],
    "last-name" =>$customer["last-name"],
    "email" => $customer["email"], 
    "phone-number" => $customer["phone-number"],
     "address" => $customer["address"]
];
$itemCount=0;
$CartItems=[];
for($i=0; $i<count($productArray); $i++){
    $options = ['_id' => new MongoDB\BSON\ObjectID($productArray[$i]['id'])];
    $cursor = $db->All_Products_Store->findOne($options);
    $cursor["Quantity"]=$productArray[$i]['count'];
    array_push($CartItems,$cursor);
    $totalPrice=$totalPrice+($cursor['Price']*$productArray[$i]['count']);
    $itemCount++;
}
$order["CartItems"]=$CartItems;
$order["ProductTypes"]=$itemCount;
$order["Status"]= "Successful";
$order["VAT"]= "20%";
$order["TotalPrice"]=$totalPrice;
$order["PurchaseDate"]=date('l jS \of F Y h:i:s A');
    $returnVal = $db->Orders->insertOne($order);

//Echo result back to user
if($returnVal->getInsertedCount() == 1){
    echo "Order succesfully ordered :)";
    sleep(1);
    header("Location: user.php"); 
exit();
}
else
    echo 'Order to server error.';


