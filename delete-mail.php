<?php
session_start();
if(isset($_SESSION['its_logined'])){
if(isset($_GET['delete_id'])){
    $connection = mysqli_connect("localhost", "root", "", "mail");
    // saved session
                $session_dbid = $_SESSION['session_dbid'];
                $session_email = $_SESSION['session_email'];
                $session_name = $_SESSION['session_name'];
                $session_country = $_SESSION['session_country'];
                $session_timezone = $_SESSION['session_timezone'];
                $session_rec_email = $_SESSION['session_rec_email'];
                $session_password = $_SESSION['session_password'];
        $delete_id = $_GET['delete_id'];
        $location = $_GET['from'];

    $delete_query = "DELETE FROM `{$session_email}` WHERE `mail_id` = '{$delete_id}'";
    $final_delete_query = mysqli_query($connection, $delete_query);
    if($final_delete_query){
        header("location: {$location}");
    }



    
}
}

?>