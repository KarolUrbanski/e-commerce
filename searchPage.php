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
                        <button class="searchButton" onclick="loadContent()">
                           <img height="20px" src="https://cdn-icons-png.flaticon.com/512/54/54481.png">
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </header>

    <section id="best_sellers">

        <div class="container">
            <div class="row">
                <div class="col-1">
                    <h2> Sweats</h2>
                    <p> Candy, also called sweets (British English) or lollies (Australian English, New Zealand English),[a] is a confection that features sugar as a principal ingredient. The category, called sugar confectionery, encompasses any sweet confection, including chocolate, chewing gum, and sugar candy. Vegetables, fruit, or nuts which have been glazed and coated with sugar are said to be candied.</p>
                </div>
            </div>
        </div>
        <div class="grey-bg">
            <div class="container">
                
                <div id="ServerContent">
                <?php

//Include libraries
require __DIR__ . '/vendor/autoload.php';

$search_string = filter_input(INPUT_GET, 'search', FILTER_SANITIZE_URL);
//Create instance of MongoDB client
$mongoClient = (new MongoDB\Client);

//Select a database
$db = $mongoClient->EcommerceWeb;
$findCriteria = [
    '$text' => [ '$search' => $search_string ] 
 ];
$cursor = $db->All_Products_Store->find($findCriteria);
echo "<h1>Results for: <b>".$search_string ."</b></h1>";
$x=0;
foreach ($cursor as $prod){
	if($x %4 == 0){
		echo "<div class='row mt-60'>";
	}
	
	echo "
	<div class='col-4' style='text-align: center;
	padding: 5px;
	background-image: linear-gradient(to bottom, rgba(150, 0, 50, 0.2) 0%, rgba(150, 0, 50, 0.2) 100%), linear-gradient(to bottom, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0) 100%);
	background-clip: content-box, padding-box;
    border-radius: 15px;
    height: 460px;'>
	<a href='product_page.php?id=".$prod['_id']."'>
	<div class='icon-wraper'><a href='product_page.php?id=".$prod['_id']."'>
	<img src='https://icon-library.com/images/bubble-gum-icon/bubble-gum-icon-21.jpg'>
	</div>
	<div class='icon-content-wraper'>
	";
   echo "<h3>";
   echo $prod['Name'];
   echo "</h3>";
   echo "<p>";
   echo $prod['Description'];
   echo "<br>Price: ";
   echo $prod['Price']."£";
   echo "<br>";
   echo "</p>";
   echo "</div> </a>";
   echo "<button onclick=\"addToBasket('". $prod['_id']."','". $prod['Name']."')\"";
   echo "class='btn-standard'>To basket</button>";
   echo " </div>";
   if($x %4 == 3){
	echo "</div>";
	}
   $x++;
}
?>
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

<!-- Script for adding items to basket in SessionStorage-->
<script src="JS/basket.js"></script>
    <!-- Script for search-->
    <script src="js/search.js"></script>

</body>

</html>
<script>
</script>