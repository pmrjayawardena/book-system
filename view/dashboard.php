<?php

$m_id=2;
include '../common/sessionhandling.php';
$role_id=$userinfo['role_id'];
include '../common/dbconnection.php';
include '../model/usermodel.php';
include '../model/bookmodel.php';
include '../common/functions.php';



$obb=new book();
 $resultn=$obb->viewAllBooks();


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

     

      <h2>  <a href="./add_book.php" class="btn btn-primary">Add Book</a></h2>
      <table class="table">
  <thead>
  <tr>
        <th>Image</th>
        <th>ISBN</th>
        <th>Book Title</th>
        <th>Author Name</th>
        <th>Book Description</th>
        <th>Rating</th>
        <th>Action</th>
        <th></th>
        </tr>
  </thead>
  <tbody>
  <?php while($row=$resultn->fetch(PDO::FETCH_BOTH)) { 
                   $overall=$obb->overallRating( $row ['id']);
                   $sumRating=$obb->ratingSUM( $row ['id']);
                   $data1= $sumRating->fetch(PDO::FETCH_BOTH);
                   $data= $overall->rowCount();
                    $rate =$data1['BookRate'];
                   $overallFinal =  $rate / $data;

                   if($row['book_image']==""){
                    $uimage="../images/book_default.png";
                  }else{
                    $uimage="../images/book_images/".$row['book_image'];
                  }
                   
                  $overallFinal=0;
                  if($data <=0){
                     $overallFinal=0;
                  }else{
                     $rate =$data1['BookRate'];
                     $overallFinal =  $rate / $data;
                  }
                ?>
    <tr>
    <td><img src="<?php echo $uimage; ?>" class="style1" width="50px" height="50px" /></td>
    <td><?php echo $row['isbn'];?></td>
                  <td><?php echo $row['book_title'];?></td>
                  <td><?php echo $row['author_name'];?></td>
                  <td><?php echo $row['book_des'];?></td>
                  <td><?php echo $overallFinal;?></td>
                  <td>

                   <a href="../view/viewbook.php?book_id=<?php echo $row ['id']; ?>">
                      <button type="button" class="btn btn-primary mt-3">View</button>
                    </a>
                    <?php if($userinfo['role_id'] ==1){ ?>
                   <a href="../view/editbook.php?book_id=<?php echo $row ['id']; ?>">
                      <button type="button" class="btn btn-primary mt-3">Edit</button>
                    </a>
                    <?php }?>
                   <a href="../view/ratebook.php?book_id=<?php echo $row ['id']; ?>">
                      <button type="button" class="btn btn-success mt-3">Rate</button>
                    </a>
                    <?php if($userinfo['role_id'] ==1){ ?>
                   <a href="../controller/bookcontroller.php?action=delete&book_id=<?php echo $row['id']; ?>">
                      <button type="button" class="btn btn-danger mt-3">Delete</button>
                    </a>
                    <?php }?>
                  </td>
    </tr>
    <?php } ?>

  </tbody>
</table>
    </main>
  </div>
</div>


    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="../js/dashboard.js"></script>
  </body>
</html>
