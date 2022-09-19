<?php
session_start();


    ?>
    <!doctype html>
    <html lang="en">
      <head>
        <title>Signup</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
        <!-- Bootstrap CSS v5.2.0-beta1 -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"  integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <link rel="shortcut icon" type="x-icon" href="icon.ico">
      </head>
      <body>
          <div class="row mx-5 d-flex justify-content-center align-items-center" style="min-height: 150mm">
           
          <form action="signup-action" method="post" class="shadow py-3" style="max-width: 200mm">
          <div class="d-flex flex-column align-items-center">
   <img src="logo.png" alt="logo" class="float-center" width="70mm">
   <h3 class="text-primary">Register to Fakemail</h3>
   </div>
          <!-- <h3 class="text-primary text-center">Register to Fakemail</h3> -->
            <div class="mb-3 row">
                <div class="col-6">
              <label for="" class="form-label">First name</label>
              <input type="text"
                class="form-control" name="f_name" id="" placeholder="">
                </div>
                <div class="col-6">
              <label for="" class="form-label">Last name</label>
              <input type="text"
                class="form-control" name="l_name" id="" placeholder="">
                </div>
            </div>

           <div class="mb-3 row">
            <div class="col-6">
                
                  <label for="" class="form-label">Mobile NO. (Optional)</label>
                  <input type="number"
                    class="form-control" name="mob_no" id="" placeholder="">
         
                
            </div>
            <div class="col-6">
             <label for="" class="form-label">Country</label>
             <select class="form-select" name="country" id="" required>
               <option value="" selected disabled>Select Country</option>
               <option value="Bangladesh">Bangladesh</option>
               <option value="India">India</option>
               <option value="America">America</option>
               <option disabled>Working for more country</option>
             </select>
             </div>
           </div>
            
           <div class="input-group">
            <label for="" class="form-label"></label>
            <input type="text" name="email_add" class="form-control">
            <span class="input-group-text">@fakemail.com</span>
           </div>
         
<div class="row">
    <div class="col-6">
        
          <label for="" class="form-label">Password</label>
          <input type="password" class="form-control" name="password" id="" placeholder="">
        
    </div>

    <div class="col-6">
        
          <label for="" class="form-label">Confirm Password</label>
          <input type="password" class="form-control" name="confirm_password" id="" placeholder="">
        
    </div>
</div>
<?php
if(isset($_REQUEST['p_m'])){
  echo "<p class='text-danger text-center mt-3'>Password not match with confirm password.</p>";
}else{}
if(isset($_REQUEST['username'])){
  echo "<p class='text-danger text-center mt-3'>Username already exist.</p>";
}else{}


?>
<button type="submit" class="btn btn-primary d-block m-auto my-3" name="register_it">Submit</button>



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

?>

