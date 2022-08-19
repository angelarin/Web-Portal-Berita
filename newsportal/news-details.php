<?php
session_start();
include('includes/config.php');
if (empty($_SESSION['token'])) {
  $_SESSION['token'] = bin2hex(random_bytes(32));
}

if (isset($_POST['submit'])) {
  if (!empty($_POST['csrftoken'])) {
    if (hash_equals($_SESSION['token'], $_POST['csrftoken'])) {
      $name = $_POST['name'];
      $email = $_POST['email'];
      $comment = $_POST['comment'];
      $postid = intval($_GET['nid']);
      $st1 = '0';
      $query = mysqli_query($con, "insert into tblcomments(postId,name,email,comment,status) values('$postid','$name','$email','$comment','$st1')");
      if ($query) :
        echo "<script>alert('comment successfully submit. Comment will be display after admin review ');</script>";
        unset($_SESSION['token']);
      else :
        echo "<script>alert('Something went wrong. Please try again.');</script>";

      endif;
    }
  }
}
$postid = intval($_GET['nid']);

$sql = "SELECT viewCounter FROM tblposts WHERE id = '$postid'";
$result = $con->query($sql);

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $visits = $row["viewCounter"];
    $sql = "UPDATE tblposts SET viewCounter = $visits+1 WHERE id ='$postid'";
    $con->query($sql);
  }
} else {
  echo "no results";
}



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

  <section>
  <div class="container">
    <div class="row" style="margin-top: 4%">

      <div class="col-md-8">
        <?php
        $pid = intval($_GET['nid']);
        $currenturl = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];;
        $query = mysqli_query($con, "select tblposts.PostTitle as posttitle,tblposts.PostImage,tblcategory.CategoryName as category,tblcategory.id as cid,tblsubcategory.Subcategory as subcategory,tblposts.PostDetails as postdetails,tblposts.PostingDate as postingdate,tblposts.PostUrl as url,tblposts.postedBy,tblposts.lastUpdatedBy,tblposts.UpdationDate from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblposts.SubCategoryId where tblposts.id='$pid'");
        while ($row = mysqli_fetch_array($query)) {
        ?>

          <div class="card mb-4" style="border-radius: 20px;">

            <div class="card-body">
              <h2 class="card-title"><?php echo htmlentities($row['posttitle']); ?></h2>
              <a class="badge bg-secondary text-decoration-none link-light" href="category.php?catid=<?php echo htmlentities($row['cid']) ?>" style="color:#fff"><?php echo htmlentities($row['category']); ?></a>
              <a class="badge bg-secondary text-decoration-none link-light" style="color:#fff"><?php echo htmlentities($row['subcategory']); ?></a>
              <p>

                <b>Posted by </b> <?php echo htmlentities($row['postedBy']); ?> on </b><?php echo htmlentities($row['postingdate']); ?> |
                <?php if ($row['lastUpdatedBy'] != '') : ?>
                  <b>Last Updated by </b> <?php echo htmlentities($row['lastUpdatedBy']); ?> on </b><?php echo htmlentities($row['UpdationDate']); ?>
              </p>
            <?php endif; ?>
            <p><strong>Share:</strong> <a href="http://www.facebook.com/share.php?u=<?php echo $currenturl; ?>" target="_blank">Facebook</a> |
              <a href="https://twitter.com/share?url=<?php echo $currenturl; ?>" target="_blank">Twitter</a> |
              <a href="https://web.whatsapp.com/send?text=<?php echo $currenturl; ?>" target="_blank">Whatsapp</a> |
              <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo $currenturl; ?>" target="_blank">Linkedin</a> <b>Visits:</b> <?php print $visits; ?>
            </p>
            <hr />

            <img class="img-fluid rounded" src="admin/postimages/<?php echo htmlentities($row['PostImage']); ?>" alt="<?php echo htmlentities($row['posttitle']); ?>">

            <p class="card-text"><?php
              $pt = $row['postdetails'];
              echo (substr($pt, 0)); ?></p>

            </div>
            <div class="card-footer text-muted">
              <div class="col-md-8">

              </div>
            </div>
          </div>
        <?php } ?>
      </div>
      <?php include('includes/sidebar.php'); ?>
    </div>
    <div class="col-md-8" >
      <div class="card mb-4" >
        <h5 class="card-header">Silahkan Login Untuk Memberikan Komentar</h5>
      </div>
    </div>

    <?php
    $sts = 1;
    $query = mysqli_query($con, "select name,comment,postingDate from  tblcomments where postId='$pid' and status='$sts'");
    while ($row = mysqli_fetch_array($query)) {
    ?>
      <div class="media mb-4">
        <img class="d-flex mr-3 rounded-circle" src="images/usericon.png" alt="">
        <div class="media-body">
          <h5 class="mt-0"><?php echo htmlentities($row['name']); ?> <br />
            <span style="font-size:11px;"><b>at</b> <?php echo htmlentities($row['postingDate']); ?></span>
          </h5>

          <?php echo htmlentities($row['comment']); ?>
        </div>
      </div>
    <?php } ?>

  </div>
  </div>
  </div>
  </section>

  <?php include('includes/footer.php'); ?>