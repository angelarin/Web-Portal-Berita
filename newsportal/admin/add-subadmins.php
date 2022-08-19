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

    // Code for Add New Sub Admin
    if (isset($_POST['submit'])) {
        $username = $_POST['sadminusername'];
        $email = $_POST['emailid'];
        $password = md5($_POST['pwd']);
        $usertype = $_POST['userType'];
        $query = mysqli_query($con, "insert into tbladmin(AdminUserName,AdminEmailId,AdminPassword,userType ) values('$username','$email','$password','$usertype')");
        if ($query) {
            echo "<script>alert('Sub-admin details added successfully.');</script>";
            echo "<script type='text/javascript'> document.location = 'add-subadmins; </script>";
        } else {
            echo "<script>alert('Something went wrong. Please try again.');</script>";
        }
    }

?>


    <!DOCTYPE html>
    <html lang="en">

    <head>

        <title>Newsportal | Add Account</title>

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
        <script>
            function checkAvailability() {
                $("#loaderIcon").show();
                jQuery.ajax({
                    url: "check_availability.php",
                    data: 'username=' + $("#sadminusername").val(),
                    type: "POST",
                    success: function(data) {
                        $("#user-availability-status").html(data);
                        $("#loaderIcon").hide();
                    },
                    error: function() {}
                });
            }
        </script>
    </head>


    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            <?php include('includes/topheader.php'); ?>

            <?php include('includes/leftsidebar.php'); ?>

            <div class="content-page">
                <div class="content">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">Add Account</h4>
                                    <ol class="breadcrumb p-0 m-0">
                                        <li>
                                            <a href="dashboard.php">Dashboard</a>
                                        </li>
                                        <li class="active">
                                            Add Account
                                        </li>
                                    </ol>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box">
                                    <h4 class="m-t-0 header-title"><b>Add Account </b></h4>
                                    <hr />
                                    <div class="row">
                                        <div class="col-md-6">
                                            <form class="form-horizontal" name="addsuadmin" method="post">
                                                <div class="form-group">
                                                    <label for="exampleInputusername">Username (used for login)</label>
                                                    <input type="text" placeholder="Enter Sub-Admin Username" name="sadminusername" id="sadminusername" class="form-control" pattern="^[a-zA-Z][a-zA-Z0-9-_.]{5,12}$" title="Username must be alphanumeric 6 to 12 chars" onBlur="checkAvailability()" required>
                                                    <span id="user-availability-status" style="font-size:14px;"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label for="emailid">Email Id</label>
                                                    <input type="email" class="form-control" id="emailid" name="emailid" placeholder="Enter email" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="password">Password</label>
                                                    <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Enter password" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="password">User Type</label><br>
                                                    <input type="radio" id="userType" name="userType" value="1" required>
                                                    <label for="1">1. Admin</label><br>
                                                    <input type="radio" id="userType" name="userType" value="2" required>
                                                    <label for="2">2. Guest</label><br>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">&nbsp;</label>
                                                    <div class="col-md-10">
                                                        <button type="submit" class="btn btn-custom waves-effect waves-light btn-md" id="submit" name="submit">
                                                            Submit</button>
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

    </body>

    </html>
<?php } ?>