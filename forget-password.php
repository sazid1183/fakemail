<?php
session_start();
?>
    <!doctype html>
    <html lang="en">
      <head>
        <title>Forget Passwood</title>
        <link rel="shortcut icon" type="x-icon" href="icon.ico">
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
        <!-- Bootstrap CSS v5.2.0-beta1 -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"  integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    
      </head>
      <body>

<?php
$connection = mysqli_connect("localhost", "root", "", "mail");
if(isset($_POST['email_getted'])){

  $login_email = $_POST['login_email'];
  $_SESSION['f_email_f'] = $login_email;
  
  $check_sql = "SELECT * FROM `users` WHERE `email_add` = '{$login_email}'";
  $final_check_sql = mysqli_query($connection, $check_sql);
  $count_user = mysqli_num_rows($final_check_sql);
  if($count_user > 0){
    $last_otp = rand(111111,999999);
    $row = mysqli_fetch_assoc($final_check_sql);
    $recovery_email = "{$row['rec_email']}";
    if($recovery_email == ""){
      header("location: forget-password?invalid_rec_email");
    }else{
      $recovery_email_1st_step = explode('@', $recovery_email);
      $rec_email_host = end($recovery_email_1st_step);


       if($rec_email_host != "fakemail.com"){
             $mm_to = $recovery_email;
             $mm_subject = "Forgotten Passowrd in Fakemail";
             $mm_body = "
             <html>
             <body>
             <h4 style='text-align: center;'>".$login_email." Forget her Fakemail passowrd</strong></h3>
             <h3 style='text-align: center;'>Your OTP is <strong>".$last_otp."</strong></h3>
             </body>
             </html>";
             include 'mail-smtp.php';
             
   
                ?>
   
         
             <div class="row mx-5 d-flex justify-content-center align-items-center" style="min-height: 150mm">
              
             <form action="forget-password" method="post" class="shadow py-3" style="max-width: 200mm">
             <h3 class="text-primary text-center">Forget Password</h3>
               <div class="mb-3 row">
   <div class="mb-3">
     <label for="" class="form-label">OTP</label>
     <input type="number"
       class="form-control" name="rec_email_otp" id="" aria-describedby="helpId" placeholder="">
     <small id="helpId" class="form-text text-muted">We sended a email form fakemail83@gmail.com . Check inbox and spam</small>
   </div>
   
   
   </div>
   <input type="hidden" name="last_otp_2" value="<?php echo $last_otp; ?>">
   <input type="hidden" name="rec_email" value="<?php echo $recovery_email; ?>">
   <button type="submit" class="btn btn-primary d-block m-auto my-3" name="add_this_in_rec_otp">Submit</button>
   
   
   
             </form>
   
             </div>
   
   
   
   <?php
             
   
       
   }else{
   
     $mm_subject = "Forgotten Passowrd in Fakemail";
     $mm_body_1 = "
     <html>
     <body>
     <h4 style='text-align: center;'>".$login_email." Forget her Fakemail passowrd</strong></h3>
     <h3 style='text-align: center;'>Your OTP is <strong>".$last_otp."</strong></h3>
     </body>
     </html>";
     $mm_body = addslashes($mm_body_1);
   
     $adan_rec_email = "SELECT * FROM `users` WHERE `email_add` = '$recovery_email'";
     $final_adan_rec_email = mysqli_query($connection, $adan_rec_email);
     $rec_row = mysqli_fetch_assoc($final_adan_rec_email);
     $rec_email_timezone = "{$rec_row['timezone']}";
   
   
     date_default_timezone_set($rec_email_timezone);
     $rec_date = date("d:m:y");
     $rec_time = date("g:i a");
     $to_from = "fakemail.com";
   
     $give_otp_db = "INSERT INTO `$recovery_email` (`to_from`, `subject`, `description`, `date`, `time`, `action`) VALUES ('$to_from', '$mm_subject', '$mm_body', '$rec_date', '$rec_time', 'inbox')";
     $final_give_otp_db = mysqli_query($connection, $give_otp_db);
     if($final_give_otp_db){
      ?>
      <div class="row mx-5 d-flex justify-content-center align-items-center" style="min-height: 150mm">
              
             <form action="forget-password" method="post" class="shadow py-3" style="max-width: 200mm">
             <h3 class="text-primary text-center">Forget Password</h3>
               <div class="mb-3 row">
   <div class="mb-3">
     <label for="" class="form-label">OTP</label>
     <input type="number"
       class="form-control" name="rec_email_otp" id="" aria-describedby="helpId" placeholder="">
     <small id="helpId" class="form-text text-muted">We sended a email form fakemail.com. Check inbox and spam</small>
   </div>
   
   
   </div>
   <input type="hidden" name="last_otp_2" value="<?php echo $last_otp; ?>">
   <input type="hidden" name="rec_email" value="<?php echo $recovery_email; ?>">
   <button type="submit" class="btn btn-primary d-block m-auto my-3" name="add_this_in_rec_otp">Submit</button>
   
   
   
             </form>
   
             </div>


<?php
     }else{
       echo "Cannot send";
     }




    }

    // END of if he has recovery  email
  }
  // if he has a id
  }else{
    header("location: forget-password?address_error");
  }




// If not Submitted
// Sending mail endindh
}elseif(isset($_POST['add_this_in_rec_otp'])){
  // if isset otp
  $last_otp = $_POST['last_otp_2'];
   $recovery_email = $_POST['rec_email'];
   $getted_otp = $_POST['rec_email_otp'];
   if($getted_otp == $last_otp){
    ?>
    <div class="row mx-5 d-flex justify-content-center align-items-center" style="min-height: 150mm">
           
    <form action="forget-password" method="post" class="shadow py-3" style="max-width: 200mm">
    <h3 class="text-primary text-center">Forget password</h3>
    <div class="mb-3">
      <label for="" class="form-label">New Password</label>
      <input type="text"
        class="form-control" name="passowrd" id="" aria-describedby="helpId" placeholder="" value="">
     
    </div>

    <div class="mb-3">
      <label for="" class="form-label">Confirm Password</label>
      <input type="text"
        class="form-control" name="confirmed_password" id="" aria-describedby="helpId" placeholder="" value="">
    </div>

    <button type="submit" class="btn btn-primary d-block mx-auto" name="submitted_nre_passoword">Submit</button>
    <?php
  }else{
    header("location: forget-password?incorrect_otp");
   }


  
}elseif(isset($_POST['submitted_nre_passoword'])){
$password = $_POST['passowrd'];
$confirmed_password = $_POST['confirmed_password'];
$user_email = $_SESSION['f_email_f'];
if($password == $confirmed_password){
   $sql_prodan_password = "UPDATE `users` SET `password` = '{$password}' WHERE `email_add` = '{$user_email}'";
   $final_sql_prodan = mysqli_query($connection, $sql_prodan_password);
   if ($final_sql_prodan) {
    $_SESSION['session_email'] = $user_email;
    $_SESSION['session_password'] = $password;
    header("location: login");
   }else{
    echo "error";
   }
}else{
  header("location: forget-password?p_not_match");
}

}else{
    ?>
    
          <div class="row mx-5 d-flex justify-content-center align-items-center" style="min-height: 150mm">
           
          <form action="forget-password" method="post" class="shadow py-3" style="max-width: 200mm">
          <h3 class="text-primary text-center">Forget password</h3>
          <div class="mb-3">
            <label for="" class="form-label">Enter Your email address</label>
            <input type="text"
              class="form-control" name="login_email" id="" aria-describedby="helpId" placeholder="" value="">
           
          </div>
    <?php
          if(isset($_GET['address_error'])){
            echo "<p class='text-center text-danger'>This email is not registered</p>";
          }elseif(isset($_GET['invalid_rec_email'])){
            echo "<p class='text-center text-danger'>You have not added any recovery email. So that you cannot recover your id now.</p>";
          }elseif(isset($_GET['incorrect_otp'])){
            echo "<p class='text-center text-danger'>Incorrect OTP. Redo all</p>";
          }elseif(isset($_GET['p_not_match'])){
            echo "<p class='text-center text-danger'>New password not mathed with confirm password.</p>";
          }else{}
    ?>     
        <button type="submit" class="btn btn-primary d-block m-auto my-3" name="email_getted">Submit</button>
        
            
          
    
    
    
          </form>
    
          </div>
    
    
    
    
    
    
    
    
    


<?php
}
?>
          <?php
        include 'footer1.php';
        ?>
        <!-- Bootstrap JavaScript Libraries -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
      </body>
    </html>