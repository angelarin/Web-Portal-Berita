<?php
session_start();
include('../includes/config.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>E-Zone | Gaming News</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <link href="../images/logoe.png" rel="icon">

  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
 
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>
  <header id="header" class="fixed-top d-flex align-items-center  header-transparent ">
    <div class="container d-flex align-items-center justify-content-between">
      <div class="logo">
      <a href="index.html"><img src="images/logoe.png" alt="" class="img-fluid"></a>
      </div>
      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="index-guest.php">Home</a></li>
          <li><a class="nav-link scrollto active" href="aboutus.php">About</a></li>
          <li><a class="nav-link scrollto" href="#news">News</a></li>
          <li class="dropdown user-box">
                <a href="" class="dropdown-toggle waves-effect user-link" data-toggle="dropdown" aria-expanded="true">
                <img src="images/icons8-user-64.png" alt="user-img" class="img-circle user-img" height="30">
                </a>
                <ul class="dropdown-menu dropdown-menu-right arrow-dropdown-menu arrow-menu-right user-list notify-list">
                  <li>
                    <h5 align="center">Hi, <?php echo htmlentities($_SESSION['login']);?></h5>
                  </li>
                  <li><a href="change-password.php"><i class="ti-settings m-r-5"></i> Change Password</a></li>
                  <li><a href="logout.php"><i class="ti-power-off m-r-5"></i> Logout</a></li>
                  </ul>
            </li>
          <li>
            <form name="search" action="search.php" method="post">
              <div class="input-group">

                <input style="font-family:'Open Sans', sans-serif; border-radius: 20px;" type="text" name="searchtitle" class="form-control" placeholder="Search for..." required>
                <span class="input-group-btn">
                  <button style="font-family:'Open Sans', sans-serif; border-radius: 20px;" class="btn btn-secondary" type="submit">Go!</button>
                </span>
            </form>
          </li>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>

    </div>
  </header>
  <section id="hero" class="d-flex flex-column justify-content-end align-items-center">
    <div id="heroCarousel" data-bs-interval="5000" class="container carousel carousel-fade" data-bs-ride="carousel">

      <div class="carousel-item active row" style="margin-top: 10%;">
        <?php
        $query = mysqli_query($con, "SELECT tblposts.id as pid,tblposts.PostTitle as posttitle,tblposts.PostImage,tblcategory.CategoryName as category,tblcategory.id as cid,tblsubcategory.Subcategory as subcategory,tblposts.PostDetails as postdetails,tblposts.PostingDate as postingdate,tblposts.PostUrl as url from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblposts.SubCategoryId where carousel=1 order by tblposts.id desc");
        while ($row = mysqli_fetch_array($query)) {
        ?>
          <a href="news-details-guest.php?nid=<?php echo htmlentities($row['pid']) ?>">
            <div class="carousel-container section-title">
              <img style="width: 60%;" class="animate__animated animate__fadeInDown" src="../admin/postimages/<?php echo htmlentities($row['PostImage']); ?>">
              <p class="animate__animated animate__fadeInUp"><?php echo htmlentities($row['posttitle']); ?></p>
            </div>
          </a>
        <?php } ?>
      </div>

      <div class="carousel-item row" style="margin-top: 10%;">
        <?php
        $query = mysqli_query($con, "SELECT tblposts.id as pid,tblposts.PostTitle as posttitle,tblposts.PostImage,tblcategory.CategoryName as category,tblcategory.id as cid,tblsubcategory.Subcategory as subcategory,tblposts.PostDetails as postdetails,tblposts.PostingDate as postingdate,tblposts.PostUrl as url from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblposts.SubCategoryId where carousel=2 order by tblposts.id desc");
        while ($row = mysqli_fetch_array($query)) {
        ?>
          <a href="news-details-guest.php?nid=<?php echo htmlentities($row['pid']) ?>">
            <div class="carousel-container section-title">
              <img style="width: 60%;" class="animate__animated animate__fadeInDown" src="../admin/postimages/<?php echo htmlentities($row['PostImage']); ?>">
              <p class="animate__animated animate__fadeInUp"><?php echo htmlentities($row['posttitle']); ?></p>
            </div>
          </a>
        <?php } ?>
      </div>

      <div class="carousel-item row" style="margin-top: 10%;">
        <?php
        $query = mysqli_query($con, "SELECT tblposts.id as pid,tblposts.PostTitle as posttitle,tblposts.PostImage,tblcategory.CategoryName as category,tblcategory.id as cid,tblsubcategory.Subcategory as subcategory,tblposts.PostDetails as postdetails,tblposts.PostingDate as postingdate,tblposts.PostUrl as url from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblposts.SubCategoryId where carousel=3 order by tblposts.id desc");
        while ($row = mysqli_fetch_array($query)) {
        ?>
          <a href="news-details-guest.php?nid=<?php echo htmlentities($row['pid']) ?>">
            <div class="carousel-container section-title">
              <img style="width: 60%;" class="animate__animated animate__fadeInDown" src="../admin/postimages/<?php echo htmlentities($row['PostImage']); ?>">
              <p class="animate__animated animate__fadeInUp"><?php echo htmlentities($row['posttitle']); ?></p>
            </div>
          </a>
        <?php } ?>
      </div>

      <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon bx bx-chevron-left" aria-hidden="true"></span>
      </a>

      <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon bx bx-chevron-right" aria-hidden="true"></span>
      </a>

    </div>

    <svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28 " preserveAspectRatio="none">
      <defs>
        <path id="wave-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z">
      </defs>
      <g class="wave1">
        <use xlink:href="#wave-path" x="50" y="3" fill="rgba(255,255,255, .1)">
      </g>
      <g class="wave2">
        <use xlink:href="#wave-path" x="50" y="0" fill="rgba(255,255,255, .2)">
      </g>
      <g class="wave3">
        <use xlink:href="#wave-path" x="50" y="9" fill="#fff">
      </g>
    </svg>

  </section>