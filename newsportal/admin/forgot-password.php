<?php
session_start();
error_reporting(0);
include('includes/config.php');

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = md5($_POST['newpassword']);
    $query = mysqli_query($con, "select id from tbladmin where  AdminEmailId='$email' and AdminUserName='$username' ");

    $ret = mysqli_num_rows($query);
    if ($ret > 0) {
        $query1 = mysqli_query($con, "update tbladmin set AdminPassword='$password'  where  AdminEmailId='$email' && AdminUserName='$username' ");
        if ($query1) {
            echo "<script>alert('Password successfully changed');</script>";
            echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
        }
    } else {

        echo "<script>alert('Invalid Details. Please try again.');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>CodePen - Weekly Coding Challenge #1 - Double slider Sign in/up Form - Desktop Only</title>
	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css'>
	<link rel="stylesheet" href="./style2.css">

</head>

<body>
	<a href="forgot-password.php"><h1>Reset Your Password</h1> </a>			
	<div class="account-content">
                                    <form class="form-horizontal" method="post">
<a></a>
                                        <div class="form-group ">
                                            <div class="col-xs-12">
                                                <input class="form-control" type="text" required="" name="username" placeholder="Username" autocomplete="off">
                                            </div>
                                        </div>
<div class="form-group ">
                                            <div class="col-xs-12">
                                                <input class="form-control" type="text" required="" name="email" placeholder="Email" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-xs-12">
                                               <input type="password" class="form-control" id="userpassword" name="confirmpassword" placeholder="New Password">
                                            </div>
                                        </div>
<div class="form-group">
                                            <div class="col-xs-12">
                                               <input type="password" class="form-control" id="userpassword" name="newpassword" placeholder="Confirm Password">
                                            </div>
                                        </div>
<a></a>
                     
                                        <div class="form-group account-btn text-center m-t-10">
                                            <div class="col-xs-12">
                                                <button class="btn w-md btn-bordered btn-danger waves-effect waves-light" type="submit" name="submit">Reset</button>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
<a href="../index.php"><i class="mdi mdi-home"></i> Back Home</a>
                                    </form>

                                    
                                </div>
                            </div>
	</div>
	<script src="./script.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    

    <script>
        $(document).ready(function () {
            $("#basic-form").validate({
                rules: {
                    username: {
                        required: true,
                        minlength: 5
                    },
                    password: {
                        required: true,
                        minlength: 8
                    },
                    email: {
                        required: true,
                        email: true
                    }
                },
                messages: {
                    username: {
                        minlength: "Username should be at least 5 characters"
                    },
                    password: {
                        required: "Please enter your password",
                        min: "Password should be at least 8 character"
                    },
                    email: {
                        email: "The email should be in the format: abc@domain.tld"
                    }
                }
            });
        });
    </script>
    <script>
        function checkAvailability() {
            $("#loaderIcon").show();
            jQuery.ajax({
                url: "check_availability.php",
                data: 'username=' + $("#username").val(),
                type: "POST",
                success: function(data) {
                    $("#user-availability-status").html(data);
                    $("#loaderIcon").hide();
                },
                error: function() {}
            });
        }
    </script>
</body>
</html>