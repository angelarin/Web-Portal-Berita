<?php include('includes/header.php');?>

  <section id="news" style="margin-left: 10%; margin-right: 10%; margin-top: 10%;" data-aos="zoom-out">
    <div class="section-title" data-aos="zoom-out">
      <h2>latest</h2>
      <p>News</p>
    </div>
    <div class="row">
      <div class="col-md-8">
        <?php
        if (isset($_GET['pageno'])) {
          $pageno = $_GET['pageno'];
        } else {
          $pageno = 1;
        }
        $no_of_records_per_page = 6;
        $offset = ($pageno - 1) * $no_of_records_per_page;


        $total_pages_sql = "SELECT COUNT(*) FROM tblposts";
        $result = mysqli_query($con, $total_pages_sql);
        $total_rows = mysqli_fetch_array($result)[0];
        $total_pages = ceil($total_rows / $no_of_records_per_page);


        $query = mysqli_query($con, "select tblposts.id as pid,tblposts.PostTitle as posttitle,tblposts.PostImage,tblcategory.CategoryName as category,tblcategory.id as cid,tblsubcategory.Subcategory as subcategory,tblposts.PostDetails as postdetails,tblposts.PostingDate as postingdate,tblposts.PostUrl as url from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblposts.SubCategoryId where tblposts.Is_Active=1 order by tblposts.id desc  LIMIT $offset, $no_of_records_per_page");
        while ($row = mysqli_fetch_array($query)) {
        ?>

          <div class="container mb-4">
            <img class="card-img-top" src="admin/postimages/<?php echo htmlentities($row['PostImage']); ?>" alt="<?php echo htmlentities($row['posttitle']); ?>">
            <div class="card-body">
              <h2 style="font-family:'Open Sans', sans-serif;"><?php echo htmlentities($row['posttitle']); ?></h2>
              <p>
                <a style="font-family:'Open Sans', sans-serif;" class="badge bg-secondary text-decoration-none link-light" href="category.php?catid=<?php echo htmlentities($row['cid']) ?>" style="color:#fff"><?php echo htmlentities($row['category']); ?></a>
                <a style="font-family:'Open Sans', sans-serif;" class="badge bg-secondary text-decoration-none link-light" style="color:#fff"><?php echo htmlentities($row['subcategory']); ?></a>
              </p>

              <a href="news-details.php?nid=<?php echo htmlentities($row['pid']) ?>" class="btn btn-primary">Read More &rarr;</a>
            </div>
            <div class="card-footer text-muted">
              <h6 style="font-family:'Open Sans', sans-serif;">Posted on <?php echo htmlentities($row['postingdate']); ?></h6>

            </div>
          </div>
        <?php } ?>
        <ul class="pagination justify-content-center mb-4">
          <li class="page-item"><a href="?pageno=1" class="page-link">First</a></li>
          <li class="<?php if ($pageno <= 1) {
                        echo 'disabled';
                      } ?> page-item">
            <a href="<?php if ($pageno <= 1) {
                        echo '#';
                      } else {
                        echo "?pageno=" . ($pageno - 1);
                      } ?>" class="page-link">Prev</a>
          </li>
          <li class="<?php if ($pageno >= $total_pages) {
                        echo 'disabled';
                      } ?> page-item">
            <a href="<?php if ($pageno >= $total_pages) {
                        echo '#';
                      } else {
                        echo "?pageno=" . ($pageno + 1);
                      } ?> " class="page-link">Next</a>
          </li>
          <li class="page-item"><a href="?pageno=<?php echo $total_pages; ?>" class="page-link">Last</a></li>
        </ul>
      </div>
      <?php include('includes/sidebar.php'); ?>
    </div>
  </section>
  <main id="main">
  </main>
  <?php include('includes/footer.php'); ?>