<?php 
include "config.php";

	if (isset($_GET['id'])) {
		$id = $_GET['id'];
        echo $id; 
        $results = mysqli_query($db, "SELECT * FROM add_product WHERE product_id =$id");
        $row = mysqli_fetch_array($results)
    


        
            
            
           
            
         
    

?> 
<?php echo $row['name']; ?>   <?php  echo "<br>"; ?>
<?php echo $row['price'];?>    <?php  echo "<br>"; ?>
<?php echo $row['description'];?>    <?php  echo "<br>"; ?>
  <?php $image= $row['image1']; ?>   <?php  echo "<br>"; ?>
  <img src="image/<?php echo $image ;?>" width="300" height="300">

<?php } ?>