<?php
    //Include libraries
    require __DIR__ . '/vendor/autoload.php';


    //Get strings - need to filter input to reduce chances of SQL injection etc.
    $name= filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $lastname=filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
    $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);

    //Create instance of MongoDB client
    $mongoClient = (new MongoDB\Client);
    //Select a database
    $db = $mongoClient->EcommerceWeb;
    
    if($name != "" && $lastname != "" && $email != "" && 
    $password != "" && $phone != ""&& $address != ""){//Check query parameters 
        $findemail = [
            "email" => $email 
         ];

 //checking if email allrady exists
         
         $cursor = $db->Customers_Data->findOne($findemail);
         if(isset($cursor->email)){

              if($cursor->email == $email){   
                echo "Email is allready taken";
             }
        } 
        else{
        //STORE REGISTRATION DATA IN MONGODB 
        $document = array( 
            "first-name" => $name, 
            "last-name" =>$lastname,
            "email" => $email, 
            "phone-number" => $phone,
            "password" => $password,
            "address" => $address
            
         );
        $db->Customers_Data->insertOne($document);
            //Output message confirming registration
                echo '<h1>Thank you for registering </h1>' . $name;

        }


    }
    else{//A query string parameter cannot be found
        echo 'Registration data missing';
    }

