<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> CandyCrush </title>
    <link rel="stylesheet" href="assets/imageSlider/css/style.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="assets/articleProgresBar/css/style.css">
</head>
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
//find customer by customer email
$customer = $db->Customers_Data->findOne($options);

$totalPrice=0;

//type all customer details to order
$order["CustomerInfo"]=[
    "first-name"=>$customer["first-name"],
    "last-name" =>$customer["last-name"],
    "email" => $customer["email"], 
    "phone-number" => $customer["phone-number"],
     "address" => $customer["address"]
];
$CartItems=[];
//type all the products to cartItems array
for($i=0; $i<count($productArray); $i++){
    $options = ['_id' => new MongoDB\BSON\ObjectID($productArray[$i]['id'])];
    //find product by product id
    $cursor = $db->All_Products_Store->findOne($options);
    //add product quantity to array
    $cursor["Quantity"]=$productArray[$i]['count'];
    array_push($CartItems,$cursor);
    //calculate total price
    $totalPrice=$totalPrice+($cursor['Price']*$productArray[$i]['count']);

    //change item stock by product oreder quantity
    $stock=$cursor["Tag"]["StockAmount"];
    $stock-=$productArray[$i]['count'];
    $customerData = [
        '$set' =>["Tag" => ["StockAmount"=> $stock]]
    ];

    $updateRes = $db->All_Products_Store->updateOne($options, $customerData);
    
}
//type CartItems array to order
$order["CartItems"]=$CartItems;
$order["Status"]= "Successful";
$order["VAT"]= "20%";
$order["TotalPrice"]=$totalPrice;
$order["PurchaseDate"]=date('l jS \of F Y h:i:s A');

//insert order into database
    $returnVal = $db->Orders->insertOne($order);
    ?>

<body>

    <header>

        <div class="container">
            <div class="row">
                <div class="col-1">
                    <nav id="menu-top">
                        <ul class="main-menu" style="margin: -10px 0 5px; ">
                            <div id="LoginPara">
                            <li class="register-login"> <a href="login.html"> Login </a> </li>
                            <li class="register-login"> <a href="register.html"> Register </a> </li>
                            </div>
                        </ul>

                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-1">
                    <div class="logo">
                        <a href="index.html"><img height="60px" src="imgs/logo2.png"></a>
                    </div>
                    <a class="mobile-menu-icon">
                        <img height="60px"
                            src="https://icon-library.com/images/menu-button-icon/menu-button-icon-7.jpg">
                    </a>
                    <nav id="menu">
                        <ul class="main-menu">
                            <li> <a href="index.html"> Home </a> </li>
                            <li> <a href="index.html#best_sellers"> Best sellers </a> </li>
                            <li> <a href="products-cattegories.html"> All products </a> </li>
                            <li> <a href="basket.html"> Basket </a> </li>
                            <li> <a href="index.html#about_us"> About us </a> </li>
                        </ul>

                    </nav>
                    <div class="searchBox">
                        <input class="searchInput"type="text" name="" placeholder="Search">
                        <button class="searchButton" href="#">
                           <img height="20px" src="https://cdn-icons-png.flaticon.com/512/54/54481.png">
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </header>

    <section>

        <div class="container "
            style="height: 55vh; background-color: rgba(0, 0, 0, 0.05); border-radius: 1%; margin-top: 30px;">
            <div class="row ">
                <div class="col-1 icon-content-wraper">
                   <div id="serwerResponse"></div>
              


               
                </div>
           
            </div>
        </div>

    </section>



    <section class="divider">

        <div class="row">
            <div class="col-1">
                <h3> The best candies from around the world!</h3>
                <p> Only on our site :) </p>
            </div>
        </div>

    </section>

    <footer>

        <div class="container">
            <div class="row">
                <div class="col-2">
                    <p>&copy; 2022 www.CandyCrush.com</p>
                </div>
                <div class="col-2 text-right">
                    <p>Privacy policy</p>
                </div>
            </div>
        </div>

    </footer>

<!-- progress bar + script to it-->
<div class="article-progress-bar"></div>
<script src="assets/articleProgresBar/java/script.js"></script>

<!-- mobile menu showing after clicking it-->
<script src="js/mobile-nav.js"></script>

<!-- script for image slider to change image every 5s-->
<script src="assets/imageSlider/java/script.js"></script>

<!-- Script for checking if logged in-->
<script src="JS/check-login.js"></script>
    <!-- Script for search-->
    <script src="js/search.js"></script>

</body>

</html>
<?php
//Echo result back to user
if($returnVal->getInsertedCount() == 1){
    //iff succesfull type that and after 1s change page to user account page
  echo '<script type="text/javascript">
   window.onload=load; function load(){ 
      console.log("dup");
     document.getElementById("serwerResponse").innerHTML="<h1>Order succesfull</h1>";
      setTimeout(function() {
         window.location.replace("/e-commerce/user.php");
     }, 1000);
     }
     </script>';
}
else
//else type error
    echo '<script type="text/javascript">
    document.getElementById("serwerResponse").innerHTML="<h1>ERROR</h1>";
    </script>
    ';

?>