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
echo "<h1>Results</h1>";
$x=0;
foreach ($cursor as $prod){
	if($x %4 == 0){
		echo "<div class='row mt-60'>";
	}
	
	echo "
	<div class='col-4'><a href='product_page.php?id=".$prod['_id']."'>
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
   echo "</p>";
   echo "</div> </a> </div>";
   if($x %4 == 3){
	echo "</div>";
	}
   $x++;
}


