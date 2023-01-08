<?php

include './Admin/db-config.php';

session_start();

$voterId = $_SESSION['voter_id'];

if(isset($_SESSION['voted']) || isset($_SESSION['email'])){

}
else{
    header('location:user-vote');
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
   
  
<div class="flex justify-center mt-20">
  <div class="flex flex-col md:flex-row md:max-w-xl rounded-lg bg-white shadow-lg">
    <img class=" w-full h-96 md:h-auto object-cover md:w-48 rounded-t-lg md:rounded-none md:rounded-l-lg" src="https://img.freepik.com/premium-vector/hand-casting-vote-with-ballot-box-voting-concept-vector-illustration_667085-47.jpg?w=2000" alt="" />
    <div class="p-6 flex flex-col justify-start">
      <h5 class="text-gray-900 text-xl font-medium mb-2">Thank you for voting.</h5>
        <p class="text-gray-600 font-bold text-2xl">You voted for :</p>

      <p class="text-gray-700 text-base mb-4">
      <?php 
    
    
    $query = "select * from votes where voter_id ='$voterId'";
    
    $query_run = mysqli_query($connection,$query);
    
    while($getData = mysqli_fetch_assoc($query_run)){
        ?>
        <div class="p-2">
        <h4><strong>Boys Prefect: </strong><?php echo $getData['BoysPrefect'] ?></h4>
        <h4><strong>Assist Boys Prefect: </strong><?php echo $getData['assistBoysPrefect'] ?></h4>
        <h4><strong>Girls Prefect: </strong><?php echo $getData['GirlsPrefect'] ?></h4>
        <h4><strong>Assist Girls Prefect: </strong><?php echo $getData['assistGirlsPrefect'] ?></h4>
       
    </div>
        <?php
        
    }
        
        ?> 
    

      </p>
    
    </div>
  </div>
</div>
</body>
</html>