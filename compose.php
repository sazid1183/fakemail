<?php

session_start();
if(isset($_SESSION['its_logined'])){
    if(isset($_POST['sended_data'])){
        $connection = mysqli_connect("localhost", "root", "", "mail");

       // Start Show File
       if(isset($_FILES['file_sended'])){
        $error_f = array();
        $f_name_f = $_FILES['file_sended'];
        $filename_f = $_FILES['file_sended']['name'];
        $filesize_f = $_FILES['file_sended']['size'];
        $tmploc_f = $_FILES['file_sended']['tmp_name'];
        $filetype_f = $_FILES['file_sended']['type'];

        if($filename_f == ""){
            $new_name_file = "";
        }else{


        date_default_timezone_set("Asia/Dhaka");
        $new_name_file = time(). "-".basename($filename_f);
        $target_f = "uploaded_file/".$new_name_file;
    if(empty($error_f) == true){
        move_uploaded_file($tmploc_f,$target_f);
    }else{
        print_r($error_f);
        die();
    }

    }
    }else{
        
        $new_name_file = "no_img.png";
    }
    // End Show Filew
    $send_to  = $_POST['send_to'];
    $subject  = $_POST['subject'];
    $body_text_pre  = $_POST['body_text'];
    $body_text  = '<pre class="px-4" style="white-space: pre-wrap; font-family: Times New Roman; font-size: 18px">'.$body_text_pre.'</pre>';
    $session_email  = $_SESSION['session_email'];
    $session_name  = $_SESSION['session_name'];
    $session_timezone  = $_SESSION['session_timezone'];
    $session_email  = $_SESSION['session_email'];

    date_default_timezone_set($session_timezone);
    $sender_date = date("d:m:y");
    $sender_time = date("g:i a");
    // Getted sender data ended now starting reciver data
    $reciver_data = "SELECT * FROM `users` WHERE `email_add` = '$send_to'";
    $final_reciver_data = mysqli_query($connection, $reciver_data);
    $row_reciver_data = mysqli_fetch_assoc($final_reciver_data);
    $reciver_timezone = "{$row_reciver_data['timezone']}";
    $reciver_date = date("d:m:y");
    $reciver_time = date("g:i a");
    
    $sql_query = "INSERT INTO `{$session_email}` (`to_from`, `subject`, `description`, `file`, `date`, `time`, `action`, `status`) VALUES ('$send_to', '$subject', '$body_text', '$new_name_file', '$sender_date', '$sender_time', 'sent', '2');";
    $sql_query .= "INSERT INTO `{$send_to}` (`to_from`, `subject`, `description`, `file`, `date`, `time`, `action`) VALUES ('$session_email', '$subject', '$body_text', '$new_name_file', '$reciver_date', '$reciver_time', 'inbox')";
    $final_sql_query = mysqli_multi_query($connection, $sql_query);
    if($final_sql_query){
        header("location: sent?sended");
    }

        


// Else of not esset submit    
}else{
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"  integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title>Compose</title>
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
   
// Getting data ended...now othger cod eto show


?>
<div class="col-11 shadow d-block mx-auto my-5 p-3" style="min-height: 150mm">
<form action="compose" method="post" enctype="multipart/form-data">
<div class="col-11 d-block my-3 mx-auto"><div class="input-group" name="send_to">
    <span class="input-group-text">To: &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;</span>
    <input type="text" aria-label="First name" class="form-control" name="send_to">
</div></div>


<div class="col-11 d-block my-3 mx-auto"><div class="input-group">
    <span class="input-group-text">Subject:</span>
    <input type="text" aria-label="First name" class="form-control" name="subject">
</div></div>


<div class="col-11 d-block my-3 mx-auto">
<div class="mb-3">
  <label for="" class="input-group-text border-bottom-0 rounded-0 rounded-top">Body:</label>
  <textarea class="form-control rounded-0 rounded-bottom" name="body_text" id="" rows="15" style="resize: none;"></textarea>
</div>
</div>

<div class="col-11 d-block my-3 mx-auto">
<div class="mb-3">
  <input type="file" class="form-control" name="file_sended" id="" placeholder="" aria-describedby="fileHelpId">
  <div id="fileHelpId" class="form-text">If you want to send any file.</div>
</div>
</div>

<input type="submit" value="Send" name="sended_data" class="btn btn-primary d-block mx-auto btn-lg">
</form>

</div>

<?php include 'footer1.php';?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>



<?php
// end of else that mean data not sended or submitted
}

}else{
    header("location: login");
}



?>