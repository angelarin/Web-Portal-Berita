<?php
session_start();
include('includes/config.php');
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
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>E-Zone | Gaming News</title>

  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <link href="css/modern-business.css" rel="stylesheet">

</head>

<body>

  <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="../index.php"><img src="../images/logo.png" height="50"></a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="../index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../about-us.php">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../index.php">News</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../contact-us.php">Contact us</a>
          </li>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container">
    <div class="row" style="margin-top: 4%">
      <div class="col-md-8">
        <?php
        $pid = intval($_GET['nid']);
        $currenturl = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];;
        $query = mysqli_query($con, "select tblposts.PostTitle as posttitle,tblposts.PostImage,tblcategory.CategoryName as category,tblcategory.id as cid,tblsubcategory.Subcategory as subcategory,tblposts.PostDetails as postdetails,tblposts.PostingDate as postingdate,tblposts.PostUrl as url,tblposts.postedBy,tblposts.lastUpdatedBy,tblposts.UpdationDate from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblposts.SubCategoryId where tblposts.id='$pid'");
        while ($row = mysqli_fetch_array($query)) {
        ?>
          <div class="card mb-4">
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
            </div>
          </div>
        <?php } ?>
      </div>

      <?php include('includes/sidebar.php'); ?>
    </div>
    <div class="row" style="margin-top: -8%">
      <div class="col-md-8">
        <div class="card my-4">
          <h5 class="card-header">Leave a Comment:</h5>
          <div class="card-body">
            <form name="Comment" method="post">
              <p hidden><input hidden type="hidden" name="csrftoken" value="<?php echo htmlentities($_SESSION['token']);?>" /></p>

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

  <?php include('includes/footer.php'); ?>
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>