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
    <title>Welcome to Fakemail</title>
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

    // getted form session ended
    // starting query
    if(isset($_REQUEST['page'])){
        $page_num = $_REQUEST['page'];
      }else{
        $page_num = 1;
      }
      
      
      $limit = 20;
      $offset = ($page_num - 1) * $limit;

    $sql_adan = "SELECT * FROM `{$session_email}` WHERE `action` = 'inbox' ORDER BY `{$session_email}`.`mail_id` DESC LIMIT {$offset}, {$limit} ";
    $final_sql_adan = mysqli_query($connection, $sql_adan);
    $count = mysqli_num_rows($final_sql_adan);
    $sql_adan_unseen = "SELECT * FROM `{$session_email}` WHERE `action` = 'inbox' AND `status` = ''";
    $final_sql_adan_unseen = mysqli_query($connection, $sql_adan_unseen);
    $count_unseen = mysqli_num_rows($final_sql_adan_unseen);

    
?>
    <div class="my-3 col-11 d-block mx-auto"><p class="h4 text-primary">Hi <?php echo $session_name;?>. You have <?php echo $count_unseen; ?> unseen message.</p></div>
     <div class="allmail">
     <div class="col-11 d-block mx-auto">
     <a href="compose" class="btn btn-success rounded-5 py-2 px-3 d-md-block d-none" style="position: fixed; bottom: 50px; right: 25px; font-size: 30px; font-family: display;"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="text-light bi bi-plus-lg" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
                            </svg> Compose</a>

                            <!-- Compose for sm scrren -->
                            <a href="compose" class="btn btn-success rounded-5 d-md-none d-block" style="position: fixed; bottom: 70px; right: 25px; font-size: 20px; font-family: display;"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="text-light bi bi-plus-lg" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
                                </svg> Compose</a>
                                <!-- Compose for sm scrren  END-->
<?php
        while($row = mysqli_fetch_assoc($final_sql_adan)){
            $mail_id = "{$row['mail_id']}";
            $to_from = "{$row['to_from']}";
            $subject = "{$row['subject']}";
            $date = "{$row['date']}";
            $time = "{$row['time']}";
            $status = "{$row['status']}";
if($status == ""){
    $statuss = "link-info";
}else{
    $statuss = "link-dark";
}            


        
?>

<!-- A mail start -->

<div class="col-12 border-bottom border-2 pb-2 d-flex justify-content-between">
            <a href="themail?show=<?php echo $mail_id; ?>" target="_blank" class=" mx-3 text-decoration-none <?php echo $statuss; ?>" s>
                                                <span>

                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                                                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                                                                </svg>
                                                                
                                                                <?php echo $to_from; ?>
                                                </span>

                                                <span class="mx-md-3 d-block d-md-inline"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                                                                                                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                                                                                                </svg>
                                                                <?php echo $subject; ?>
                                                </span>
                                                <span class="mx-md-2 d-none d-md-inline">&nbsp;</span>
                                                                <span class="mx-md-5">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-alarm-fill" viewBox="0 0 16 16">
                                                                <path d="M6 .5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1H9v1.07a7.001 7.001 0 0 1 3.274 12.474l.601.602a.5.5 0 0 1-.707.708l-.746-.746A6.97 6.97 0 0 1 8 16a6.97 6.97 0 0 1-3.422-.892l-.746.746a.5.5 0 0 1-.707-.708l.602-.602A7.001 7.001 0 0 1 7 2.07V1h-.5A.5.5 0 0 1 6 .5zm2.5 5a.5.5 0 0 0-1 0v3.362l-1.429 2.38a.5.5 0 1 0 .858.515l1.5-2.5A.5.5 0 0 0 8.5 9V5.5zM.86 5.387A2.5 2.5 0 1 1 4.387 1.86 8.035 8.035 0 0 0 .86 5.387zM11.613 1.86a2.5 2.5 0 1 1 3.527 3.527 8.035 8.035 0 0 0-3.527-3.527z"/>
                                                                </svg>
                                                                <?php echo $date."-".$time; ?>
                                                </span>
                                                            </a>
<!-- Link for delete mail start -->
            <a href="delete-mail?delete_id=<?php echo $mail_id; ?>&&from=home" class="text-decoration-none link-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                        <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                                        </svg></a>      
<!-- Link for delte mail ended -->
        </div>
     
<!-- A mail end -->
<?php 
//  End of while loop
     }
?>
    </div>
     </div>

<!-- Starting Pagination OF all -->



<?php
    $query_pagination = "SELECT * FROM `{$session_email}` WHERE `action` = 'inbox'";

        $adanprodan_pagination = mysqli_query($connection, $query_pagination);
      
        if(mysqli_num_rows($adanprodan_pagination)){
          $total_records = mysqli_num_rows($adanprodan_pagination);
          $total_page = ceil($total_records/$limit);

?>
<!-- LIST START -->
           <div class="row w-100 container-fluid pt-5 mt-5">
            

           
          <ul class="pagination col-11 mx-5 mx-sm-3  justify-content-center" >  
            
                    
<?php
if($page_num > 1){
  $is_page_dis1 = "";
}else{
  $is_page_dis1 = "disabled";
}

?>

<form action="inbox" method="post">
           <li class="page-item <?php echo $is_page_dis1; ?>">
           <input type="hidden" name="page" value="<?php echo ($page_num - 1); ?>">
            <input type="submit" class="page-link rounded-0" name="page_getted_by_pagination" value="Previous">    
          </li>
          </form>    




 
 
<?php



          for($i = 1; $i <= $total_page; $i++){
            if($i == $page_num){
              $selected_page = "selected";
              $active_page = "active";
            }else{
              $selected_page = "";
              $active_page = "";
            }

?>


<!-- <option value="<?php echo $i; ?>" <?php echo $selected_page; ?>><?php echo $i; ?></option> -->

<!-- Pagination value form stary -->
<form action="inbox" method="post" class="d-md-inline d-none">
           <li class="page-item <?php  echo $active_page;  ?>">
           <input type="hidden" name="page" value="<?php echo $i; ?>">
            <input type="submit" class="page-link rounded-0" name="page_getted_by_pagination" value="<?php echo $i; ?>">    
          </li>
          </form>    
<!-- Pagination value form END -->


    
<?php
          }  // } for loop

          ?>

<!-- Form with value selected strrft -->
<form action="inbox" method="post" class="d-md-none d-inline">
  <select class="form-select rounded-0 bg-primary text-white" name="page" id="" onchange="this.form.submit()">
<?php



          for($i = 1; $i <= $total_page; $i++){
            if($i == $page_num){
              $selected_page = "selected";
              $active_page = "active";
            }else{
              $selected_page = "";
              $active_page = "";
            }

?>


<option value="<?php echo $i; ?>" <?php echo $selected_page; ?>><?php echo $i; ?></option>



    
<?php
          }  // } for loop

          ?>
 </select>
        </form>
<!-- Foermwith slect end -->


          <?php
if($total_page > $page_num){
  $is_page_dis2 = "";
}else{
  $is_page_dis2 = "disabled";
}

?>
<form action="home" method="post">
           <li class="page-item <?php echo $is_page_dis2; ?>">
           <input type="hidden" name="page" value="<?php echo ($page_num + 1); ?>">
            <input type="submit" class="page-link rounded-0" name="page_getted_by_pagination" value="Next">    
          </li>
          </form>  


        
          
        </ul>
     
            <!-- LIST END -->
            </div>
           
<?php
          
        }


        ?>





<!-- Ending Pagination OF all -->






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