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
session_start();   
//if user is not logged in send him to login page
if(!array_key_exists("loggedInUser", $_SESSION) ){
    header("Location: login.html"); 
    exit();
}
$email=$_SESSION['loggedInUser']
?>

<body>

    <header>

        <div class="container">
            <div class="row">
                <div class="col-1">
                    <nav id="menu">

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
                        <input class="searchInput" type="text" name="" placeholder="Search">
                        <button class="searchButton" href="#">
                            <img height="20px" src="https://cdn-icons-png.flaticon.com/512/54/54481.png">
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </header>

    <section>

        <div class="container " style="height: 55vh;">
            <div class="row">
                <div class="col-1 icon-content-wraper">
                    <h2> My Account</h2>
                   
                </div>
            </div>
            <div class="row icon-content-wraper">
                <div class="col-3 ">
                    <h1>Account details:</h1>
                    <div class="details">
                    <?php

                    //Find all of the customers that match  this criteria
                	$options = ['email' => $email];

                    $cursor = $db->Customers_Data->findOne($options);

                    //Output the results
                    echo "<p>";
                    echo "First name: " . $cursor['first-name'];
                    echo "<br>Last name: " . $cursor['last-name'];
                    echo "<br>Email: " . $cursor['email'];
                    echo "<br>Phone number: " . $cursor['phone-number'];
                    echo "<br>Address: ". $cursor['address'];
                    echo "</p>";


                    ?>
                    </div>

                </div>
                <div class="col-3 ">

                    <h1>Past orders:<h1>
                    <div id="orders">
                    <?php

                    //Find all of the orders that match  this criteria
                	$options = ['CustomerInfo.email' => $email];

                    $cursor = $db->Orders->find($options);

                    //Output the results
                foreach ($cursor as $cust){
                    echo "<p>";
                    echo "Order id: " . $cust['_id'];
                    echo "<br> Date: ". $cust['PurchaseDate'];
                    echo "<br>Order Price: ". $cust['TotalPrice'];
                    echo "<br>Products: <table>";
                    foreach ($cust['CartItems'] as $prod){
                        echo  "<tr>";
                        echo "<td style='text-align:center;font-size:small;'>- ".$prod['Name']." x".$prod['Quantity']."</td>";
                        echo "</tr>";
                    }
                    echo "</table><hr></p>";
                }



                    ?>
                    </div>

                </div>
                <div class="col-3 ">
                    <h1>Edit your details</h1>
                    <form action="change_details.php" method="post">
                    <div class="input-container">
                        <input id="Street" name="Street" type="text" placeholder=" " required>
                        <label for="Street">Street Address</label>
                    </div>

                    <div class="input-container">
                        <input id="Address" name="Address" type="text" placeholder=" ">
                        <label for="Address">Address Line 2</label>
                    </div>

                    <div class="input-container">
                        <input id="City" name="City" type="text" placeholder=" " required>
                        <label for="City">City</label>
                    </div>

                    <div class="input-container">
                        <input id="Region" name="Region" type="text" placeholder=" " required>
                        <label for="Region">State / Province / Region</label>
                    </div>

                    <div class="input-container">
                        <input id="Zip" name="Zip" maxlength="15" type="text" placeholder=" " required>
                        <label for="Zip">Postal / Zip Code</label>
                    </div>
                    <?php
                        echo" <input type='hidden' name='email' value=".$email.">";
                    ?>


                         <div class="col-1 mt-60">
                          <button type="submit" id="saveForm" class="btn-standard" >Save changes</button>
                         </div>
                        </form>
                </div>
                <div class="col-1 mt-60">

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
<script>

    let request = new XMLHttpRequest();
    window.onload=() => {
        showDetails();
        showOrders();
    }

    function showDetails(){

    }
    function showOrders(){

    }

</script>