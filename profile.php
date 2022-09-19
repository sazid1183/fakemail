<?php

session_start();
if(isset($_SESSION['its_logined'])){
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"  integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title>Profile</title>
    <link rel="shortcut icon" type="x-icon" href="icon.ico">
</head>
<body class="">
    <?php include 'header.php';?>
<?php 
    $connection = mysqli_connect("localhost", "root", "", "mail");
    $session_dbid = $_SESSION['session_dbid'];
    $session_email = $_SESSION['session_email'];
    $session_name = $_SESSION['session_name'];
    $session_password = $_SESSION['session_password'];
    $sql_adan = "SELECT * FROM `users` WHERE `email_add` = '{$session_email}' AND `password` = '{$session_password}'";
    $final_sqli_adan = mysqli_query($connection, $sql_adan);
    $row = mysqli_fetch_assoc($final_sqli_adan);
                $email_add = "{$row['email_add']}"; 
                $user_id = "{$row['user_id']}";
                $name = "{$row['name']}";
                $country = "{$row['country']}";
                $timezone = "{$row['timezone']}";
                $rec_email = "{$row['rec_email']}";
                $password = "{$row['password']}";
?>
<div class="col-11 d-block mx-auto my-5">
    <div class="d-flex justify-content-end">
        <a href="logout.php" class="btn btn-danger btn-lg text-end">Logout <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                                                                                    <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                                                                                    <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                                                                                    </svg>
                                                                                    </a>           
    </div>
<p class="text-primary h4">Your Information:</p>
<p>Email address: <?php echo $email_add; ?></p>
<p>First Name: <?php echo $name; ?></p>
<p>Country: <?php echo $country; ?></p>
<p>Recovery Email: <?php echo $rec_email; ?></p>
<a href="#" class="btn btn-primary">Change Information</a>
<p class="form-text text-muted">
    Sorry this is unavailable
</p>

<a href="recovery-email" class="btn btn-primary">Add or change recovery email</a>
</div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <?php include 'footer1.php';?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>



<?php
}else{
    header("location: login");
}



?>