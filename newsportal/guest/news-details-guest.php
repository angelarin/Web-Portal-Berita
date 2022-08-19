<?php
session_start();
include('../includes/config.php');

if (empty($_SESSION['token'])) {
  $_SESSION['token'] = bin2hex(random_bytes(32));
}

$adminid = $_SESSION['login'];
$sql = mysqli_query($con, "SELECT AdminEmailId FROM tbladmin WHERE AdminUserName='$adminid'");
$row = mysqli_fetch_array($sql);

if (isset($_POST['submit'])) {
  if (!empty($_POST['csrftoken'])) {
    if (hash_equals($_SESSION['token'], $_POST['csrftoken'])) {
      $name = $_SESSION['login'];
      $email = $row['AdminEmailId'];
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
          <li><a class="nav-link scrollto" href="#news">News</a></li>
          <li class="dropdown user-box">
            <a href="" class="dropdown-toggle waves-effect user-link" data-toggle="dropdown" aria-expanded="true">
              <img src="images/icons8-user-64.png" alt="user-img" class="img-circle user-img" height="30">
            </a>
            <ul class="dropdown-menu dropdown-menu-right arrow-dropdown-menu arrow-menu-right user-list notify-list">
              <li>
                <h5 align="center">Hi, <?php echo htmlentities($_SESSION['login']); ?></h5>
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

              <img class="img-fluid rounded" src="../admin/postimages/<?php echo htmlentities($row['PostImage']); ?>" alt="<?php echo htmlentities($row['posttitle']); ?>">

              <p class="card-text"><?php
                $pt = $row['postdetails'];
                echo (substr($pt, 0)); ?></p>
              </div>
              <div class="card-footer text-muted">
              </div>
            </div>
          <?php } ?>
        </div>

        <?php include('includesguest/sidebar.php'); ?>
      </div>
      <div class="row">
        <div class="col-md-8" >
          <div class="card my-4"style="border-radius: 20px;">
            <h5 class="card-header">Leave a Comment:</h5>
            <div class="card-body">
              <form name="Comment" method="post">
                <p hidden><input hidden type="hidden" name="csrftoken" value="<?php echo htmlentities($_SESSION['token']); ?>" /></p>

                <div class="form-group">
                  <textarea class="form-control" name="comment" rows="3" placeholder="Comment" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
              </form>
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

  <?php include('includesguest/footer.php'); ?>