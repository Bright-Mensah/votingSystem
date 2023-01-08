<?php 
include_once('./db-config.php');


error_reporting(0);

session_start();



$id = $_GET['id'];

$query = "delete from candidates where id='$id'";

$query_run = mysqli_query($connection,$query);

if($query_run){
 echo  "<div class='text-green-600 text-5xl text-center p-5'>candidate deleted</div>";

 echo "<script>
 setTimeout(function(){
     window.location.href='http://localhost/vote/Admin/candidates';

 },1000);
 
 </script>";


}
else{
    echo  "<div class='text-red-600 text-3xl text-center p-5'>something went wrong......</div>";


}
      

     









?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body>
    
</body>
</html>

