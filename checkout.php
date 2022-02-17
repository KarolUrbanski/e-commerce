
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
$email=$_SESSION['loggedInUser']
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
                            <li> <a href="#see_also"> Basket </a> </li>
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
    <section id="see_also">
        <div class="row">
            <div class="col-1">
                <div class="slider">
                    <div class="slider-content" style="height: 25vh;">

                        <div id="slide-1" class="item">
                            <div class="content">
                                <h1>
                                    Checkout Sour candies
                                    last day of discount! <br>
                                    :)
                                </h1>
                                <a href="product_page.html" class="btn-standard">Check the offer!</a>
                            </div>
                        </div>

                        <div id="slide-2" class="item">
                            <div class="content">
                                <h1>
                                    Checkout Sweet candies
                                    last day of discount! <br>
                                    :)
                                </h1>
                                <a href="product_page.html" class="btn-standard">Check the offer!</a>
                            </div>
                        </div>

                        <div id="slide-3" class="item">
                            <div class="content">
                                <h1>
                                    Checkout Salty candies
                                    last day of discount! <br>
                                    :)
                                </h1>
                                <a href="product_page.html" class="btn-standard">Check the offer!</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>

        <div class="container "
            style="height: 55vh; background-color: rgba(0, 0, 0, 0.05); border-radius: 1%; margin-top: 30px;">
            <div class="row ">

                    <div id="server">
                    <div class="col-3 ">
                    <h1>Shipping Address:</h1>
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
                <div class="col-1 mt-60">
                <form action="user.php">
                 <button type="submit"  class="btn-standard" >Change details</button>
                 </form>
                </div>

                </div>
                <div class="col-3 ">
                    <?php

//Extract the product IDs that were sent to the server
$prodIDs= $_POST['prodIDs'];

//Convert JSON string to PHP array 
$productArray = json_decode($prodIDs, true);

//Output the IDs of the products that the customer has ordered
echo '<h1>Products Orderd</h1>';
$totalPrice=0;
for($i=0; $i<count($productArray); $i++){
    $options = ['_id' => new MongoDB\BSON\ObjectID($productArray[$i]['id'])];
    $cursor = $db->All_Products_Store->findOne($options);
    echo "<p>";
    echo $cursor['Name']." - Quantity: ".$productArray[$i]['count']." <br> Price: ".$productArray[$i]['count']*$cursor['Price']."<br>";
    $totalPrice=$totalPrice+($cursor['Price']*$productArray[$i]['count']);
    echo "</p>";
}

?>
                </div>
                <div class="col-3 ">
                <?php



//Output the results
echo "<p>";
echo "<h1>Total Price: " . $totalPrice;
echo "</h1></p>";


?>
                <div class="col-1 mt-60">
                <form action="user.php">
                 <button type="submit"  class="btn-standard" >Order</button>
                 </form>
                </div>
                </div>

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

</body>

</html>
<script>


</script>
