<?php 
include "db.php";
if (isset($_POST['publish'])){
    $data = $_POST["editor"];
    $data = $conn->real_escape_string($data);
    
    $title = $_POST["editor"];
    $title = $conn->real_escape_string($title);
   
   

    
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Content Creation</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <meta name="description" content="" />
    <meta name="keywords" content="" />

    <link rel="shortcut icon" href="ftco-32x32.png">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="ckeditor/ckeditor.js"></script>
    
  </head>
  <body>
  
  <center>
  <h2> Create a Post</h2></center>
 <div class = 'panel panel-default' style = "padding:10px;"> 
 <div class = 'panel panel-heading'> </div>
 <div class='panel panel-body'> 
  
 <div class= 'main'>
 <form action = "post.php" method = "POST" enctype = "multipart/form-data">

 <h5>Add a title for your post</h5>
 <textarea rows="2" cols="70" name = "title" class = "form-control" placeholder="What's in your mind?"></textarea><br>
 <select name = "hallName" class = "form-control">
 <?php
$i=0;
$sql = $conn->query("select hallName from hall_details");
while($db_row = $sql->fetch_array()) {
?><option name=".<?php echo $db_row["hallName"]; ?>."> <?php echo $db_row["hallName"]; ?> <br>
<?php
$i++;
}
?>   
 </select><br>
 <textarea name = "editor" class = "ckeditor" ></textarea>
 <div class= "d-flex justify-content-center">
 <br>
 <button type = "submit"  name = "publish" class = "btn btn-primary"> Publish </button>
 </div>
 </div>

</form>

 </div>
 </div> 

  </body>
  </html>



