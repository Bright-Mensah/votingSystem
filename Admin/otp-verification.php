<?php 

session_start();

error_reporting(0);
require_once('./db-config.php');
$msg = '';

if(isset($_SESSION['loginSuccess'])){

  header("location:success.php");
}
else{
    // header("location:index.php");
}


// verify admin


if(isset($_POST['btnVerify'])){
    
    // check if the input is not empty
    $otpCode = $_POST['otpCode'];

    if(empty($otpCode)){
        $msg = '<div class="text-red-600 py-3 font-bold text-3xl">Enter Otp code</div>';

    }
    else{
        // check if otp code is the same as the otp code in the db 
        $adminEmail = $_SESSION['email'];
        $query = "select * from admin where email='$adminEmail'";

        $query_run = mysqli_query($connection,$query);

        if($query_run){

            $getCode = mysqli_fetch_assoc($query_run);
    
            $code = $getCode['otp'];
    
            $msg =  $code;

            // check if the entered otp code is equal to the otp code in the db
            if($otpCode == $code){

              $_SESSION['loginSuccess'] = true;

                $msg = '<div class="text-green-600 font-bold text-3xl py-3">Verified</div>';
                echo "<script>
                setTimeout(function(){
                    window.location.href='http://localhost/vote/Admin/success';

                },3000);
                
                </script>";

            }
            else{
                $msg = '<div class="text-red-600 font-bold text-3xl py-3">OTP is not correct</div>';
            }
        }
        else{
            echo 'something went wrong';
        }



        
    }
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <!-- tailwind css cdn -->
     <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <!--
  This component uses @tailwindcss/forms

  yarn add @tailwindcss/forms
  npm install @tailwindcss/forms

  plugins: [require('@tailwindcss/forms')]
-->

<div class="hidden xl:block xl:absolute xl:left-0 xl:top-10">
    <img src="./otp_image.jpg" class="h-80" alt="otp image">
</div>

<div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-6 lg:px-8">
<img src="./otp_image.jpg" class="h-52 lg:block xl:hidden mx-auto" alt="otp image">

  <div class="mx-auto max-w-lg text-center">
    <h1 class="text-2xl font-bold sm:text-3xl">TWO STEPS AUTHENTICATION</h1>

    <p class="mt-4 text-gray-500">
     
     For added security, please enter the one time Password (OTP) that has been sent to your email ending in <?php echo  $_SESSION['hiddenEmail'] ?>"

    </p>

    <p class="text-slate-900">
        <?php echo $msg ?>
    </p>
  </div>

  <form action="" method="POST" class="mx-auto mt-8 mb-0 max-w-md space-y-4">
    <div>
      <label for="otpcode" class="sr-only">otp Code</label>

      <div class="relative">
        <input
          type="text"
          class="w-full rounded-lg bg-slate-900 text-white border-slate-900 p-4 pr-12 text-sm shadow-sm"
          placeholder="Enter OTP Code"
          name="otpCode"
          value="<?php echo $_POST['otpCode'] ?>"
        />

      
      </div>
    </div>

  

    <div class="text-center">
     
      <button
        type="submit"
        class="ml-3 inline-block rounded-lg bg-slate-900 px-5 py-3 text-sm font-medium text-white"
        name="btnVerify"
      >
        Verify
      </button>
    </div>
  </form>
</div>

</body>
</html>