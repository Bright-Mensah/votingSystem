<?php 
error_reporting(0);
require_once('./db-config.php');
$msg = '';

session_start();



if(isset($_SESSION['hiddenEmail'])){

  header("location:otp-verification.php");
}
else{
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


if(isset($_POST['btnSubmit'])){
    // check if email and password are empty
    
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(empty($email)){

        $msg = 'email is empty';

    }
    else if(empty($password)){
        $msg = 'password is empty';


    }
    else{
        // check if admin email and password exist 
       
        $adminPassword = md5($password);

        $query = "SELECT * from admin WHERE email='$email' AND password='$adminPassword'";

        $query_run = mysqli_query($connection,$query);

        if(mysqli_num_rows($query_run) > 0){

          $row = mysqli_fetch_assoc($query_run);

          $getName = $row ['name'];
          $getEmail = $row ['email'];

          $_SESSION['adminName'] = $row['name'];

          $adminName = $getName;
          $adminEmail = $getEmail;

      // $string =  preg_replace("/(?!^).(?!$)/", "*", $adminEmail).substr(()); // 
     $hiddenEmail =  substr($adminEmail,0,3)."******".substr($adminEmail,(strlen($adminEmail))-15,3).substr($adminEmail,0,0)."******";

     


     $fourDigitRandomNumber = mt_rand(1111,9999);
     


        

            /////////////////// SEND OTP CODE TO ADMIN EMAIL TO VERIFY /////////////////



          
            
//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'mobvotingsystem@gmail.com';                     //SMTP username
    $mail->Password   = 'ejcazurctyjceoyb';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('mobvotingsystem@gmail.com', 'Voting System Team');
    $mail->addAddress($email, $adminName);     //Add a recipient
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    // //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    // insert code to the db 
    $query = "update Admin set otp='$fourDigitRandomNumber' where email='$email'";
    $query_run = mysqli_query($connection,$query);

    $_SESSION['email'] = $email;

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Two-Step Verification';
    // $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->Body    = "Hi, $adminName <br>  <br> We received a request to access your account <a href='$email'>$email</a>  through
    your email address. <br> <br>  Your OTP verification code is <h1><b>$fourDigitRandomNumber</b></h1>
    
    <br>  <br>
    if you did not request this code, it is possible that someone else is trying to access your account <a href='$email'>$email</a>. <br> <br> <b>Do not forward or give this code to anyone.</b>
    ";
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    $_SESSION['hiddenEmail'] = $hiddenEmail;
    // echo 'Message has been sent';
    header("location:http://localhost/vote/Admin/otp-verification.php");
} catch (Exception $e) {
    // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    $msg= '<div class="text-red-600 font-bold-py-2">Mail could not be sent. Check your Internet Service</div>';
}

        }
        else{

            $msg= 'Admin account does not exist';
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
    <title>Welcome Admin</title></title>

    <!-- tailwind css cdn -->
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body>
   

        
   
    <div class="flex items-center justify-center">

    <div class="bg-slate-900 dark:bg-black ">

      <!--
  This component uses @tailwindcss/forms

  yarn add @tailwindcss/forms
  npm install @tailwindcss/forms

  plugins: [require('@tailwindcss/forms')]
-->

<div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-6 lg:px-8">
  <div class="mx-auto max-w-lg text-center">
    <h1 class="text-2xl font-bold sm:text-3xl text-white">Welcome Admin</h1>

    <p class="mt-4 text-white">
     Voting System
    </p>
    
    <p class="mt-4 text-white">
        <?php if($msg ==''){
            ?>
            After Signing in you will receive an OTP code to verify that you are the right Admin
            <?php 
          
        } 
        else{
            echo $msg;
            ?>
        <?php
        }
            ?>
    </p>
  </div>

  <form action="" method="POST" class="mx-auto mt-8 mb-0 max-w-md space-y-4">
    <div>
      <label for="email" class="sr-only dark:text-white">Email</label>

      <div class="relative">
        <input
          type="email"
          class="w-full rounded-lg border-gray-200 p-4 pr-12 text-sm shadow-sm"
          placeholder="Enter email"
          name="email"
          value="<?php echo $_POST['email'] ?>"
        />

       
      </div>
    </div>

    <div>
      <label for="password" class="sr-only dark:text-white">Password</label>
      <div class="relative">
        <input
          type="password"
          class="w-full rounded-lg border-gray-200 p-4 pr-12 text-sm shadow-sm"
          placeholder="Enter password"
          name="password"
          value="<?php echo $_POST['password'] ?>"
        />

       
      </div>
    </div>

    <div class="text-center">
     
      <button
      name="btnSubmit"
        type="submit"
        class="ml-3 inline-block rounded-lg bg-blue-500 px-5 py-3 text-sm 
        font-medium text-white hover:bg-blue-900"
      >
        Sign in
      </button>
    </div>
  </form>
</div>


        
    </div>
    </div>
</body>
</html>