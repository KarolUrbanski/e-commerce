<?php
require __DIR__ . '/vendor/autoload.php';
    
//Create instance of MongoDB client
$mongoClient = (new MongoDB\Client);

//Select a database
$db = $mongoClient->EcommerceWeb;

//Select a collection 
$collection = $db->Orders;
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
                    <h2> delete/view orders</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <form id="form" action="delete_order.php" method="post">

                        <div class="col-1 ">
                            Delete order:
                            <div class="input-container">
                                <input type="text" id="order_id" name="order_id" placeholder=" ">
                                <label for="order-id">Order id</label>
                            </div>

                        </div>

                        <div class="col-1 mt-60">
                            <input id="delete" class="btn-standard" type="submit" name="delete" value="delete-order" />
                        </div>
                        <div id="output" class=" col-1 mt-60">
                            output:
                        </div>
                    </form>
                </div>
                <div class="col-1">
                    <h2>All Orders</h2>
                <table id="orders">
                    <tr>
                       
                        <th>Order ID</th>
                        <th>Order Status</th>
                        <th>Customer Email</th>
                        <th>Order Purchase Date</th>
                        <th>Order Total Price</th>
                        <th>Order Vat</th>
                        
                    </tr>
                   
                    <?php
                        foreach ( $returnAll as $id => $value )
                        {
                        echo "<tr id=".$value['_id'].">";
                         echo "<td>". $value['_id']."</td>";
                         echo "<td>". $value['Status']."</td>";
                         echo "<td>". $value['CustomerInfo']['email']."</td>";
                         echo "<td>". $value['PurchaseDate']."</td>";
                         echo "<td>". $value['TotalPrice']."</td>";
                         echo "<td>". $value['VAT']."</td>";
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
        $("#logout").click(function(e){
        window.location="cms-login.html";
    });
    $("#form").submit(function(e){
     e.preventDefault();
    $.ajax({
        method: 'POST',
        type: "POST",
        url: "delete_order.php",
         data:{
            order: $("#order_id").val()
            },
        dataType:'json',
        success: function(response){
            if (response==1){
                var id=$("#order_id").val();
                $('#'+id+'').remove();
                $('#output').val("Order Deleted")
            }
            else if(response==0){
                $('#output').val("Can't Delete Order")
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