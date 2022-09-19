<?php
session_start();

if(isset($_POST['login_it'])){
    $login_email = $_POST['login_email'];
    $login_password = $_POST['login_password'];
    $connection = mysqli_connect("localhost", "root", "", "mail");
    $adan = "SELECT * FROM `users` WHERE `email_add` = '$login_email' AND `password` = '$login_password'";
    $final_adan = mysqli_query($connection, $adan);
    $count = mysqli_num_rows($final_adan);
        if($count == 1){
            $row = mysqli_fetch_assoc($final_adan);
                $email_add = "{$row['email_add']}"; 
                $user_id = "{$row['user_id']}";
                $name = "{$row['name']}";
                $country = "{$row['country']}";
                $timezone = "{$row['timezone']}";
                $rec_email = "{$row['rec_email']}";
                $password = "{$row['password']}";

            $_SESSION['its_logined'] = "fakemail.com";
            $_SESSION['session_email'] = $email_add;
            $_SESSION['session_dbid'] = $user_id;
            $_SESSION['session_name'] = $name;
            $_SESSION['session_country'] = $country;
            $_SESSION['session_timezone'] = $timezone;
            $_SESSION['session_rec_email'] = $rec_email;
            $_SESSION['session_password'] = $password;

              header("location: home");


            
        }else{
          header("location: login?wrongp");
        }
}else{


if(isset($_SESSION['session_email'])){
    $session_email = $_SESSION['session_email'];
    $session_password = $_SESSION['session_password'];
}else{
    $session_email = "";
    $session_password = "";
}
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Login to Fakemail</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <link rel="shortcut icon" type="x-icon" href="icon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.0-beta1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"  integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

  </head>
  <body>
      <div class="row mx-5 d-flex justify-content-center align-items-center" style="min-height: 150mm">
       
      <form action="login" method="post" class="shadow py-3" style="max-width: 200mm">
      <div class="d-flex flex-column align-items-center">
   <img src="logo.png" alt="logo" class="float-center" width="70mm">
   <h3 class="text-primary">Login to Fakemail</h3>
   </div>
      <div class="mb-3">
        <label for="" class="form-label">Email</label>
        <input type="text"
          class="form-control" name="login_email" id="" aria-describedby="helpId" placeholder="" value="<?php echo $session_email; ?>">
       
      </div>
      <div class="mb-3">
        <label for="" class="form-label">Password</label>
        <input type="password"
          class="form-control" name="login_password" id="" aria-describedby="helpId" placeholder="" value="<?php echo $session_password; ?>">
       
      </div>
<?php
      if(isset($_GET['wrongp'])){
        echo "<p class='text-center text-danger'>Invalid username or password</p>";
      }else{}
?>     
    <button type="submit" class="btn btn-primary d-block m-auto my-3" name="login_it">Submit</button>
    <div class="col-12 d-flex justify-content-around">
    <a href="signup" class="text-decoration-none text-primary">Create account</a>
    <a href="forget-password" class="text-decoration-none text-muted">Forget Password?</a>
    </div>
    
        
      



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
}
?>