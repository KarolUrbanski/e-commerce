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

$idString = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_URL);
    
//Create instance of MongoDB client
$mongoClient = (new MongoDB\Client);

//Select a database
$db = $mongoClient->EcommerceWeb;   
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
                        <input class="searchInput"type="text" name="" placeholder="Search">
                        <button class="searchButton" href="#">
                           <img height="20px" src="https://cdn-icons-png.flaticon.com/512/54/54481.png">
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </header>


    <section id="product">

        <div class="container">
            <div class="row">
                <div class="col-2">
                    <img src="imgs/candy.jpg" class="img-circle mt-60">
                </div>
                <div class="col-2">
                <?php

$filter  = ['_id' => new MongoDB\BSON\ObjectID($idString)];
//Find all of the customers that match  this criteria

$cursor = $db->All_Products_Store->findOne($filter);



//Output the results
echo "<h2>";
echo $cursor['Name'];
echo "</h2>";
echo "<p> Desciption: " . $cursor['Description']."</p>";
echo "<br>Category: " . $cursor['Category'];
echo "<br>Rating: ". $cursor['Rating']."/5";
echo "<p><h3>Price: ".$cursor['Price']."£ </p> </h3>";


?>
                    <input class="btn-standard" id="quantity" type="number" value="1" min="1" max="99"
                        style="width: 2em; text-align: center;">
                    <a href="basket.html"><button onclick="toBasket()" class="btn-standard">To basket</button></a>
                </div>


            </div>
        </div>

    </section>
    <section class="more_info">

        <div class="row">
            <div class="col-1 icon-content-wraper">
                <h5> Addintional informations</h5>
                <p> Product may contain: </p>
                <p>- tofu (soya)</p>
                <p>- tahini paste (sesame)</p>
                <p>- whey (milk)</p>
                <p>- gluten</p>
                <p>An allergic reaction can be produced by a tiny amount of a food ingredient
that a person is sensitive to (a drop of milk, a fragment of peanut or just one or two
sesame seeds). Symptoms of an allergic reaction can range from mild symptoms
such as itching around the mouth and rashes and can progress to more severe
symptoms such as vomiting, diarrhoea, difficulty breathing and on occasion
anaphylaxis (shock). When people with coeliac disease consume even the smallest
amount of gluten, the reaction is not the same as an allergic reaction and they will
not go into anaphylactic shock, but it will result in symptoms. These symptoms
usually start a few hours after eating it and symptoms can last from a few hours to
several days. Ongoing ingestion of gluten results in symptoms such as diarrhoea,
constipation, nutritional deficiencies including iron, folic acid and B12 anaemias and
associated complications such as osteoporosis.
</p>
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
   function toBusket(){

        document.getElementById('quantity').value;

    }
</script>