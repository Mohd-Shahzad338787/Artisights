<?php
include "config.php";
// add product
if (isset($_POST['addProduct'])) {
  $name = mysqli_real_escape_string($db, $_POST['name']);
  $price = mysqli_real_escape_string($db, $_POST['price']);
  $description = mysqli_real_escape_string($db, $_POST['description']);
  //  if (empty($name)) { array_push($errors, "name is required"); }
  //  if (empty($price)) { array_push($errors, "price is required"); }
  //  if (empty($description)) { array_push($errors, "description is required"); }

  $filename = $_FILES["imag1"]['name']; 
  $tempname = $_FILES["imag1"]['tmp_name'];   
      $folder = "image/".$filename; 

      
      // Get all the submitted data from the form 
      $sql = "INSERT INTO add_product (name,price,description,image1) VALUES ('$name','$price','$description','$filename')"; 
      
      // Execute query 
      mysqli_query($db, $sql); 
        
      // Now let's move the uploaded image into the folder: image 
      if (move_uploaded_file($tempname, $folder))  { 
        echo  "<script>alert('Data insert in the Database')</script>"; 
      }
      else
      {  
          $msg = "Failed to upload image"; 
    } 
    header('location:overview.php');
  }
  
  // $uploadFolder = 'image/';
  // foreach ($_FILES['imag1']['tmp_name'] as $key => $image) {
  //     $imageTmpName = $_FILES['imag1']['tmp_name'][$key];
  //     $imageName = $_FILES['imag1']['name'][$key];
  //     $result = move_uploaded_file($imageTmpName,$uploadFolder.$imageName);

  //     // save to database
  //     $query = "INSERT INTO add_product (name,price,description,image1) VALUES ('$name','$price','$description','$imageName')";
  //     $run = $db->query($query) or die("Error in saving image".$connection->error);
  // }
  // if ($result) {
  //     echo '<script>alert("Images uploaded successfully !")</script>';
  //     echo '<script>window.location.href="index.php";</script>';
  // }



  



// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM register WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	//$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO register (username, email, password) 
  			  VALUES('$username', '$email', '$password_1')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
       header('location: ../../index.php');
    //   echo "You are successful Registered";
  }
}


// LOGIN USER
if (isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }
  
    if (count($errors) == 0) {
        //$password = md5($password);
        $query = "SELECT * FROM register WHERE email='$username' AND password='$password'";
        $results = mysqli_query($db, $query);
        if (mysqli_num_rows($results) == 1) {
          $_SESSION['username'] = $username;
          $_SESSION['success'] = "You are now logged in";
          header('location:../../index.php');
        }else {
            array_push($errors, "Wrong username/password combination");
        }
    }
  }

// Add user details
  if (isset($_POST['addUser'])) {
    $fname = mysqli_real_escape_string($db, $_POST['fname']);
    $lname = mysqli_real_escape_string($db, $_POST['lname']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $contact = mysqli_real_escape_string($db, $_POST['contact']);
    
   
    
  
    $filename = $_FILES["image"]['name']; 
    $tempname = $_FILES["image"]['tmp_name'];   
        $folder = "userimage/".$filename; 
        echo $fname;
        echo $lname;
        echo $email;
        echo $filename;
        // Get all the submitted data from the form 
        $sql = "INSERT INTO user (fname,lname,email,contact,image) VALUES ('$fname','$lname','$email','$contact','$filename')"; 
      
        // Execute query 
        mysqli_query($db, $sql); 
          
        // Now let's move the uploaded image into the folder: image 
        if (move_uploaded_file($tempname, $folder))  { 
          echo  "<script>alert('Data insert in the Database')</script>"; 
        }
        else
        {  
            $msg = "Failed to upload image"; 
      } 
     
    }
    

  
  
  ?>