<?php
   include("config.php");
   
   if(isset($_POST['but_upload'])){
   	
   	
    	$text=$_POST['title'];
     $name = $_FILES['file']['name'];
     $target_dir = "Uploads/";
     $target_file = $target_dir . basename($_FILES["file"]["name"]);
   	
   	$temp = explode(".", $_FILES["file"]["name"]);
   	$newfilename = round(microtime(true)) . '.' . end($temp);
   	
   	
     // Select file type
     $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
   
     // Valid file extensions
     $extensions_arr = array("jpg","jpeg","png","gif");
   
     // Check extension
     if( in_array($imageFileType,$extensions_arr) ){
    
        // Insert record
        $query = "INSERT INTO `image`( `name`, `title`) VALUES ('$newfilename','$text')";
        if(mysqli_query($con,$query)){
   		 
   		  move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$newfilename);
   		 $message="Upload Success";
   		  //echo "<script>alert('$message');</script>"; 
   		 
   	 }else{
   	  $message="Error In Uploading";
   		 // echo "<script>alert('$message');</script>"; 
     }
        	  
     }else{
   	  $message ="error in extensiton";
   	// echo "<script>alert('$message');</script>"; 
     }
    
   }
   
   ?>
<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
      <title>Hello, world!</title>
      <style>
         .imggal {
         height: 300px;
         width: auto;
         }
      </style>
   </head>
   <body>
      <nav class="navbar navbar-light " style="background-color:#2c5282">
         <a class="navbar-brand" style="color:white;margin-left:48%">Image Gallary</a>
      </nav>
      <div class="container">
         <h3 class="text-center mt-3 text-danger"> <?php if(!empty($message)){echo $message;} ?></h3>
      </div>
      <div class="container mt-3 ">
         <form action="" method="POST" enctype="multipart/form-data">
            <div class="custom-file mt-5 mb-3 align-self-center" style="max-width:350px">
               <input required type="file" class="custom-file-input" id="customFile" name="file">
               <label class="custom-file-label" for="customFile">Choose file</label>
            </div>
            <div class="mb-3" style="max-width:350px">
               <label for="exampleInputEmail1">Image Title</label>
               <input required type="text" class="form-control" id="exampleInputEmail1"  placeholder="Enter Image Title" name="title">
               <button type="submit" name="but_upload" class="btn btn-primary mt-3">Upload</button>
            </div>
         </form>
      </div>
      <div class="container">
         <div class="row">
            <?php 
               //$query = "select * from image;";
               $ret=mysqli_query($con,"select * from image order by id DESC;");
               
               while($row=mysqli_fetch_array($ret)){
               ?>
            <div class="col-sm pb-5">
               <div class="card" style="width: 20rem;">
                  <img class="card-img-top imggal" src="Uploads/<?php echo $row['name']; ?>" alt="Card image cap">
                  <div class="card-body">
                     <h5 class="card-title text-center" style="color:#4299e1"><?php echo $row['title']; ?></h5>
                  </div>
               </div>
            </div>
            <?php } ?>
         </div>
      </div>
      <footer style="background-color:#2c5282">
         <!-- Copyright -->
         <div class="footer-copyright text-center py-3" >© 2020 Copyright:
            <a style="color:white" href="https://mdbootstrap.com/"> Vishal Karande</a>
         </div>
         <!-- Copyright -->
      </footer>
      <!-- Optional JavaScript; choose one of the two! -->
      <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
      <!-- image gallary end -->
      <script>
         // Add the following code if you want the name of the file appear on select
         $(".custom-file-input").on("change", function() {
           var fileName = $(this).val().split("\\").pop();
           $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
         });
      </script>
   </body>
</html>