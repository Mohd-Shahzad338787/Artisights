<?php 
session_start();
// initializing variables
$username = "";
$email    = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'artisights');

	if (isset($_GET['edit'])) {
		$id = $_GET['edit'];

		$record = mysqli_query($db, "SELECT * FROM add_product WHERE product_id =$id");
            $n = mysqli_fetch_array($record);
			$pname = $n['name'];
            $pprice = $n['price'];
            $pdescription = $n['description'];
            $pimage1 = $n['image1'];

		}   
?> 


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Data Update</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../../plugins/summernote/summernote-bs4.min.css">
  <!-- CodeMirror -->
  <link rel="stylesheet" href="../../plugins/codemirror/codemirror.css">
  <link rel="stylesheet" href="../../plugins/codemirror/theme/monokai.css">
  <!-- SimpleMDE -->
  <link rel="stylesheet" href="../../plugins/simplemde/simplemde.min.css">
</head>
<body class="hold-transition sidebar-mini">
    <!-- Main content -->
    <form  name="" method="GET" action="" >
    <section class="content">
      <div class="row" style="margin-right: -422.5px; margin-left: 292.5px;  margin-top: 50px;);">
        <div class="col-md-6">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Update Product Details</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="inputName">Product Name</label>
                <input type="text" id="inputName" name="name" value="<?php echo $pname; ?>" class="form-control">
                <input type="hidden" id="inputName" name="hid" value="<?php echo $id; ?>" class="form-control">
              </div> 
              <div class="form-group">
                <label for="inputClientCompany">Product Price</label>
                <input type="text" name="price" id="inputClientCompany" value="<?php echo $pprice; ?>" class="form-control">
              </div>
              <div class="form-group">
                <label for="inputClientCompany">Prodect Description</label>
                <textarea id="summernote" name="description" value="">
                <?php echo $pdescription; ?>
              </textarea>
              </div>

              <div class="form-group">
      <label><strong>Upload Images</strong></label>
      <?php echo $pimage1;?>
      <div class="custom-file">
          
        <input type="file" name="imag1"  value="<?php echo $pimage1;?>" id="customFile">
        <label class="custom-file-label" value="<?php echo $pimage1;?>" for="customFile" >Choose file</label>
      </div>
    </div>     
                  
            <div class="row">
              <div class="col-12">
                   <a href="add_product.php"  class="btn btn-secondary">Cancel </a>
                 <!-- <button type=submit name="addUpdate" value="<?php echo $producrd_id;?>">Add</button> -->
                   <input type="submit" name="submit"  value="Update" class="btn btn-success"> 
              </div>
           </div>
           </form>
    </section>
  <!-- /.content-wrapper -->
  <!-- <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.1.0-pre
    </div>
    <strong>Copyright &copy; 2014-2020 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer> -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- Summernote -->
<script src="../../plugins/summernote/summernote-bs4.min.js"></script>
<!-- CodeMirror -->
<script src="../../plugins/codemirror/codemirror.js"></script>
<script src="../../plugins/codemirror/mode/css/css.js"></script>
<script src="../../plugins/codemirror/mode/xml/xml.js"></script>
<script src="../../plugins/codemirror/mode/htmlmixed/htmlmixed.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    // Summernote
    $('#summernote').summernote()

    // CodeMirror
    CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
      mode: "htmlmixed",
      theme: "monokai"
    });
  })
</script>
</body>
</html>
<script>
$(document).ready(function() {
  $('input[type="file"]').on("change", function() {
    let filenames = [];
    let files = document.getElementById("customFile").files;
    if (files.length > 1) {
      filenames.push("Total Files (" + files.length + ")");
    } else {
      for (let i in files) {
        if (files.hasOwnProperty(i)) {
          filenames.push(files[i].name);
        }
      }
    }
    $(this)
      .next(".custom-file-label")
      .html(filenames.join(","));
  });
});
</script>



<?php
if (isset($_GET['submit'])) {

    $product_id=$_GET['hid'];
	$name=$_GET['name'];
	$price=$_GET['price'];
    $description=$_GET['description'];
    $image1=$_GET['imag1'];

           
    
    
	// update user data

	 $result = mysqli_query($db, "UPDATE add_product SET name='$name',price='$price',description='$description',image1='$image1'  WHERE product_id=$product_id");

   
    if($result){
        echo "data  update successfully";
      }
    else
       {
        echo "data not update successfully";
       }
      
}
?>

