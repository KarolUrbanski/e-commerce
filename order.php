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

//Convert JSON string to PHP array 
$productArray = json_decode($prodIDs, true);

$options = ['email' => $email];
$customer = $db->Customers_Data->findOne($options);

$totalPrice=0;

$order["Customer-details"]=[
    "first-name"=>$customer["first-name"],
    "last-name" =>$customer["last-name"],
    "email" => $customer["email"], 
    "phone-number" => $customer["phone-number"],
     "address" => $customer["address"]
];
$order["Date"]=date('l jS \of F Y h:i:s A');
for($i=0; $i<count($productArray); $i++){
    $options = ['_id' => new MongoDB\BSON\ObjectID($productArray[$i]['id'])];
    $cursor = $db->All_Products_Store->findOne($options);
    $order["item-".$i]=["CartItem" => $cursor,
    "Quantity" => $productArray[$i]['count']];
    $totalPrice=$totalPrice+($cursor['Price']*$productArray[$i]['count']);

}
$order["TotalPrice"]=$totalPrice;

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


