<?php

$m_id=2;
include '../common/sessionhandling.php';
$role_id=$userinfo['role_id'];
include '../common/dbconnection.php';
include '../model/usermodel.php';
include '../model/bookmodel.php';
include '../common/functions.php';

$book_id=$_REQUEST['book_id'];

$obb=new book();
 $result=$obb->getSingleBook($book_id);
 $rowBook=$result->fetch(PDO::FETCH_BOTH);
 $overall=$obb->overallRating( $rowBook ['id']);
 $allrating=$obb->allRating( $rowBook ['id']);
 $sumRating=$obb->ratingSUM( $rowBook ['id']);
 $data1= $sumRating->fetch(PDO::FETCH_BOTH);


 $data= $overall->rowCount();
 $overallFinal=0;
 if($data <=0){
    $overallFinal=0;
 }else{
    $rate =$data1['BookRate'];
    $overallFinal =  $rate / $data;
 }


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


echo "<script type='text/javascript'> swal('Success!', 'Book Added Successfully', 'success');</script>";


} ?>
<?php if(isset($_GET['msg2'])){ 


echo "<script type='text/javascript'> swal('Deleted!', 'Book Deleted Successfully', 'error');</script>";


} ?>

  <body>
    
  <?php include_once('../common/header.php'); ?>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="./allbooks.php">
              <span data-feather="home"></span>
              All Books
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./search.php">
              <span data-feather="file"></span>
              Search
            </a>
          </li>
         
        </ul>


      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
   
      </div>

     
      <div class="container mt-4">
    <div class="row">
      <div class="col-lg-12 text-center">
     
    
<div class="form-body">
<?php if(isset($_GET['msg1']) ){?><div class="alert alert-success">Book Edited Successfully</div><?php }?>
  <div class="form-group row">

    <label class="control-label text-right col-md-3">ISBN &nbsp;<i class="fas fa-user-circle"></i></i></label>

    <div class="col-md-9">
     <input readonly type="text" name="isbn" id="isbn" placeholder="ISBN" class="form-control" value="<?php echo $rowBook['isbn']; ?>"/>
     <div id="uname" class="error">*</div>
     <small class="form-control-feedback"> </small> </div>
   </div>

  <div class="form-group row">
    <label class="control-label text-right col-md-3">Title of the book &nbsp; <i class="fas fa-envelope"></i></label>
    <div class="col-md-9">
     <input readonly type="text" name="book_title" id="book_title" placeholder="Book Title" class="form-control" value="<?php echo $rowBook['book_title']; ?>" "/>
     
     <div id="eemailerr" class="error">*</div>
   </div>
 </div>

<div class="form-group row">
<label class="control-label text-right col-md-3">Author Name &nbsp; <i class="fas fa-id-card"></i></label>
<div class="col-md-9">
  <div class="radio-list">
    <input readonly type="text" name="author_name" id="author_name" placeholder="Author Name" class="form-control" value="<?php echo $rowBook['author_name']; ?>" />
    <!-- <span id="showNIC"></span> -->
   <!-- <div id="unic" class="error"></div> -->
  </label>
</div>
</div>
</div>
<div class="form-group row mt-3">
<label class="control-label text-right col-md-3">Book Image&nbsp; <i class="fas fa-grimace"></i></label>
<div class="col-md-9">
<input readonly disabled type="file" name="book_image" id="book_image" placeholder="Book Image" class="form-control" onchange="readURL(this)" />
    <div id="uierror" class="error"></div><img id="image_view" />
</div>
</div>
<div class="form-group row">
<label class="control-label text-right col-md-3">Description<i class="fas fa-grimace"></i></label>
<div class="col-md-9">
   <textarea class="form-control" rows="3" name="description" readonly><?php echo $rowBook['book_des']; ?></textarea>
</div>
</div>

<div class="form-group row">
<label class="control-label text-right col-md-3"></label>
<div class="col-md-9 mt-5">
<input type="hidden" name="book_id" value="<?php echo $rowBook['id']; ?>">


</div>
</div>

<div class="form-group row">
<label class="control-label text-right col-md-3">Overall Rating &nbsp; <i class="fas fa-id-card"></i></label>
<div class="col-md-9">
  <div class="radio-list">
<div class="form-control  alert alert-primary"><?php echo  $overallFinal; ?></div>
    <!-- <span id="showNIC"></span> -->
   <!-- <div id="unic" class="error"></div> -->
  </label>
</div>
</div>
</div>

<div class="form-group row ">
<?php if($overallFinal !=0) {?>
<label class="control-label text-right col-md-3">Comments<i class="fas fa-grimace"></i></label>
<div class="col-md-9">
<?php while($row=$allrating->fetch(PDO::FETCH_BOTH)) { ?>
   <div class="form-control mt-3 alert alert-success" rows="3" name="description" > <?php echo $row['comment']; ?></div>
<?php }?>
</div>
<?php }else{?>
<p class="alert alert-warning">No comments  yet</p>
<?php }?>
</div>
</div>


</div>
</div>
</div>


</div>

</div>

      </div>
    </div>
  </div>
    </main>
  </div>
</div>


    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="../js/dashboard.js"></script>
  </body>
</html>
