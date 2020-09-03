<?php 
include "config.php";

    $user_id = $_GET['user_id'];
     echo $user_id ;

   $sql ="DELETE FROM user WHERE user_id ='$user_id'";
   echo $user_id ;
     $data=mysqli_query($db,$sql);
     echo $user_id ;
     if($data){

       header('location:user_overview.php');
     }
        else
        {
         echo "data not delete successfully";
       }
     ?>