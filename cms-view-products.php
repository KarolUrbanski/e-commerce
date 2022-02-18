<?php
require __DIR__ . '/vendor/autoload.php';
    
//Create instance of MongoDB client
$mongoClient = (new MongoDB\Client);

//Select a database
$db = $mongoClient->EcommerceWeb;

//Select a collection 
$collection = $db->All_Products_Store;
$returnAll = $collection->find();

?>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js" type="text/javascript"></script>
</head>

<body>

    <header>
        <div class="container">
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
                            <li style="width: 150px;"> <a href="cms-view-products.php"> View products </a> </li>
                            <li style="width: 150px;"> <a href="cms-add-product.html"> Add products </a> </li>
                            <li style="width: 150px;"> <a href="cms-edit-products.php"> Edit products </a> </li>
                            <li style="width: 150px;"> <a href="cms-orders.php"> View and delete customer orders. </a> </li>
                            <li style="width: 150px;"> <a href="#"id="logout"> logout </a>  </li>
                        </ul>

                    </nav>
                </div>
            </div>
        </div>

    </header>

    <section>

        <div class="container " style="height: 55vh;">
            <div class="row">
                <div class="col-1 icon-content-wraper">
                    <h2> view products</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <form id="form" action="search_product.php" method="post">

                        <div class="col-1 ">
                            Search product:
                            <div class="input-container">
                                <input type="text" id="product_name" name="product_name" placeholder=" ">
                                <label for="product_name">Product name</label>
                            </div>

                        </div>

                        <div class="col-1 mt-60">
                            <input id="Search" class="btn-standard" type="submit" name="Search" value="Search" />
                        </div>
                        
                    </form>
                </div>
                <div class="col-1">
                <h2>All Products</h2>
                <table id="products">
                    <tr>
                        <th>Product Image</th>
                        <th>Product Name</th>
                        <th>Product Price</th>
                        <th>Product Reference Name</th>
                        <th>Product Amount Stock</th>
                        <th>Product Category</th>
                        <th>Product Tax</th>
                        <th>Product Rating</th>
                        <th>Product Discount</th>
                        <th>Product Discription</th>
                    </tr>
                   
                    <?php
                    error_reporting(0);
                        foreach ( $returnAll as $id => $value )
                        {
                        echo "<tr>";
                        echo "<td><img src='imgs/". $value['Tag']['ImgUrl']."' width='100' height='100'></img></td>";
                         echo "<td>". $value['Name']."</td>";
                         echo "<td>". $value['Price']."</td>";
                         echo "<td>". $value['Tag']['Reference']."</td>";
                         echo "<td>". $value['Tag']['StockAmount']."</td>";
                         echo "<td>". $value['Category']."</td>";
                         echo "<td>". $value['Tax']."</td>";
                         echo "<td>". $value['Rating']."</td>";
                         echo "<td>". $value['Discount']."</td>";
                         echo "<td>". $value['Description']."</td>";
                         echo "</tr>";
                        }
                    ?>
                    
                    </table>
                   
                    </div>
                    
                    
                </div>
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

    <div class="article-progress-bar"></div>
<script>
    let store=document.getElementById('products').innerHTML;
    $("#logout").click(function(e){
        window.location="cms-login.html";
    });
    $("#form").submit(function(e){
     e.preventDefault();
    $.ajax({
        method: 'POST',
        type: "POST",
        url: "search_product.php",
         data:{
            ProductName: $("#product_name").val()
            },
        dataType:'json',
        success: function(data){
            if (data){

                $('td').remove();
               $("#products").append("<tr><td><img src='imgs/" 
               + data['Tag']['ImgUrl'] + "' width='100' height='100'></img></td><td>"
               + data['Name'] + '</td><td>' 
               + data['Price'] + '</td><td>' 
               + data['Tag']['Reference'] + '</td><td>' 
               + data['Tag']['StockAmount'] +'</td><td>' 
               + data['Category'] + '</td><td>'
               +data['Tax']+'</td><td>'
               +data['Rating']+'</td><td>'
               +data['Discount']+'</td><td>'
               +data['Description']+'</td>'
               +'</tr>');
          
                
            }
            else{
               alert("Can't Find Data");
                document.getElementById('products').innerHTML=store;
            }
        } 
        
    
    
    })
        
});

</script>
    <script src="assets/articleProgresBar/java/script.js"></script>
    <script src="js/mobile-nav.js"></script>
    <script src="assets/imageSlider/java/script.js"></script>

</body>

</html>