<?php

//Include libraries
require __DIR__ . '/vendor/autoload.php';

$sortString = filter_input(INPUT_GET, 'sort', FILTER_SANITIZE_URL);
$cattegoryString = filter_input(INPUT_GET, 'Category', FILTER_SANITIZE_URL);

//Create instance of MongoDB client
$mongoClient = (new MongoDB\Client);

//Select a database
$db = $mongoClient->EcommerceWeb;

//Find all of the customers that match  this criteria
if ($cattegoryString ==""){
	
	$filter  = [];
}
else{
	$filter  = ['Category' => $cattegoryString];
}

if ($sortString == "Nasc") {
	$options = ['sort' => ['Name' => 1]];
}
elseif  ($sortString == "Ndesc") {
	$options = ['sort' => ['Name' => -1]];
}
elseif  ($sortString == "Pasc") {
	$options = ['sort' => ['Price' => -1]];
}
elseif  ($sortString == "Pdesc") {
	$options = ['sort' => ['Price' => 1]];
}
else{
$options = [];
}
$cursor = $db->All_Products_Store->find($filter, $options);



//Output the results
$x=0;
foreach ($cursor as $prod){
	$stock=$prod['Tag']['StockAmount'];
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
	<img src='".$prod['Tag']['ImgUrl'] ."' width='100' height='100'>
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
   //check for stock amount
   if($stock<1){
    echo "<button class='btn-standard'>Out of stock</button>";
}
else{
    echo "<button onclick=\"addToBasket('". $prod['_id']."','". $prod['Name']."')\"";
    echo "class='btn-standard'>To basket</button>";
}

   echo " </div>";
   if($x %4 == 3){
	echo "</div>";
	}
   $x++;
}


