<?php 
include_once('./db-config.php');

$msg = '';
error_reporting(0);

$id = $_GET['id'];

if(isset($_POST['btnUpdateCandidate'])){
    
    $firstName = $_POST['editfirstName'];
    $lastName = $_POST['editlastName'];
    $email = $_POST['editEmailAddress'];
    $position = $_POST['editPosition'];
    $about = $_POST['editAbout'];
    $candidateImage = $_FILES['editCandidateImage']['name'];
    $temp_name  = $_FILES['editCandidateImage']['tmp_name'];
    $target_dir = 'uploads/';
    $targetfile = $target_dir .$candidateImage;


    // check if the fields are not empty

    if(empty($firstName)){
        $msg = '<div class="text-red-600 text-2xl py-2">First name is empty</div>';
    }
    else if(empty($lastName)){
        $msg = '<div class="text-red-600 text-2xl py-2">last name is empty</div>';

    }
    else if(empty($email)){
        $msg = '<div class="text-red-600 text-2xl py-2">email is empty</div>';

    }
    else if(empty($about)){
        $msg = '<div class="text-red-600 text-2xl py-2">about is empty</div>';

    }
    else if($position == '0'){
        $msg = '<div class="text-red-600 text-2xl py-2">Select a position for the candidate</div>';

    }
    
    // else if($candidateImage == 0){
    //     $msg = '<div class="text-red-600 text-2xl py-2">Select an image for the candidate</div>';


    // }
    else{


        if($candidateImage > 0){
            
             $date = date ('Y-m-d H:i:s');
                     $query = "update candidates  set first_name='$firstName',last_name='$lastName',email='$email',about='$about',position='$position',image='$candidateImage',updated_at='$date' where id='$id'";
                     $query_run = mysqli_query($connection,$query);
     
                     if($query_run){
                         move_uploaded_file($temp_name,$targetfile);
                         $msg = 'candidate added successfully';
                         // $_POST['first-name'] = '';
                         // $_POST['last-name'] = '';
                         // $_POST['email-address'] = '';
                         // $_POST['about'] = '';
                         // $_POST['position'] = '0';
                     }
                     else{
                         $msg ='something went wrong';
                     }

        }
        else{
            $date = date ('Y-m-d H:i:s');
            $query = "update candidates  set first_name='$firstName',last_NAME='$lastName',email='$email',about='$about',position='$position',updated_at='$date' where id='$id";
            $query_run = mysqli_query($connection,$query);

            if($query_run){
                move_uploaded_file($temp_name,$targetfile);
                $msg = 'candidate added successfully';
                // $_POST['first-name'] = '';
                // $_POST['last-name'] = '';
                // $_POST['email-address'] = '';
                // $_POST['about'] = '';
                // $_POST['position'] = '0';
            }
            else{
                $msg ='something went wrong';
            }

        }

            


            
        

    }
   

}




?>


<?php include 'includes/header.php' ?>
<!-- content -->

<main>

    <div class="flex flex-col md:flex-row">
        <!-- sidebar -->
        <?php include 'includes/sidebar.php' ?>
        <section>
            <div id="main" class="main-content flex-1 bg-gray-100 mt-12 md:mt-2 pb-24 md:pb-5">

                <div class="bg-gray-800 pt-3">
                    <div class="rounded-tl-3xl bg-gradient-to-r from-blue-900 to-gray-800 p-4 shadow text-2xl text-white">
                        <h1 class="font-bold pl-2">Candidates</h1>
                    </div>
                </div>

                <div class="flex flex-wrap">
                    <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                        <!--Metric Card-->
                        <div class="bg-gradient-to-b from-green-200 to-green-100 border-b-4 border-green-600 rounded-lg shadow-xl p-5">
                            <div class="flex flex-row items-center">
                                <div class="flex-shrink pr-4">
                                    <div class="rounded-full p-5 bg-green-600"><i class="fa fa-wallet fa-2x fa-inverse"></i></div>
                                </div>
                                <a href="candidates">
                                <div class="flex-1 text-right md:text-center">
                                    <!-- <h2 class="font-bold uppercase text-gray-600"></h2> -->
                                   <p class="font-bold text-3xl">Total Candidates <span class="text-green-500"><i class="fas fa-caret-up"></i></span></p>
                                </div>
                                </a>
                            </div>
                        </div>
                        <!--/Metric Card-->
                    </div>
                    <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                        <!--Metric Card-->
                        <div class="bg-gradient-to-b from-pink-200 to-pink-100 border-b-4 border-pink-500 rounded-lg shadow-xl p-5">
                            <div class="flex flex-row items-center">
                                <div class="flex-shrink pr-4">
                                    <div class="rounded-full p-5 bg-pink-600"><i class="fas fa-users fa-2x fa-inverse"></i></div>
                                </div>
                                <div class="flex-1 text-right md:text-center">
                                    <h2 class="font-bold uppercase text-gray-600">Total Voters</h2>
                                    <p class="font-bold text-3xl">249 <span class="text-pink-500"><i class="fas fa-exchange-alt"></i></span></p>
                                </div>
                            </div>
                        </div>
                        <!--/Metric Card-->
                    </div>
                    <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                        <!--Metric Card-->
                        <div class="bg-gradient-to-b from-yellow-200 to-yellow-100 border-b-4 border-yellow-600 rounded-lg shadow-xl p-5">
                            <div class="flex flex-row items-center">
                                <div class="flex-shrink pr-4">
                                    <div class="rounded-full p-5 bg-yellow-600"><i class="fas fa-user-plus fa-2x fa-inverse"></i></div>
                                </div>
                                <div class="flex-1 text-right md:text-center">
                                    <h2 class="font-bold uppercase text-gray-600">Votes</h2>
                                    <p class="font-bold text-3xl">2 <span class="text-yellow-600"><i class="fas fa-caret-up"></i></span></p>
                                </div>
                            </div>
                        </div>
                        <!--/Metric Card-->
                    </div>
                    <!-- <div class="w-full md:w-1/2 xl:w-1/3 p-6"> -->
                        <!--Metric Card-->
                        <!-- <div class="bg-gradient-to-b from-blue-200 to-blue-100 border-b-4 border-blue-500 rounded-lg shadow-xl p-5">
                            <div class="flex flex-row items-center">
                                <div class="flex-shrink pr-4">
                                    <div class="rounded-full p-5 bg-blue-600"><i class="fas fa-server fa-2x fa-inverse"></i></div>
                                </div>
                                <div class="flex-1 text-right md:text-center">
                                    <h2 class="font-bold uppercase text-gray-600">Server Uptime</h2>
                                    <p class="font-bold text-3xl">152 days</p>
                                </div>
                          nt-to-b from-red-200 to-red-100 border-b-4 border-red-500 rounded-lg shadow-xl p-5">
                            <div class="flex flex-row items-center">
                                <div class="flex-shrink pr-4">
                                    <div class="rounded-full p-5 bg-red-600"><i class="fas fa-inbox fa-2x fa-inverse"></i></div>
                                </div>
                                <div class="flex-1 text-right md:text-center">
                                    <h2 class="font-bold uppercase text-gray-600">Issues</h2>
                                    <p class="font-bold text-3xl">3 <span class="text-red-500"><i class="fas fa-caret-up"></i></span></p>
                                </div>
                            </div>
                        </div> -->
                        <!--/Metric Card-->
                    <!-- </div> -->
                </div>


                <div class="flex flex-row flex-wrap flex-grow ">
                    <!-- candidates table -->
                    <div class="w-full ">
                        <!--
  This example requires some changes to your config:
  
  ```
  // tailwind.config.js
  module.exports = {
    // ...
    plugins: [
      // ...
      require('@tailwindcss/forms'),
    ],
  }
  ```
-->


<!-- fetch candidate data -->
<?php

$id = $_GET['id'];

$query = "select * from candidates where id = '$id'";

$query_run = mysqli_query($connection,$query);

while($fetchData = mysqli_fetch_assoc($query_run)){
    $candidateFirstName = $fetchData['first_name'];
    $candidateLastName = $fetchData['last_name'];
    $candidateEmail = $fetchData['email'];
    $candidatePhoto = $fetchData['image'];
    $candidateAbout = $fetchData['about'];
    $candidatePosition = $fetchData['position'];

}
?>





<div>
  <div class="md:grid md:grid-cols-6 md:gap-4">
    <!-- <div class="md:col-start-2 col-span-4">
     
    </div> -->
    <div class="mt-5 md:col-start-2 md:col-span-4 md:mt-0">
       <div class="text-center"> <?php echo $msg ?></div>
      <form action="" method="POST" enctype="multipart/form-data">
        <div class="shadow sm:overflow-hidden sm:rounded-md">
          <div class="space-y-6 bg-white px-4 py-5 sm:p-6">
                <!-- third info -->
                <div class="overflow-hidden  sm:rounded-md">
          <div class=" px-4 py-5 sm:p-6">
            <div class="grid grid-cols-6 gap-6">
              <div class="col-span-6 sm:col-span-3">
                <label for="editfirstName" class="block text-sm font-medium text-gray-700">First name</label>
                <input type="text" name="editfirstName" id="editfirstName" value="<?php echo $candidateFirstName ?>" autocomplete="given-name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2">
              </div>

              <div class="col-span-6 sm:col-span-3">
                <label for="editlastName" class="block text-sm font-medium text-gray-700">Last name</label>
                <input type="text" name="editlastName" id="editlastName" value="<?php echo $candidateLastName?>" autocomplete="family-name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2">
              </div>

              <div class="col-span-6 sm:col-span-4">
                <label for="editEmailAddress" class="block text-sm font-medium text-gray-700">Email address</label>
                <input type="text" name="editEmailAddress" id="editEmailAddress" value="<?php echo $candidateEmail ?>" autocomplete="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2">
              </div>

             

            
            </div>
          </div>
         
        </div>
           

            <div>
              <label for="editAbout" class="block text-sm font-medium text-gray-700">About</label>
              <div class="mt-1">
                <textarea id="editAbout" name="editAbout" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="you@example.com"><?php echo $candidateAbout?></textarea>
              </div>
              <!-- <p class="mt-2 text-sm text-gray-500">Brief description for your profile. </p> -->
            </div>

            <div class="col-span-6 sm:col-span-3">
                <label for="editPosition" class="block text-sm font-medium text-gray-700">Position</label>
                <select id="editPosition"  name="editPosition" autocomplete="position" class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                <option value="<?php echo $candidatePosition ?>"><?php echo $candidatePosition ?></option>
                <option value="Boys prefect" <?php if($_POST['editPosition'] == 'Boys prefect') echo 'selected="selected"'; ?>>Boys prefect</option>
                 <option value="Assist Boys Prefect"  <?php if($_POST['editPosition'] == 'Assist Boys Prefect') echo 'selected="selected"'; ?>>Assist Boys Prefect</option>
                 <option value="Girls Prefect" <?php if($_POST['editPosition'] == 'Girls Prefect') echo 'selected="selected"'; ?>>Girls Prefect</option>
                 <option value="Assist Girls Prefect" <?php if($_POST['editPosition'] == 'Assist Girls Prefect') echo 'selected="selected"'; ?>>Assist Girls Prefect</option>
                 <option value="Compound Prefect" <?php if($_POST['editPosition'] == 'Compound Prefect') echo 'selected="selected"'; ?>>Compound Prefect</option>
                 <option value="Assist Compound Prefect" <?php if($_POST['editPosition'] == 'Assist Compound Prefect') echo 'selected="selected"'; ?>>Assist Compound Prefect</option>
                 <option value="Dinning boys  Prefect" <?php if($_POST['editPosition'] == 'Dinning boys  Prefect') echo 'selected="selected"'; ?>>Dinning Boys Prefect</option>
                 <option value="Assist Dinning Boys Prefect" <?php if($_POST['editPosition'] == 'Assist Dinning Boys Prefect') echo 'selected="selected"'; ?>>Assist Dinning Boys Prefect</option>
                 <option value="Dinning Girls Prefect" <?php if($_POST['editPosition'] == 'Dinning Girls Prefect') echo 'selected="selected"'; ?>>Dinning Girls Prefect</option>
                 <option value="Assist Dinning Girls Prefect" <?php if($_POST['editPosition'] == 'Assist Dinning Girls Prefect') echo 'selected="selected"'; ?>>Assist Dinning Girls Prefect</option>
                 <option value="Chaplin Boys Prefect" <?php if($_POST['editPosition'] == 'Chaplin Boys Prefect') echo 'selected="selected"'; ?>>Chaplin Boys Prefect</option>
                 <option value="Assist Chaplin Boys Prefect" <?php if($_POST['editPosition'] == 'Assist Chaplin Boys Prefect') echo 'selected="selected"'; ?>>Assist Chaplin Boys Prefect</option>
                 <option value="Chaplin Girls Prefect" <?php if($_POST['editPosition'] == 'Chaplin Girls Prefect') echo 'selected="selected"'; ?>>Chaplin Girls Prefect</option>
                 <option value="Assist Chaplin Girls Prefect" <?php if($_POST['editPosition'] == 'Assist Chaplin Girls Prefect') echo 'selected="selected"'; ?>>Assist Chaplin Girls Prefect</option>
                 <option value="Entertainment Prefect Boys" <?php if($_POST['editPosition'] == 'Entertainment Prefect Boys') echo 'selected="selected"'; ?>>Entertainment Prefect Boys</option>
                 <option value="Assist Entertainment Prefect Boys" <?php if($_POST['editPosition'] == 'Assist Entertainment Prefect Boys') echo 'selected="selected"'; ?>>Assist Entertainment Prefect Boys</option>
                 <option value="Entertainment Prefect Girls" <?php if($_POST['editPosition'] == 'Entertainment Prefect Girls') echo 'selected="selected"'; ?>>Entertainment Prefect Girls</option>
                </select>
              </div>
                
              <div>
              <label for="photo" class="block text-sm font-medium text-gray-700">Candidate Image </label>
              <div class="mt-1">
                <img class="w-32 h-32 rounded-full" src="./uploads/<?php echo  $candidatePhoto ?>" alt="">

                <!-- <textarea id="about" name="about" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="you@example.com"><?php echo $candidateAbout?></textarea> -->
              </div>
              <!-- <p class="mt-2 text-sm text-gray-500">Brief description for your profile. </p> -->
            </div>
              
            <div>
            <label for="editCandidateImage" class="block text-sm font-medium text-gray-700">Upload Photo </label>

            <input type="file" name="editCandidateImage" class="dropify" data-max-file-size="3M" 
            ata-show-errors="true" data-errors-position="outside" data-allowed-file-extensions="jpg png">
            <p class="text-xs text-gray-500 text-center">PNG, JPG  up to 3MB</p>
        
          </div>
          <div class="bg-gray-50 px-4 py-3 text-center sm:px-6">
            <button type="submit" name="btnUpdateCandidate" class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Update Candidate</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="hidden sm:block" aria-hidden="true">
  <div class="py-5">
    <div class="border-t border-gray-200"></div>
  </div>
</div>







                    </div>
                    

                    <!-- candidates table ends here -->





                <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                
                </div>

                <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                  
                </div>

               

               
              

          


                </div>
            </div>
        </section>
    </div>
</main>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
<script>
    $('.dropify').dropify();
</script>

<?php include 'includes/footer.php' ?>


