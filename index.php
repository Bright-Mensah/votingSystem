<?php

include_once './Admin/db-config.php';

error_reporting(0);

$msg = '';
session_start();


if(isset($_SESSION['email'])){
  header('location:user-vote');
}
else{
}

if(isset($_POST['btnSignIn'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    if(empty($email)){
    $msg = '<div class="text-red-600 p-3">email is empty</div>';

    }
    else if(empty($password)){
        $msg = '<div class="text-red-600 p-3">password is empty</div>';

    }
    else{
        $query = "select email and password from voters where email='$email' and password='$password'";
        $query_run = mysqli_query($connection,$query);

        if(mysqli_num_rows($query_run) > 0){

            $_SESSION['email'] = $email;
            
            $msg = "<div class='text-green-600 p-3'>Login successful</div>";

      

            echo "<script>
            setTimeout(()=>{
                window.location='http://localhost/vote/user-vote';
            },3000)
            </script>";

        }
        else{

            $msg = "<div class='text-green-600 p-3'>Something went wrong, try again ......</div>";

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
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body>
    <!--
  This component uses @tailwindcss/forms

  yarn add @tailwindcss/forms
  npm install @tailwindcss/forms

  plugins: [require('@tailwindcss/forms')]
-->

<div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-6 lg:px-8">
  <div class="mx-auto max-w-lg text-center">
    <h1 class="text-2xl font-bold sm:text-3xl">Sign up for an account to vote!</h1>

    <p class="mt-4 text-gray-500">
      To be able to vote, a user have to sign up for an account to get a <strong>unique id</strong>   to vote <br>
      note that your id will be visible on your dashboard.
    </p>

    <p class="text-center p-2"><?php echo  $msg ; ?></p>
  </div>

  <form action="" method="post" class="mx-auto mt-8 mb-0 max-w-md space-y-4">
    <div>
      <label for="email" class="sr-only">Email</label>

      <div class="relative">
        <input
          type="email"
          class="w-full rounded-lg border-gray-200 p-4 pr-12 text-sm shadow-sm"
          placeholder="Enter email"
          name="email"
        />

        <span class="absolute inset-y-0 right-4 inline-flex items-center">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-5 w-5 text-gray-400"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"
            />
          </svg>
        </span>
      </div>
    </div>

    <div>
      <label for="password" class="sr-only">Password</label>
      <div class="relative">
        <input
          type="password"
          class="w-full rounded-lg border-gray-200 p-4 pr-12 text-sm shadow-sm"
          placeholder="Enter password"
          name="password"
        />

        <span class="absolute inset-y-0 right-4 inline-flex items-center">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-5 w-5 text-gray-400"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
            />
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
            />
          </svg>
        </span>
      </div>
    </div>

    <div class="flex items-center justify-between">
      <p class="text-sm text-gray-500">
        No account?
        <a class="underline" href="signup">Sign up</a>
      </p>

      <button
        type="submit"
        class="ml-3 inline-block rounded-lg bg-blue-500 px-5 py-3 text-sm font-medium text-white"
        name="btnSignIn"
      >
        Sign in
      </button>
    </div>
  </form>
</div>


</body>
</html>