<?php
session_start();
if(isset($_POST['register_it'])){
$f_name = $_POST['f_name'];
$l_name = $_POST['l_name'];
$mob_no = $_POST['mob_no'];
$country = $_POST['country'];
$email_add = $_POST['email_add'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$full_email = $email_add."@fakemail.com";
$full_name = $f_name." ".$l_name;
// Connnection---------------------------------------------------------------------------------------------------------------------------------------------------
$connection = mysqli_connect("localhost", "root", "", "mail");


if($password != $confirm_password){
    header("location: signup?p_m");
}else{
   $table_query = "SELECT * FROM `users` WHERE `email_add` = '$full_email'";
   $final_table_query = mysqli_query($connection, $table_query);
   $count_table_query = mysqli_num_rows($final_table_query);
   if($count_table_query > 0){
    header("location: signup?username");
   }else{



// $timezone = 
if($country == "Bangladesh"){
    $timezone = "Asia/Dhaka";
}elseif($country == "India"){
    $timezone = "Asia/Kolkata";
}elseif($country == "America"){
    $timezone = "America/New_York";
}else{
    $timezone = "America/New_York";
}




$query = "CREATE TABLE `$full_email` (
    `mail_id` int(11) NOT NULL AUTO_INCREMENT,
    `to_from` varchar(255) NOT NULL,
    `subject` varchar(255) NOT NULL,
    `description` text NOT NULL,
    `file` varchar(255) NOT NULL,
    `date` varchar(255) NOT NULL,
    `time` varchar(255) NOT NULL,
    `status` varchar(255) NOT NULL,
    `action` varchar(255) NOT NULL,
    PRIMARY KEY (mail_id)
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1";
  $final = mysqli_query($connection, $query);
  if(!$final){
    header("location: signup?username");
  }else{
    $give_in_users = "INSERT INTO `users`(`name`, `first_name`, `last_name`, `country`, `timezone`, `email_add`, `rec_email`, `password`, `last_otp`, `mob_num`) VALUES ('$full_name', '$f_name', '$l_name', '$country', '$timezone', '$full_email', '', '$password',  '', '$mob_no')";
    $give_final_users = mysqli_query($connection, $give_in_users);
    if($give_final_users){
        $_SESSION['session_email'] = $full_email;
        $_SESSION['session_password'] = $password;
        ?>
        <!doctype html>
        <html lang="en">
          <head>
            <title>Signup</title>
            <link rel="shortcut icon" type="x-icon" href="icon.ico">
            <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
            <!-- Bootstrap CSS v5.2.0-beta1 -->
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"  integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        
          </head>
          <body style="min-height: 100%; min-width: 100%;">

          <div class="d-flex justify-content-center align-items-center flex-column" style="min-height: 120mm; min-width: 100%;">
            <a class="h4 btn btn-primary  text-white p-3 rounded-5" href="recovery-email">Want to add a recovery email</a>
            <p class="form-text text-muted">
                If you don't add a recovery email, you can lost your fakemail account
            </p>
            <a href="login?logined" class="mt-5 text-decoration-none">Go to login page</a>
          </div>    
          


            <!-- Bootstrap JavaScript Libraries -->
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
        
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
          </body>
        </html>

<?php
    }else{
        echo "loser";
    }

  }
}
}
}

?>