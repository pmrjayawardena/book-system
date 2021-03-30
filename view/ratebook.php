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
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
          </div>
          <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
            <span data-feather="calendar"></span>
            This week
          </button>
        </div>
      </div>

     
      <div class="container mt-4">
    <div class="row">
      <div class="col-lg-12 text-center">
     
      <form method="post" action="../controller/bookcontroller.php?action=rate&book_id=<?php echo $book_id;?>" enctype="multipart/form-data">

<div class="form-body">
<?php if(isset($_GET['msg1']) ){?><div class="alert alert-success">Rate Successfully</div><?php }?>
  <div class="form-group row">

    <label class="control-label text-right col-md-3">ISBN &nbsp;<i class="fas fa-user-circle"></i></i></label>

    <div class="col-md-9">
    <select class="form-control" name="rating">
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
            <option>6</option>
            <option>7</option>
            <option>8</option>
            <option>9</option>
            <option>10</option>
        </select>
     <div id="uname" class="error">*</div>
     <small class="form-control-feedback"> </small> 
   </div>

  <div class="form-group row">
  <label class="control-label text-right col-md-3">Description<i class="fas fa-grimace"></i></label>
<div class="col-md-9">
   <textarea class="form-control" rows="3" name="comment" ></textarea>
</div>
 </div>


<div class="form-group row">
<label class="control-label text-right col-md-3"></label>
<div class="col-md-9 mt-5">
<input type="hidden" name="book_id" value="<?php echo $rowBook['id']; ?>">
<button type="submit" class="btn btn-success"> <i class="fa fa-check"></i>Rate Book</button>

</div>
</div>
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


    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="../js/dashboard.js"></script>
  </body>
</html>
