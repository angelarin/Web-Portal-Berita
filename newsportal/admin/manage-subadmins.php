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

    if ($_GET['action'] == 'del' && $_GET['rid']) {
        $id = intval($_GET['rid']);
        $query = mysqli_query($con, "delete from  tbladmin  where id='$id' && userType=2");
        echo "<script>alert('Guest details deleted.');</script>";
        echo "<script type='text/javascript'> document.location = 'manage-subadmins.php'; </script>";
    }

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>

        <title> | Manage Account</title>
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="../plugins/switchery/switchery.min.css">
        <script src="assets/js/modernizr.min.js"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

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
                                    <h4 class="page-title">Manage Account</h4>
                                    <ol class="breadcrumb p-0 m-0">

                                        <li>
                                            <a href="dashboard.php">Dashboard</a>
                                        </li>
                                        <li class="active">
                                            Manage Account
                                        </li>
                                    </ol>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="demo-box m-t-20">
                                    <div class="m-b-30">
                                        <a href="add-subadmins.php">
                                            <button id="addToTable" class="btn btn-success waves-effect waves-light">Add <i class="mdi mdi-plus-circle-outline"></i></button>
                                        </a>
                                    </div>

                                    <div class="table-responsive">
                                        <table id="account">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th> Username</th>
                                                    <th>Email</th>

                                                    <th>Posting Date</th>
                                                    <th>Last updation Date</th>
                                                    <th>User type</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $query = mysqli_query($con, "Select * from  tbladmin");
                                                $cnt = 1;
                                                while ($row = mysqli_fetch_array($query)) {
                                                ?>

                                                    <tr>
                                                        <th scope="row"><?php echo htmlentities($cnt); ?></th>
                                                        <td><?php echo htmlentities($row['AdminUserName']); ?></td>
                                                        <td><?php echo htmlentities($row['AdminEmailId']); ?></td>
                                                        <td><?php echo htmlentities($row['CreationDate']); ?></td>
                                                        <td><?php echo htmlentities($row['UpdationDate']); ?></td>
                                                        <td><?php if($row['userType']==1){ echo 'admin';} else {echo 'guest';} ?></td>
                                                        <td><a href="edit-subadmin.php?said=<?php echo htmlentities($row['id']); ?>"><i class="fa fa-pencil" style="color: #29b6f6;"></i></a>
                                                            &nbsp;<a href="manage-subadmins.php?rid=<?php echo htmlentities($row['id']); ?>&&action=del"> <i class="fa fa-trash-o" style="color: #f05050"></i></a> </td>
                                                    </tr>
                                                <?php
                                                    $cnt++;
                                                } ?>
                                            </tbody>
                                            <script>
                                                $(document).ready(function() {
                                                    $('#account').DataTable();
                                                });
                                            </script>

                                        </table>
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