<?php 
include "config.php";

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