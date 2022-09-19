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
    <title>mail</title>
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
    $show_id = $_GET['show'];
    $sql_prodan = "UPDATE `{$session_email}` SET `status` = '1' WHERE `mail_id` = '{$show_id}'";
    $final_sql_prodan = mysqli_query($connection, $sql_prodan);
    if($final_sql_prodan){
    $sql_adan = "SELECT * FROM `{$session_email}` WHERE `mail_id` = '{$show_id}'";
    $final_sql_prodan = mysqli_query($connection, $sql_adan);
    $row = mysqli_fetch_assoc($final_sql_prodan);
    $to_from = "{$row['to_from']}";
    $subject = "{$row['subject']}";
    $description = "{$row['description']}";
    $file = "{$row['file']}";
    $date = "{$row['date']}";
    $time = "{$row['time']}";
    $status = "{$row['status']}";
    $action = "{$row['action']}";
// Getting data ended...now othger cod eto show
        if($action == "sent"){
            $to_or_from = "To";
        }elseif($action == "inbox"){
            $to_or_from = "From";
        }else{
            $to_or_from = "From or To";
        }

?>
<div class="col-11 shadow d-block mx-auto mt-5 p-3" style="min-height: 100mm">
<div class="border border-dark rounded-2 p-1">
    <p class="h5 px-2"><?php echo $to_or_from.": ".$to_from; ?></p>
</div>

<div class="border border-dark rounded-2 p-1 my-3">
    <p class="h5 px-2"><?php echo "Subject: ".$subject; ?></p>
</div>

<div class="border border-dark rounded-2 p-1 my-3" style="min-height: 30mm">
    <p class="h5 px-2"><?php echo "Body: <br>".$description; ?></p>
</div>
<?php
    if($file != ""){
        $date_justify = "justify-content-between";
    }else{
        $date_justify = "justify-content-end";
}
?>
<div class="d-flex <?php echo $date_justify; ?>">
<?php
    if($file != ""){
    ?>
<a href="uploaded_file/<?php echo $file; ?>" class="btn btn-primary" data-bs-toggle="tooltip"
      data-bs-placement="right"
      title="Filename: <?php echo $file; ?>">File</a>
<?php
}else{}
?>
                <p class="text-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-minus-fill" viewBox="0 0 16 16">
                <path d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2zM6 10h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1 0-1z"/>
                </svg><?php echo " ".$date; ?>&nbsp;&nbsp;
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-alarm-fill" viewBox="0 0 16 16">
                <path d="M6 .5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1H9v1.07a7.001 7.001 0 0 1 3.274 12.474l.601.602a.5.5 0 0 1-.707.708l-.746-.746A6.97 6.97 0 0 1 8 16a6.97 6.97 0 0 1-3.422-.892l-.746.746a.5.5 0 0 1-.707-.708l.602-.602A7.001 7.001 0 0 1 7 2.07V1h-.5A.5.5 0 0 1 6 .5zm2.5 5a.5.5 0 0 0-1 0v3.362l-1.429 2.38a.5.5 0 1 0 .858.515l1.5-2.5A.5.5 0 0 0 8.5 9V5.5zM.86 5.387A2.5 2.5 0 1 1 4.387 1.86 8.035 8.035 0 0 0 .86 5.387zM11.613 1.86a2.5 2.5 0 1 1 3.527 3.527 8.035 8.035 0 0 0-3.527-3.527z"/>
                </svg>&nbsp;<?php echo $time; ?>
                </p>

                </div>


</div>





<?php include 'footer1.php';?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>



<?php
// end of else that mean update status to seen
}
}else{
    header("location: login");
}



?>