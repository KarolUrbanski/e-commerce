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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
   
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
                            <li style="width: 150px;"> <a href="cms-orders.php"> View and delete customer orders. </a></li>
                            <li style="width: 150px;"> <a href="#"id="logout"> logout </a></li>
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
                    <h2> edit product</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-1">
                    <form id="form" action="cms-update_product.php" method="POST">

                        <div class="col-1 ">
                            product ID to edit:
                            <div class="input-container">
                                <select id="productId">
                                    <option selected="true" disabled="disabled">Select Product ID</option>
                                <?php
                                 foreach ( $returnAll as $id => $value )
                                {
                                   echo "<option value=".$value['_id'].">". $value['_id']." - ".$value['Name']."</option>";
                                 }
                                ?>
                                </select>
                            </div>
                            <div class="input-container">
                            <input type="file" id="img" name="img" accept="image/*" onchange="loadFile()">
                        </div>
                            <div class="input-container">
                             <img id="outputimg" width="200" height='200'style=" border: 3px solid #fff;"/>
                             </div>
                            <div class="input-container">
                                <input type="text" id="product_name" name="product_name" placeholder=" ">
                                <label for="product_name">Product Name</label>
                            </div>
                            <div class="input-container">
                            <div class="input-container">
                            <input type="text" id="reference" name="reference" placeholder=" " readonly>
                            <label for="reference">Product reference number</label>
                            </div>
                            </div>
                            <div class="input-container">
                            <input type="text" id="stock_amount" name="stock_amount" placeholder=" " required>
                            <label for="stock_amount">Product stock amount</label>
                            </div>
                            <div class="input-container">
                                <input type="text" id="product_price" name="product_price" placeholder=" ">
                                <label for="product_price">Product Price</label>
                            </div>
                            Product Category: <div class="input-container">
                                <select class="sort" name="category" id="category">
                                    <option value="Salty">Salty
                                    <option value="Sweet" selected="">Sweet
                                    <option value="Chocolate" selected="">Chocolate
                                    <option value="Sour" selected="">Sour
                                </select>
                            </div>
                            <div class="input-container">
                                <textarea id="description" name="description" rows="4" cols="50"></textarea>
                                <span for="description">Description</span>
                            </div>
                            <div class="input-container">
                           <input type="text" id="tax" name="tax" placeholder=" " required>
                            <label for="tax">Product tax</label>
                          </div>
                        <div class="input-container">
                        <input type="text" id="discount" name="discount" placeholder=" " required>
                        <label for="discount">Product discount</label>
                      </div>
                        </div>

                        <div class="col-1 mt-60">
                            <input id="Edit" class="btn-standard" type="submit" name="Edit" value="Edit" />
                        </div>
                    </form>
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
<script type="text/javascript" >
//This function load the image to the filed down the upload image button and  output the path to the image
function loadFile() {
var imgpath = $('#img').val();
var path = imgpath.replace("C:\\fakepath\\", "");
$('#outputimg').attr("src",'imgs/'+path);
};

//This is l=the logout function That will redirect the user to the login page and clear the session storage. 
 $("#logout").click(function(e){
        window.location="cms-login.html";
        sessionStorage.clear();
    });
//after selecting  product from the drop down list this function submit the ID value to php file get_product.php which will process this ID to update the form with the product information of the selected ID
        $("#productId").change(function(){
            var selected = $('#productId').val();
            $.ajax({
            method:"POST",
             url: "cms-get_product.php",
             type: 'POST',
             data:{
                 selected:selected
             },
             dataType:"json",
            success:function(data) {
               if(data){
                $('#outputimg').attr("src",'imgs/'+data["Tag"]["ImgUrl"]);
                $('#product_name').val(data["Name"]);
                $('#product_price').val(data["Price"]);
                $('#category').val(data["Category"]);
                $('#description').val(data["Description"]);
                $('#stock_amount').val(data["Tag"]["StockAmount"]);
                $('#tax').val(data["Tax"]);
                $('#discount').val(data["Discount"]);
                $('#reference').val(data["Tag"]["Reference"]);
               }
               else{
              alert("No Data")
               
               }
            }
       })        
        
        })
 
 //this function submit the data to php file update_product.php which will process this data to update the collection with the new product information of the selected ID
 $("#form").submit(function(e){
     e.preventDefault();
    // alert($("#discount").val());
    var path =$("#outputimg").attr('src');
        if(path.includes('imgs/')){
            path= path.substring(5,path.length);
        }
    $.ajax({
        method: 'POST',
        type: "POST",
        url: "cms-update_product.php",
        dataType:'json',
        data:{
            ID:$('#productId').val(),
            Reference: $("#reference").val(),
            Img:path,
            Stock: $("#stock_amount").val(),
            ProductName: $("#product_name").val(),
            Category: $("#category").val(),
            Description: $("#description").val(),
            Price: $("#product_price").val(),
            Tax: $("#tax").val(),
            Discount: $("#discount").val()
            },
            
        success: function(response){
            if (response == 1){
                alert("Product Edited Successfully");
                window.location="cms-view-products.php";
                
            }
            else if (response == 0){
                alert("Can't Edit Product");
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