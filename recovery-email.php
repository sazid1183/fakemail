<?php
session_start();

if(isset($_SESSION['session_email'])){
  ?>
                <!doctype html>
    <html lang="en">
      <head>
        <title>Recovery Email</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
        <!-- Bootstrap CSS v5.2.0-beta1 -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"  integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <link rel="shortcut icon" type="x-icon" href="icon.ico">
      </head>
      <body>
      <?php
      $connection = mysqli_connect("localhost", "root", "", "mail");
if(isset($_POST['add_this_in_rec'])){
$rec_email = $_POST['rec_email'];
$fakemail = $_SESSION['session_email'];
$password = $_SESSION['session_password'];

$last_otp = rand(111111,999999);


    $rec_email_host_1st_step = explode('@', $rec_email);
    $rec_email_host = end($rec_email_host_1st_step);

    if($rec_email == $fakemail){
     header("location: recovery-email.php?need_other");
    }elseif($rec_email_host != "fakemail.com"){
          $mm_to = $rec_email;
          $mm_subject = "Request for Recovery email in Fakemail";
          $mm_body = "
          <html>
          <body>
          <h4 style='text-align: center;'>".$fakemail." want to make you recovery email</strong></h3>
          <h3 style='text-align: center;'>Your OTP is <strong>".$last_otp."</strong></h3>
          </body>
          </html>";
          include 'mail-smtp.php';
          

             ?>

      
          <div class="row mx-5 d-flex justify-content-center align-items-center" style="min-height: 150mm">
           
          <form action="recovery-email" method="post" class="shadow py-3" style="max-width: 200mm">
          <h3 class="text-primary text-center">Add recovery email</h3>
            <div class="mb-3 row">
<div class="mb-3">
  <label for="" class="form-label">OTP</label>
  <input type="number"
    class="form-control" name="rec_email_otp" id="" aria-describedby="helpId" placeholder="">
  <small id="helpId" class="form-text text-muted">We sended a email form fakemail83@gmail.com . Check inbox and spam</small>
</div>


</div>
<input type="hidden" name="last_otp_2" value="<?php echo $last_otp; ?>">
<input type="hidden" name="rec_email" value="<?php echo $rec_email; ?>">
<button type="submit" class="btn btn-primary d-block m-auto my-3" name="add_this_in_rec_otp">Submit</button>



          </form>

          </div>



<?php
          

    
}else{

  $mm_subject = "Request for Recovery email in Fakemail";
  $mm_body_1 = "
  <html>
  <body>
  <h4 style='text-align: center;'>".$fakemail." want to make you recovery email</strong></h3>
  <h3 style='text-align: center;'>Your OTP is <strong>".$last_otp."</strong></h3>
  </body>
  </html>";
  $mm_body = addslashes($mm_body_1);

  $adan_rec_email = "SELECT * FROM `users` WHERE `email_add` = '$rec_email'";
  $final_adan_rec_email = mysqli_query($connection, $adan_rec_email);
  $rec_row = mysqli_fetch_assoc($final_adan_rec_email);
  $rec_email_timezone = "{$rec_row['timezone']}";


  date_default_timezone_set($rec_email_timezone);
  $rec_date = date("d:m:y");
  $rec_time = date("g:i a");
  $to_from = "fakemail.com";

  $give_otp_db = "INSERT INTO `$rec_email` (`to_from`, `subject`, `description`, `date`, `time`) VALUES ('$to_from', '$mm_subject', '$mm_body', '$rec_date', '$rec_time')";
  $final_give_otp_db = mysqli_query($connection, $give_otp_db);
  if($final_give_otp_db){

  }else{
    echo "Cannot send";
  }

  ?>

      
          <div class="row mx-5 d-flex justify-content-center align-items-center" style="min-height: 150mm">
           
          <form action="recovery-email" method="post" class="shadow py-3" style="max-width: 200mm">
          <h3 class="text-primary text-center">Add recovery email</h3>
            <div class="mb-3 row">
<div class="mb-3">
  <label for="" class="form-label">OTP</label>
  <input type="number"
    class="form-control" name="rec_email_otp" id="" aria-describedby="helpId" placeholder="">
  <small id="helpId" class="form-text text-muted">We sended a email form fakemailcom . Check inbox</small>
</div>


</div>
<input type="hidden" name="last_otp_2" value="<?php echo $last_otp; ?>">
<input type="hidden" name="rec_email" value="<?php echo $rec_email; ?>">
<button type="submit" class="btn btn-primary d-block m-auto my-3" name="add_this_in_rec_otp">Submit</button>



          </form>

          </div>



<?php

}

    }elseif(isset($_POST['add_this_in_rec_otp'])){
      $getted_otp = $_POST['rec_email_otp'];
      $last_otp = $_POST['last_otp_2'];
      $rec_email = $_POST['rec_email'];
      $fakemail = $_SESSION['session_email'];
      $password = $_SESSION['session_password'];

      if($getted_otp == $last_otp){

                    $prodan_update = "UPDATE `users` SET `rec_email` = '$rec_email' WHERE `email_add` = '$fakemail' AND `password` = '$password'";
                      $final_prodan_update = mysqli_query($connection, $prodan_update);
                      if($final_prodan_update){
                        ?>
                       <div class="d-flex justify-content-center align-items-center flex-column" style="min-height: 120mm; min-width: 100%;">
            <a class="h4 btn btn-primary  text-white p-3 rounded-5" href="login">Go to login page</a>

          </div>  

<?php
                           
                      }else{}


      }else{
        header("location: recovery-email?wrong_otp");
      }
    }else{



    ?>
          <div class="row mx-5 d-flex justify-content-center align-items-center" style="min-height: 150mm">
           
          <form action="recovery-email" method="post" class="shadow py-3" style="max-width: 200mm">
          <h3 class="text-primary text-center">Add recovery email</h3>
            <div class="mb-3 row">
<div class="mb-3">
  <label for="" class="form-label">Recovery email address</label>
  <input type="text"
    class="form-control" name="rec_email" id="" aria-describedby="helpId" placeholder="">
  <small id="helpId" class="form-text text-muted">You can select a gmail, yahoo, e.t.c account here</small><br>
  <small id="helpId" class="form-text text-muted">We will not share it with anyone</small>
</div>


</div>
<?php
if(isset($_REQUEST['wrong_otp'])){
  echo "<p class='text-center text-danger'>You Entered wrong OTP. Reconfirm your email.</p>";
}elseif(isset($_GET['need_other'])){
  echo "<p class='text-center text-danger'>You need to use another email</p>";
}else{}

?>
<button type="submit" class="btn btn-primary d-block m-auto my-3" name="add_this_in_rec">Submit</button>



          </form>

          </div>









          <?php
        include 'footer1.php';
        ?>
        <!-- Bootstrap JavaScript Libraries -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
      </body>
    </html>


          <?php
        include 'footer1.php';
        ?>
        <!-- Bootstrap JavaScript Libraries -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
      </body>
    </html>
    <?php
    }
}else{
    echo "you have not registered or logined";
    
}
?>

