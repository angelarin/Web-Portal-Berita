<?php
session_start();
include('includes/config.php');
if (isset($_POST['login'])) {

    $uname = $_POST['username'];
    $password = md5($_POST['password']);
    $sql = mysqli_query($con, "SELECT AdminUserName,AdminEmailId,AdminPassword,userType FROM tbladmin WHERE (AdminUserName='$uname' && AdminPassword='$password')");
    $num = mysqli_fetch_array($sql);
    if ($num > 0) {

        $row = mysqli_fetch_assoc($sql);
        if ($num['userType'] == "1") {
            $_SESSION['login'] = $_POST['username'];
            $_SESSION['utype'] = $num['userType'];

            echo '<script language="javascript">alert("Anda berhasil Login Admin!"); document.location = "dashboard.php";</script>';
        } else if ($num['userType'] == "2") {
            $_SESSION['login'] = $_POST['username'];
            $_SESSION['utype'] = $num['userType'];

            echo '<script language="javascript">alert("Anda berhasil Login Guest!"); document.location = "../guest/index-guest.php";</script>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css'>
	<link rel="stylesheet" href="./style.css">
    <link href="../images/logoe.png" rel="icon">
    <title>E-Zone | Gaming News</title>
</head>

<body>

	<h2>E-Zone Your Everyday Online Gaming News</h2>
	<div class="container" id="container">
		<div class="form-container sign-up-container">
			<form method="POST" id="basic-form" action="register.php" class="my-login-validation" novalidate="">
			<h1>Create Account</h1>
			<input id="username" type="text" placeholder="Username" class="form-control" name="username" onBlur="checkAvailability()" required>
			<span id="user-availability-status" style="font-size:14px;"></span>
			<div class="invalid-feedback"></div>
			<input id="email" type="email" placeholder="Email" class="form-control" name="email" required>
			<div class="invalid-feedback"></div>
			<input id="password" type="password" placeholder="Password" class="form-control" name="password" required data-eye>
			<div class="invalid-feedback"></div>
			<button type="submit" id="submit" name="submit" value="SUBMIT" class="btn btn-primary btn-block">Sign Up</button>
			</form>
		</div>
		<div class="form-container sign-in-container">
		<form method="post">
				<h1>Sign in</h1>

				<span>or use your account</span>
				<input class="form-control" type="text" required="" name="username" placeholder="Username or Email" autocomplete="off">
				<input class="form-control" type="password" name="password" required="" placeholder="Password" autocomplete="off">
				<a href="forgot-password.php">Forgot your password?</a>
				<button class="btn w-md btn-bordered btn-danger waves-effect waves-light" type="submit" name="login">Sign In</button>
			</form>
		</div>
		<div class="overlay-container">
			<div class="overlay">
				<div class="overlay-panel overlay-left">
					<h1>Welcome Back!</h1>
					<p>To keep connected with us please login with your personal info</p>
					<button class="ghost" id="signIn">Sign In</button>
				</div>
				<div class="overlay-panel overlay-right">
					<h1>Hello, Friend!</h1>
					<p>Enter your personal details and start journey with us</p>
					<button class="ghost" id="signUp">Sign Up</button>
				</div>
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
                        minlength: "<span style='font-size:14px;'>Username must be at least 5 characters</span>"
                    },
                    password: {
                        required: "<p style='font-size:14px;'>Please enter your password</p>",
                        min: "<span style='font-size:14px;'>Password should be at least 8 character</span>"
                    },
                    email: {
                        email: "<span style='font-size:14px;'>The email should be in the format: abc@domain.tld</span>"
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