<?php 
include '../common/dbconnection.php';

include '../common/functions.php';
?>



<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.82.0">
    <title>Book Management System</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/dashboard/">
    <script src="../sweetalert/sweetalert.min.js" ></script>
  <link rel="stylesheet" type="text/css" href="../sweetalert/sweetalert.css">
    

    <!-- Bootstrap core CSS -->
<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="../css/dashboard.css" rel="stylesheet">
  </head>

  <?php if(isset($_GET['msg1'])){ 


echo "<script type='text/javascript'> swal('Success!', 'User Added Successfully', 'success');</script>";


} ?>

  <body>
    
  <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Book Management</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="nav-link" href="#"> <strong><?php echo 'Welcome'; ?></strong></a>
  <ul class="navbar-nav px-3">

    <li class="nav-item text-nowrap">
      <a class="nav-link" href="../view/login.php">Login </a>
    </li>
  </ul>
</header>

<div class="container-fluid">
  <div class="row">


    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
    
      </div>

     
      <div class="container mt-4">
    <div class="row">
      <div class="col-lg-12 text-center">
     
      <form method="post" action="../controller/usercontroller.php?action=add" enctype="multipart/form-data">

<div class="form-body">
<?php if(isset($_GET['msg1']) ){?><div class="alert alert-success">Student Added Successfully</div><?php }?>
 

<div class="form-group row">

    <label class="control-label text-right col-md-3">Student Name &nbsp;<i class="fas fa-user-circle"></i></i></label>

    <div class="col-md-9">
     <input type="text" name="user_fname" id="user_fname" placeholder="Student Name" class="form-control" />
     <div id="uname" class="error">*</div>
     <small class="form-control-feedback"> </small> </div>
   </div>

  <div class="form-group row">
    <label class="control-label text-right col-md-3">Email &nbsp; <i class="fas fa-envelope"></i></label>
    <div class="col-md-9">
     <input type="text" name="user_email" id="user_email" placeholder="User Email" class="form-control" "/>
 
     <div id="eemailerr" class="error">*</div>
   </div>
 </div>

<div class="form-group row">
<label class="control-label text-right col-md-3">NIC &nbsp; <i class="fas fa-id-card"></i></label>
<div class="col-md-9">
  <div class="radio-list">


    <input type="text" name="user_nic" id="user_nic" placeholder="User NIC" class="form-control" onkeyup="checkNIC(this.value)"/>

    <span id="showNIC"></span>
   <div id="unic" class="error"></div>
  </label>
</div>
</div>
</div>


<div class="form-group row mt-3">
<label class="control-label text-right col-md-3">Password &nbsp; <i class="fas fa-id-card"></i></label>
<div class="col-md-9">
  <div class="radio-list">


    <input type="password" name="password" id="password" placeholder="Password" class="form-control" required />
    <div id="unerror" class="error"></div>
  </label>
</div>
</div>
</div>
<div class="form-group row  mt-3">
<label class="control-label text-right col-md-3">Confirm Password &nbsp; <i class="fas fa-id-card"></i></label>
<div class="col-md-9">
  <div class="radio-list">


    <input type="password" name="confirm_password" id="confirm_password" required placeholder=" Confirm Password" class="form-control" />
    <div id="unerror" class="error"></div>
  </label>
</div>
</div>
</div>
<div class="form-group row">
<label class="control-label text-right col-md-3">Confirm Password &nbsp; <i class="fas fa-id-card"></i></label>
<div class="col-md-9">

<?php
$err = "";
$suc ="";
if (!empty($_POST)) { //if post variable set
    //validation
    if ($_SESSION['captcha_text'] != $_POST['captcha']) { //check captcha validation
        $err = 'Captcha text is wrong';
    } else {
        $suc = "Success!";
    }
}

?>
<?php if ($err != "") { ?>
            <div class="alert alert-danger">
                <?php echo $err; ?>
            </div>
        <?php } ?>
        <?php if ($suc != "") { ?>
            <div class="alert alert-success text-center">
                <?php echo $suc; ?>
            </div>
        <?php } ?>

<img src="captcha.php" alt="CAPTCHA" class="captcha-image mb-2">&nbsp;&nbsp;<i class="fas fa-redo refresh btn btn-link"></i>
 <input type="text" id="captcha" class="form-control" placeholder="" name="captcha" required>

                
            
</div>
</div>

<button type="submit" class="btn btn-success  mt-3"> <i class="fa fa-check"></i>Register</button>
</div>


</div>
</div>
</div>


</div>

</div>
</form>
      </div>
    </div>
  </div>
    </main>
  </div>
</div>

    <script  src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="../js/dashboard.js"></script>
      <script type="text/javascript" src="../js/validation.js"></script>
     <script>
        var refreshButton = document.querySelector(".refresh");
        refreshButton.onclick = function() {
            document.querySelector(".captcha-image").src = 'captcha.php?' + Date.now();
        }
    </script>
    </body>
</html>
