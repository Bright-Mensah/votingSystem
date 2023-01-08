<?php

include './Admin/db-config.php';
error_reporting(0);
session_start();



if(isset($_SESSION['email'])){

}
else{
    header('location:index');
}




$email = $_SESSION['email'];
$query = "select * from voters where email ='$email'";
$query_run = mysqli_query($connection,$query);
if($query_run){
    $data = mysqli_fetch_assoc($query_run);
    $voterId= $data['voter_id'];
    $_SESSION['voter_id'] = $voterId;
}


   // check if user  has already voted
   $query = "select * from votes where voter_id ='$voterId'";
   $query_run = mysqli_query($connection,$query);
   
   if(mysqli_num_rows($query_run) !=0){
       // user has already voted
    $_SESSION['votedAlready'] = 'you have already voted';
  
 
   }
   else{

if(isset($_POST['valid'])){
    $boysPrefect = $_POST['boysPrefect'];
    $assitBoysPrefect = $_POST['assitBoysPrefect'];
    $girlsPrefect = $_POST['girlsPrefect'];
    $assistGirlsPrefect = $_POST['assistGirlsPrefect'];
    
 


    
        $query = "insert into votes(voter_id,BoysPrefect,assistBoysPrefect,GirlsPrefect,assistGirlsPrefect)values('$voterId','$boysPrefect','$assitBoysPrefect',' $girlsPrefect',' $assistGirlsPrefect') ";
        $_SESSION['voted'] = true;
        $query_run = mysqli_query($connection,$query);
        if($query_run){
            json_encode(array("data"=>'success'));
        }
        else{
    
        }

    } 
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tailwind Starter Template - Nordic Shop: Tailwind Toolbox</title>
    <meta name="description" content="Free open source Tailwind CSS Store template">
    <meta name="keywords" content="tailwind,tailwindcss,tailwind css,css,starter template,free template,store template, shop layout, minimal, monochrome, minimalistic, theme, nordic">
    
    <script src="https://cdn.tailwindcss.com"></script>
	
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:200,400&display=swap" rel="stylesheet">

    <style>
        .hide{
            display: none;
        }
        .work-sans {
            font-family: 'Work Sans', sans-serif;
        }
                
        #menu-toggle:checked + #menu {
            display: block;
        }
        
        .hover\:grow {
            transition: all 0.3s;
            transform: scale(1);
        }
        
        .hover\:grow:hover {
            transform: scale(1.02);
        }
        
        .carousel-open:checked + .carousel-item {
            position: static;
            opacity: 100;
        }
        
        .carousel-item {
            -webkit-transition: opacity 0.6s ease-out;
            transition: opacity 0.6s ease-out;
        }
        
        #carousel-1:checked ~ .control-1,
        #carousel-2:checked ~ .control-2,
        #carousel-3:checked ~ .control-3 {
            display: block;
        }
        
        .carousel-indicators {
            list-style: none;
            margin: 0;
            padding: 0;
            position: absolute;
            bottom: 2%;
            left: 0;
            right: 0;
            text-align: center;
            z-index: 10;
        }
        
        #carousel-1:checked ~ .control-1 ~ .carousel-indicators li:nth-child(1) .carousel-bullet,
        #carousel-2:checked ~ .control-2 ~ .carousel-indicators li:nth-child(2) .carousel-bullet,
        #carousel-3:checked ~ .control-3 ~ .carousel-indicators li:nth-child(3) .carousel-bullet {
            color: #000;
            /*Set to match the Tailwind colour you want the active one to be */
        }
    </style>

</head>

<body class="bg-white text-gray-600 work-sans leading-normal text-base tracking-normal">

    <!--Nav-->
    <nav id="header" class="w-full z-30 top-0 py-1">
        <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-6 py-3">

            <label for="menu-toggle" class="cursor-pointer md:hidden block">
                <svg class="fill-current text-gray-900" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                    <title>menu</title>
                    <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path>
                </svg>
            </label>
            <input class="hidden" type="checkbox" id="menu-toggle" />

            <div class="hidden md:flex md:items-center md:w-auto w-full order-3 md:order-1" id="menu">
           
            </div>

            <div class="order-1 md:order-2">
                <a class="flex items-center tracking-wide no-underline hover:no-underline font-bold text-gray-800 text-xl " href="#">
                   <?php echo isset($voterId) ?  '<p class="bg-slate-900 text-white rounded px-3 py-3">Your voter id is '. $voterId.' </p>' : 'VOTING SYSTEM' ?>
                </a>
                <?php echo $_SESSION['votedAlready'] ? $_SESSION['votedAlready'] : '' ?>
                <p class="message font-bold text-center"></p>
                
            </div>

            <div class="order-2 md:order-3 flex items-center" id="nav-content">

                <a class="inline-block no-underline hover:text-black" href="user-profile" title="profile">
                    <svg class="fill-current hover:text-black" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <circle fill="none" cx="12" cy="7" r="3" />
                        <path d="M12 2C9.243 2 7 4.243 7 7s2.243 5 5 5 5-2.243 5-5S14.757 2 12 2zM12 10c-1.654 0-3-1.346-3-3s1.346-3 3-3 3 1.346 3 3S13.654 10 12 10zM21 21v-1c0-3.859-3.141-7-7-7h-4c-3.86 0-7 3.141-7 7v1h2v-1c0-2.757 2.243-5 5-5h4c2.757 0 5 2.243 5 5v1H21z" />
                    </svg>
                </a>
                <a class="inline-block no-underline hover:text-black ml-5" href="logout" title="logout">
                    <!-- <svg class="fill-current hover:text-black" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <circle fill="none" cx="12" cy="7" r="3" />
                        <path d="M12 2C9.243 2 7 4.243 7 7s2.243 5 5 5 5-2.243 5-5S14.757 2 12 2zM12 10c-1.654 0-3-1.346-3-3s1.346-3 3-3 3 1.346 3 3S13.654 10 12 10zM21 21v-1c0-3.859-3.141-7-7-7h-4c-3.86 0-7 3.141-7 7v1h2v-1c0-2.757 2.243-5 5-5h4c2.757 0 5 2.243 5 5v1H21z" />
                    </svg> -->
                    <svg fill="#000000" height="24" width="24" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 330 330" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_iconCarrier"> <g id="XMLID_2_"> <path id="XMLID_4_" d="M51.213,180h173.785c8.284,0,15-6.716,15-15s-6.716-15-15-15H51.213l19.394-19.393 c5.858-5.857,5.858-15.355,0-21.213c-5.856-5.858-15.354-5.858-21.213,0L4.397,154.391c-0.348,0.347-0.676,0.71-0.988,1.09 c-0.076,0.093-0.141,0.193-0.215,0.288c-0.229,0.291-0.454,0.583-0.66,0.891c-0.06,0.09-0.109,0.185-0.168,0.276 c-0.206,0.322-0.408,0.647-0.59,0.986c-0.035,0.067-0.064,0.138-0.099,0.205c-0.189,0.367-0.371,0.739-0.53,1.123 c-0.02,0.047-0.034,0.097-0.053,0.145c-0.163,0.404-0.314,0.813-0.442,1.234c-0.017,0.053-0.026,0.108-0.041,0.162 c-0.121,0.413-0.232,0.83-0.317,1.257c-0.025,0.127-0.036,0.258-0.059,0.386c-0.062,0.354-0.124,0.708-0.159,1.069 C0.025,163.998,0,164.498,0,165s0.025,1.002,0.076,1.498c0.035,0.366,0.099,0.723,0.16,1.08c0.022,0.124,0.033,0.251,0.058,0.374 c0.086,0.431,0.196,0.852,0.318,1.269c0.015,0.049,0.024,0.101,0.039,0.15c0.129,0.423,0.28,0.836,0.445,1.244 c0.018,0.044,0.031,0.091,0.05,0.135c0.16,0.387,0.343,0.761,0.534,1.13c0.033,0.065,0.061,0.133,0.095,0.198 c0.184,0.341,0.387,0.669,0.596,0.994c0.056,0.088,0.104,0.181,0.162,0.267c0.207,0.309,0.434,0.603,0.662,0.895 c0.073,0.094,0.138,0.193,0.213,0.285c0.313,0.379,0.641,0.743,0.988,1.09l44.997,44.997C52.322,223.536,56.161,225,60,225 s7.678-1.464,10.606-4.394c5.858-5.858,5.858-15.355,0-21.213L51.213,180z"></path> <path id="XMLID_5_" d="M207.299,42.299c-40.944,0-79.038,20.312-101.903,54.333c-4.62,6.875-2.792,16.195,4.083,20.816 c6.876,4.62,16.195,2.794,20.817-4.083c17.281-25.715,46.067-41.067,77.003-41.067C258.414,72.299,300,113.884,300,165 s-41.586,92.701-92.701,92.701c-30.845,0-59.584-15.283-76.878-40.881c-4.639-6.865-13.961-8.669-20.827-4.032 c-6.864,4.638-8.67,13.962-4.032,20.826c22.881,33.868,60.913,54.087,101.737,54.087C274.956,287.701,330,232.658,330,165 S274.956,42.299,207.299,42.299z"></path> </g> </g></svg>
                    
                </a>
             

                

            </div>
       
        </div>
    </nav>


    <!--	 

Alternatively if you want to just have a single hero

<section class="w-full mx-auto bg-nordic-gray-light flex pt-12 md:pt-0 md:items-center bg-cover bg-right" style="max-width:1600px; height: 32rem; background-image: url('https://images.unsplash.com/photo-1422190441165-ec2956dc9ecc?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1600&q=80');">

	<div class="container mx-auto">

		<div class="flex flex-col w-full lg:w-1/2 justify-center items-start  px-6 tracking-wide">
			<h1 class="text-black text-2xl my-4">Stripy Zig Zag Jigsaw Pillow and Duvet Set</h1>
			<a class="text-xl inline-block no-underline border-b border-gray-600 leading-relaxed hover:text-black hover:border-black" href="#">products</a>

		</div>

	  </div>

</section>

 -->

    <section class="bg-white py-8">

        <div class="container mx-auto flex items-center flex-wrap pt-4 pb-12">

            <nav id="store" class="w-full z-30 top-0 px-6 py-1">
                <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-2 py-3">

                    <a class="uppercase tracking-wide no-underline hover:no-underline font-bold text-gray-800 text-xl " href="#">
				 Boys Prefect
			</a>

              </div>
            </nav>

            <?php
            
            $query = "select * from candidates where position='boys prefect'";

            $query_run = mysqli_query($connection,$query);

            while($getCandidateData = mysqli_fetch_assoc($query_run)){
                ?>
                    <div class="w-full md:w-1/3 xl:w-1/4 p-6 flex flex-col">
                <a href="#">
                    <img class="hover:grow hover:shadow-lg" src="./Admin/uploads/<?php echo $getCandidateData['image'] ?>">
                    <div class="pt-3 flex items-center justify-between">
                        <p class=""><?php echo $getCandidateData['first_name']. ' '. $getCandidateData['last_name'] ?></p>
                       <input type="radio" name="boysPrefect" value="<?php echo $getCandidateData['first_name']. ' '. $getCandidateData['last_name']  ?>" id="boysPrefect">
                    </div>
                   
                </a>
            </div>
                <?php
            }
            
            ?>
        
            </div>
            <!-- ASSIST BOYS PREFECT  -->

             <div class="container mx-auto flex items-center flex-wrap pt-4 pb-12">

            <nav id="store" class="w-full z-30 top-0 px-6 py-1">
                <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-2 py-3">

                    <a class="uppercase tracking-wide no-underline hover:no-underline font-bold text-gray-800 text-xl " href="#">
				Assist Boys Prefect
			</a>

              </div>
            </nav>

            <?php
            
            $query = "select * from candidates where position='assist boys prefect'";

            $query_run = mysqli_query($connection,$query);

            while($getCandidateData = mysqli_fetch_assoc($query_run)){
                ?>
                    <div class="w-full md:w-1/3 xl:w-1/4 p-6 flex flex-col">
                <a href="#">
                    <img class="hover:grow hover:shadow-lg" src="./Admin/uploads/<?php echo $getCandidateData['image'] ?>">
                    <div class="pt-3 flex items-center justify-between">
                        <p class=""><?php echo $getCandidateData['first_name']. ' '. $getCandidateData['last_name'] ?></p>
                       <input type="radio" name="assistboysPrefect" value="<?php echo $getCandidateData['first_name']. ' '. $getCandidateData['last_name']  ?>" id="boysPrefect">
                    </div>
                   
                </a>
            </div>
                <?php
            }
            
            ?>
        
            </div>


            <!-- GIRLS PREFECT -->
            
             <div class="container mx-auto flex items-center flex-wrap pt-4 pb-12">

            <nav id="store" class="w-full z-30 top-0 px-6 py-1">
                <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-2 py-3">

                    <a class="uppercase tracking-wide no-underline hover:no-underline font-bold text-gray-800 text-xl " href="#">
				 Girls Prefect
			</a>

              </div>
            </nav>

            <?php
            
            $query = "select * from candidates where position='girls prefect'";

            $query_run = mysqli_query($connection,$query);

            while($getCandidateData = mysqli_fetch_assoc($query_run)){
                ?>
                    <div class="w-full md:w-1/3 xl:w-1/4 p-6 flex flex-col">
                <a href="#">
                    <img class="hover:grow hover:shadow-lg" src="./Admin/uploads/<?php echo $getCandidateData['image'] ?>">
                    <div class="pt-3 flex items-center justify-between">
                        <p class=""><?php echo $getCandidateData['first_name']. ' '. $getCandidateData['last_name'] ?></p>
                       <input type="radio" name="girlsPrefect" value="<?php echo $getCandidateData['first_name']. ' '. $getCandidateData['last_name']  ?>" id="boysPrefect">
                    </div>
                   
                </a>
            </div>
                <?php
            }
            
            ?>
        
            </div>

            <!-- ASSIST GIRLS PREFECT -->


               <div class="container mx-auto flex items-center flex-wrap pt-4 pb-12">

            <nav id="store" class="w-full z-30 top-0 px-6 py-1">
                <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-2 py-3">

                    <a class="uppercase tracking-wide no-underline hover:no-underline font-bold text-gray-800 text-xl " href="#">
				Assist Girls Prefect
			</a>

              </div>
            </nav>

            <?php
            
            $query = "select * from candidates where position='assist girls prefect'";

            $query_run = mysqli_query($connection,$query);

            while($getCandidateData = mysqli_fetch_assoc($query_run)){
                ?>
                    <div class="w-full md:w-1/3 xl:w-1/4 p-6 flex flex-col">
                <a href="#">
                    <img class="hover:grow hover:shadow-lg" src="./Admin/uploads/<?php echo $getCandidateData['image'] ?>">
                    <div class="pt-3 flex items-center justify-between">
                        <p class=""><?php echo $getCandidateData['first_name']. ' '. $getCandidateData['last_name'] ?></p>
                       <input type="radio" name="assistGirlsPrefect" value="<?php echo $getCandidateData['first_name']. ' '. $getCandidateData['last_name']  ?>" id="boysPrefect">
                    </div>
                   
                </a>
            </div>
                <?php
            }
            
            ?>
        
            </div>







            <div class="text-center">

            <?php
            if(isset($_SESSION['votedAlready'])){

            }
            else{
                ?>
            <button id="btnSubmitVote" type="submit" class="bg-slate-600 text-white rounded-md p-2 hover:bg-slate-900">Submit Vote</button>
                <?php
                
            }
            
            
            ?>
            
  <div class="loading hide h-2">
          
<svg  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto; background: none; display: block; shape-rendering: auto;" width="80px" height="80px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
<g transform="rotate(0 50 50)">
  <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#fe718d">
    <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.9166666666666666s" repeatCount="indefinite"></animate>
  </rect>
</g><g transform="rotate(30 50 50)">
  <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#fe718d">
    <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.8333333333333334s" repeatCount="indefinite"></animate>
  </rect>
</g><g transform="rotate(60 50 50)">
  <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#fe718d">
    <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.75s" repeatCount="indefinite"></animate>
  </rect>
</g><g transform="rotate(90 50 50)">
  <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#fe718d">
    <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.6666666666666666s" repeatCount="indefinite"></animate>
  </rect>
</g><g transform="rotate(120 50 50)">
  <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#fe718d">
    <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.5833333333333334s" repeatCount="indefinite"></animate>
  </rect>
</g><g transform="rotate(150 50 50)">
  <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#fe718d">
    <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.5s" repeatCount="indefinite"></animate>
  </rect>
</g><g transform="rotate(180 50 50)">
  <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#fe718d">
    <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.4166666666666667s" repeatCount="indefinite"></animate>
  </rect>
</g><g transform="rotate(210 50 50)">
  <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#fe718d">
    <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.3333333333333333s" repeatCount="indefinite"></animate>
  </rect>
</g><g transform="rotate(240 50 50)">
  <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#fe718d">
    <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.25s" repeatCount="indefinite"></animate>
  </rect>
</g><g transform="rotate(270 50 50)">
  <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#fe718d">
    <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.16666666666666666s" repeatCount="indefinite"></animate>
  </rect>
</g><g transform="rotate(300 50 50)">
  <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#fe718d">
    <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.08333333333333333s" repeatCount="indefinite"></animate>
  </rect>
</g><g transform="rotate(330 50 50)">
  <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#fe718d">
    <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="0s" repeatCount="indefinite"></animate>
  </rect>
</g>
</svg>

  </div>
             
               
            </div>

    </section>

    <section class="bg-white py-8">

        <div class="container py-8 px-6 mx-auto">

            <a class="uppercase tracking-wide no-underline hover:no-underline font-bold text-gray-800 text-xl mb-8" href="#">
			About
		</a>

            <p class="mt-8 mb-8">This template is inspired by the stunning nordic minamalist design - in particular:
                <br>
                <a class="text-gray-800 underline hover:text-gray-900" href="http://savoy.nordicmade.com/" target="_blank">Savoy Theme</a> created by <a class="text-gray-800 underline hover:text-gray-900" href="https://nordicmade.com/">https://nordicmade.com/</a> and <a class="text-gray-800 underline hover:text-gray-900" href="https://www.metricdesign.no/" target="_blank">https://www.metricdesign.no/</a></p>

            <p class="mb-8">Lorem ipsum dolor sit amet, consectetur <a href="#">random link</a> adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Vel risus commodo viverra maecenas accumsan lacus vel facilisis volutpat. Vitae aliquet nec ullamcorper sit. Nullam eget felis eget nunc lobortis mattis aliquam. In est ante in nibh mauris. Egestas congue quisque egestas diam in. Facilisi nullam vehicula ipsum a arcu. Nec nam aliquam sem et tortor consequat. Eget mi proin sed libero enim sed faucibus turpis in. Hac habitasse platea dictumst quisque. In aliquam sem fringilla ut. Gravida rutrum quisque non tellus orci ac auctor augue mauris. Accumsan lacus vel facilisis volutpat est velit egestas dui id. At tempor commodo ullamcorper a. Volutpat commodo sed egestas egestas fringilla. Vitae congue eu consequat ac.</p>

        </div>

    </section>

    <footer class="container mx-auto bg-white py-8 border-t border-gray-400">
        <div class="container flex px-3 py-8 ">
            <div class="w-full mx-auto flex flex-wrap">
                <div class="flex w-full lg:w-1/2 ">
                    <div class="px-3 md:px-0">
                        <h3 class="font-bold text-gray-900">About</h3>
                        <p class="py-4">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vel mi ut felis tempus commodo nec id erat. Suspendisse consectetur dapibus velit ut lacinia.
                        </p>
                    </div>
                </div>
                <div class="flex w-full lg:w-1/2 lg:justify-end lg:text-right">
                    <div class="px-3 md:px-0">
                        <h3 class="font-bold text-gray-900">Social</h3>
                        <ul class="list-reset items-center pt-3">
                            <li>
                                <a class="inline-block no-underline hover:text-black hover:underline py-1" href="#">Add social links</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.js"></script>

    <script>
        $('#btnSubmitVote').click(()=>{
        //    validation
        setTimeout(() => {
            $('.message').text('');
            
        }, 3000);

            if($("input[name='boysPrefect']:checked").val()){

                if($("input[name='assistboysPrefect']:checked").val()){
                    
                    if($("input[name='girlsPrefect']:checked").val()){

                        if($("input[name='assistGirlsPrefect']:checked").val()){

                            // if every position is not left empty then submit user vote
                            $boysPrefect = $("input[name='boysPrefect']:checked").val();
                            $assistBoys = $("input[name='assistboysPrefect']:checked").val();
                            $GirlsPrefect = $("input[name='girlsPrefect']:checked").val()
                            $assistGirlsPrefect = $("input[name='assistGirlsPrefect']:checked").val()

                                            $('.loading').removeClass('hide');


                                    $.ajax({


                                        method:'post',
                                        url:'user-vote.php',
                                        data:{'valid':true, 'boysPrefect':$boysPrefect,'assitBoysPrefect':$assistBoys,'girlsPrefect':$GirlsPrefect,'assistGirlsPrefect':$assistGirlsPrefect},
                                        success:((response)=>{
                                            if(response.data = 'success'){
                                                $('.message').addClass('text-lime-900');
                                                $('.message').addClass('p-4');
                                                setTimeout(() => {
                                                    
                                                    window.scrollTo(0,0);
                                                    $('.message').text('Your vote has been casted');
                                                    $('.loading').addClass('hide');
                                                    $('#btnSubmitVote').addClass('hide');
                                                }, 3000);
                                            
                                            }
                                            else{
                                                $('.message').addClass('text-red-600');
                                                $('.message').addClass('p-4');
                                                $('.message').text('something went wrong, try again ....');
                                                
                                            }
                                        })
                                    })

                        }
                        else{
                            window.scrollTo(0,0)
                    $('.message').addClass('text-red-600');
                    $('.message').addClass('text-2xl');
                    $('.message').addClass('p-4');
                    $('.message').text('select a  candidate for  assist Girls prefect');
                    

                        }

                    }
                    else{
                        window.scrollTo(0,0)
                    $('.message').addClass('text-red-600');
                    $('.message').addClass('text-2xl');
                    $('.message').addClass('p-4');
                    $('.message').text('select a  candidate for  Girls prefect');
                    

                    }
                    
                }
                else{
                    window.scrollTo(0,0)
                    $('.message').addClass('text-red-600');
                    $('.message').addClass('text-2xl');
                    $('.message').addClass('p-4');
                    $('.message').text('select a  candidate for assist boys prefect');
                    
                    
                }
            }
            else{
                window.scrollTo(0,0)
             $('.message').addClass('text-red-600');
         $('.message').addClass('text-2xl');
         $('.message').addClass('p-4');
         $('.message').text('select a  candidate for boys prefect');
         
          

         }




//         if($("input[name='boysPrefect']:checked").val()){
//           $data = $("input[name='boysPrefect']:checked").val()

//                       $('.loading').removeClass('hide');


//             $.ajax({


//                 method:'post',
//                 url:'user-vote.php',
//                 data:{'valid':true, 'voted_for':$data},
//                 success:((response)=>{
//                     if(response.data = 'success'){
//                         $('.message').addClass('text-lime-900');
//                         $('.message').addClass('p-4');
//                         $('.message').text('Your vote has been casted');
//                         $('#btnSubmitVote').addClass('hide');
                      
//                     }
//                     else{
//                         $('.message').addClass('text-red-600');
//                         $('.message').addClass('p-4');
//                         $('.message').text('something went wrong, try again ....');
                        
//                     }
//                 })
//             })
            
//         }else if($('input[name="assistboysprefect"]:checked').val()){

//         }
//         else{
//             $('.message').addClass('text-red-600');
//             $('.message').addClass('text-2xl');
//             $('.message').addClass('p-4');
//             $('.message').text('select a  candidate');
  
// }
        })
    </script>

</body>

</html>
