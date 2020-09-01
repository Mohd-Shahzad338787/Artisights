<?php 
session_start();
// initializing variables
$username = "";
$email    = "";
// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'artisights');

    $product_id = $_GET['product_id'];
     echo $product_id ;

   $sql ="DELETE FROM add_product WHERE product_id ='$product_id'";
   echo $product_id ;
     $data=mysqli_query($db,$sql);
     echo $product_id ;
     if($data){

       header('location:overview.php');
     }
        else
        {
         echo "data not delete successfully";
       }
     ?>