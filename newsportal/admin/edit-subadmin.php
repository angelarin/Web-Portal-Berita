<?php
session_start();
include('includes/config.php');
$sql = mysqli_query($con, "SELECT AdminUserName,AdminEmailId,AdminPassword,userType FROM tbladmin ");
$num = mysqli_fetch_array($sql);
$row = mysqli_fetch_assoc($sql);
error_reporting(0);
if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
} elseif ($_SESSION['utype'] == 2) {
    header('location:index.php');
} else {
    if (isset($_POST['submit'])) {
        $aid = intval($_GET['said']);
        $email = $_POST['emailid'];
        $type = $_POST['userType'];
        $query = mysqli_query($con, "Update  tbladmin set AdminEmailId='$email', userType='$type' where id='$aid'");
        if ($query) {
            echo "<script>alert('Guest details updated.');</script>";
        } else {
            echo "<script>alert('Something went wrong . Please try again.');</script>";
        }
    }
?>


    <!DOCTYPE html>
    <html lang="en">

    <head>

        <title>Newsportal |Edit Guest</title>

        <!-- App css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="../plugins/switchery/switchery.min.css">
        <script src="assets/js/modernizr.min.js"></script>

    </head>


    <body class="fixed-left">

        <div id="wrapper">
            <?php include('includes/topheader.php'); ?>

            <?php include('includes/leftsidebar.php'); ?>

            <div class="content-page">
                <div class="content">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">Edit Guest</h4>
                                    <ol class="breadcrumb p-0 m-0">
                                        <li>
                                            <a href="#">Admin</a>
                                        </li>
                                        <li>
                                            <a href="#">Guest </a>
                                        </li>
                                        <li class="active">
                                            Edit Guest
                                        </li>
                                    </ol>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box">
                                    <h4 class="m-t-0 header-title"><b>Edit Guest </b></h4>
                                    <hr />
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <?php if ($msg) { ?>
                                                <div class="alert alert-success" role="alert">
                                                    <strong>Well done!</strong> <?php echo htmlentities($msg); ?>
                                                </div>
                                            <?php } ?>

                                            <?php if ($error) { ?>
                                                <div class="alert alert-danger" role="alert">
                                                    <strong>Oh snap!</strong> <?php echo htmlentities($error); ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>

                                    <?php
                                    $aid = intval($_GET['said']);
                                    $query = mysqli_query($con, "Select * from  tbladmin where id='$aid'");
                                    $cnt = 1;
                                    while ($row = mysqli_fetch_array($query)) {
                                    ?>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <form id="formulir" class="form-horizontal" name="suadmin" method="post">
                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">Username</label>
                                                        <div class="col-md-10">
                                                            <input type="text" class="form-control" value="<?php echo htmlentities($row['AdminUserName']); ?>" name="adminusernmae" readonly>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">Email </label>
                                                        <div class="col-md-10">
                                                            <input type="email" class="form-control" value="<?php echo htmlentities($row['AdminEmailId']); ?>" name="emailid" id="emailid" required>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">Creation Date</label>
                                                        <div class="col-md-10">
                                                            <input type="text" class="form-control" value="<?php echo htmlentities($row['CreationDate']); ?>" name="cdate" readonly>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">Updation date</label>
                                                        <div class="col-md-10">
                                                            <input type="text" class="form-control" value="<?php echo htmlentities($row['UpdationDate']); ?>" name="udate" readonly>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">User type</label>
                                                        <div class="col-md-10">
                                                            <input type="radio" id="userType" name="userType" value="1" <?php if (isset($_POST['userType']) && $_POST['userType'] == 1): ?>checked='checked'<?php endif; ?> required>
                                                            <label for="1">1. Admin</label><br>
                                                            <input type="radio" id="userType" name="userType" value="2" <?php if (isset($_POST['userType']) && $_POST['userType'] == 2): ?>checked='checked'<?php endif; ?> required>
                                                            <label for="2">2. Guest</label><br>
                                                        </div>
                                                    </div>

                                                <?php } ?>
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">&nbsp;</label>
                                                    <div class="col-md-10">

                                                        <button type="submit" class="btn btn-custom waves-effect waves-light btn-md" name="submit">
                                                            Update
                                                        </button>
                                                    </div>
                                                </div>

                                                </form>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php include('includes/footer.php'); ?>

            </div>
        </div>

        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>
        <script src="../plugins/switchery/switchery.min.js"></script>

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    

    <script>
        $(document).ready(function () {
            $("#formulir").validate({
                rules: {
                    emailid: {
                        required: true,
                        email: true
                    }
                },
                messages: {
                    email: {
                        email: "<span style='font-size:14px;'>The email should be in the format: abc@domain.tld</span>"
                    }
                }
            });
        });
    </script>

    </body>

    </html>
<?php } ?>