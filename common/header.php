<?php
include '../common/sessionhandling.php';
?>
<?php 

    if($userinfo['user_image']==""){
        $uimage="../images/user_icon.png";
    }else{
        $uimage="../images/user_images/".$userinfo['user_image'];
    }
?>
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="../view/dashboard.php">Book Management</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="nav-link" href="#"><img class="style1" src="<?php echo $uimage; ?>" width="60px" height="50px"> <strong><?php echo $userinfo['role_name']; ?></strong></a>
  <ul class="navbar-nav px-3">

    <li class="nav-item text-nowrap">
      <a class="nav-link" href="../view/logout.php">Sign out </a>
    </li>
  </ul>
</header>
