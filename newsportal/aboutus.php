<?php
session_start();
include('includes/config.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>E-Zone | Gaming News</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <link href="images/logoe.png" rel="icon">

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
          <li><a class="nav-link scrollto active" href="index.php">Home</a></li>
          <li><a class="nav-link scrollto" href="#news">News</a></li>
          <li><a class="nav-link scrollto" href="aboutus.php">About</a></li>
          <li class="nav-item"><a class="nav-link" href="admin/">Sign-In</a></li>
          <li>
            <form name="search" action="search.php" method="post">
              <div class="input-group" >

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
  <section style="margin-top: 10%;" id="about" class="about">
    <div class="container">

      <div class="section-title" data-aos="zoom-out">
        <h2>About</h2>
        <p>Who we are</p>
      </div>

      <div class="row content" data-aos="fade-up">
        <div class="col-lg-6">
          <p>
          Perkembangan dunia game saat ini sangat lah cepat dan game tidak lagi hanya sekedar menjadi sarana hiburan atau pelepas stress namun saat ini game dijadikan sebagai profesi yang cukup menjanjikan kedepannya. Sehingga minat anak muda terhadap game kian meninggi. Dengan demikian kami berinovasi membuat sebuah portal berita yang menyajikan berita, tips, serta oponi mengenai game secara menarik dan terpercaya
          </p>
          
        </div>
        <div class="col-lg-6 pt-4 pt-lg-0">
          
        </div>
      </div>
    </div>
  </section>
  <section id="team" class="team">
    <div class="container">

      <div class="section-title" data-aos="zoom-out">
        <h2>Team</h2>
        <p>Our Hardworking Team</p>
      </div>

      <div class="row">

        <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
          <div class="member" data-aos="fade-up">
            <div class="member-img">
              <img src="images/gery.png" class="img-fluid" alt="">
            </div>
            <div class="member-info">
              <h4>Gery Jonathan Manurung</h4>
              <span>(211402137)</span>
              <span>Isi Berita, Comment & Approve Comment</span>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
          <div class="member" data-aos="fade-up">
            <div class="member-img">
              <img src="images/nurul.png" class="img-fluid" alt="">
            </div>
            <div class="member-info">
              <h4>Nurul Huda Ahmad Dani</h4>
              <span>(211402017)</span>
              <span>Change Password & Create Post</span>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
          <div class="member" data-aos="fade-up">
            <div class="member-img">
              <img src="images/bagus1.png" class="img-fluid" alt="">
            </div>
            <div class="member-info">
              <h4>Bagus Sadewo</h4>
              <span>(211402035)</span>
              <span>Create Category & Sub Category</span>
            </div>
          </div>
        </div>
      </div>
      <div class="row">

<div class="col-lg-3 col-md-6 d-flex align-items-stretch">
  <div class="member" data-aos="fade-up">
    <div class="member-img">
      <img src="images/karin.png" class="img-fluid" alt="">
    </div>
    <div class="member-info">
      <h4>Karina Angela Tobing</h4>
      <span>(211402041)</span>
      <span>Login, Forgot Password and Register</span>
    </div>
  </div>
</div>

<div class="col-lg-3 col-md-6 d-flex align-items-stretch">
  <div class="member" data-aos="fade-up">
    <div class="member-img">
      <img src="images/adjie.png" class="img-fluid" alt="">
    </div>
    <div class="member-info">
      <h4>Muhammad Stia Abghipraya Adjie</h4>
      <span>(211402092)</span>
      <span>Search Engine, Recent News & Popular News</span>
    </div>
  </div>
</div>

<div class="col-lg-3 col-md-6 d-flex align-items-stretch">
  <div class="member" data-aos="fade-up">
    <div class="member-img">
      <img src="images/luthfi.png" class="img-fluid" alt="">
    </div>
    <div class="member-info">
      <h4>Luthfi Muzhaffar Lubis</h4>
      <span>(211402119)</span>
      <span>Logout, Create Account & Hash Password</span>
    </div>
  </div>
</div>
</div>
    </div>
  </section>
  </main>
  <?php include('includes/footer.php'); ?>