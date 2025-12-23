
<?php
include('connection.php');
?>


<!DOCTYPE html>
<html lang="en">
	
<!-- Mirrored from laravel.spruko.com/spruha/ltr/signin by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 26 Jun 2021 13:32:33 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>

		<meta charset="utf-8">
		<meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
		
        <!-- Favicon -->
		<link rel="icon" href="assets/img/favicon.png" type="image/png"/>

		<!-- Title -->
		<title>India Mart | Shop Smart. Save More.</title>

		<!-- Bootstrap css-->
		<link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>

		<!-- Icons css-->
		<link href="assets/plugins/web-fonts/icons.css" rel="stylesheet"/>
		<link href="assets/plugins/web-fonts/font-awesome/font-awesome.min.css" rel="stylesheet">
		<link href="assets/plugins/web-fonts/plugin.css" rel="stylesheet"/>

		<!-- Style css-->
		<link href="assets/css/style/style.css" rel="stylesheet">
		<link href="assets/css/skins.css" rel="stylesheet">
		<link href="assets/css/dark-style.css" rel="stylesheet">
		<link href="assets/css/colors/default.css" rel="stylesheet">

		
		<!-- Color css-->
		<link id="theme" rel="stylesheet" type="text/css" media="all" href="assets/css/colors/color.css">

		<!-- Switcher css-->
		<link href="assets/switcher/css/switcher.css" rel="stylesheet">
		<link href="assets/switcher/demo.css" rel="stylesheet">
		


	</head>

	<body class="main-body leftmenu">

		<div class="page main-signin-wrapper bgship2">

			<!-- Row -->
			<div class="row signpages text-center">
				<div class="col-md-12">
					<div class="card">
						<div class="row row-sm">
							<div class="col-lg-6 col-xl-5 d-none d-lg-block text-center bg-primary details">
								<div class="mt-5 pt-4 p-2 pos-absolute">
									<a href="index.php"> <img src="assets/img/brand/logo.png" class="header-brand-img mb-4" alt="logo"></a>
									<div class="clearfix"></div>
									<img src="assets/img/svgs/user.svg" class="ht-100 mb-0" alt="user">
									<h5 class="mt-4 text-white">Create Your Account</h5>
									<span class="tx-white-6 tx-13 mb-5 mt-xl-0">Signup to create, discover and connect with the global community</span>
								</div>
							</div>
							<div class="col-lg-6 col-xl-7 col-xs-12 col-sm-12 login_form ">
								<div class="container-fluid">
									<div class="row row-sm">
										<div class="card-body mt-2 mb-2">
											<img src="assets/img/brand/logo.png" class=" d-lg-none header-brand-img text-left float-left mb-4" alt="logo">
											<div class="clearfix"></div>
											<form method="post">
												<h5 class="text-left mb-2">Signin to Your Account</h5>
												<p class="mb-4 text-muted tx-13 ml-0 text-left">Signin to create, discover and connect with the global community</p>
												<div class="form-group text-left">
													<label>Role</label>
													<select class="form-control" name="role">
														<option value="1">Admin</option>
														<option value="2">User</option>
														</select>
												</div>
												
												
												<div class="form-group text-left">
													<label>Username</label>
													<input class="form-control" name="username" placeholder="Enter your email" type="text">
												</div>
												<div class="form-group text-left">
													<label>Password</label>
													<input class="form-control" name="pass" placeholder="Enter your password" type="password">
												</div>
												<button  type="submit" name="s" class="btn ripple btn-main-primary btn-block">Sign In</button>
											</form>
											<div class="text-left mt-5 ml-0">
												<div class="mb-1"><a href="forgetpassword.php">Forgot password?</a></div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- End Row -->

		</div>


		
<?php

if (isset($_POST['s'])) {

    $username = trim($_POST['username']);
    $password = trim($_POST['pass']);
    $role     = trim($_POST['role']);

    // Main query
    $sql = mysqli_query($db, "SELECT * FROM staff WHERE username='$username' AND password='$password' AND role='$role'");

    // Checks
    $checkUser = mysqli_query($db, "SELECT * FROM staff WHERE username='$username'");
    $checkPass = mysqli_query($db, "SELECT * FROM staff WHERE username='$username' AND password='$password'");
    $checkRole = mysqli_query($db, "SELECT * FROM staff WHERE username='$username' AND password='$password' AND role!='$role'");

    if (mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_assoc($sql);

        $_SESSION['admin'] = $row['username'];  // store username
        $_SESSION['role']  = $row['role'];      // store role

        header("Location: index.php");
        exit;
    } elseif (mysqli_num_rows($checkUser) == 0) {
        msg("Invalid username", "login.php");
    } elseif (mysqli_num_rows($checkPass) == 0) {
        msg("Invalid password", "login.php");
    } elseif (mysqli_num_rows($checkRole) > 0) {
        msg("Invalid role", "login.php");
    } else {
        msg("Invalid username, password or role", "login.php");
    }
}
?>

















		<!-- End Page -->

		<!-- Jquery js-->
		<script src="assets/plugins/jquery/jquery.min.js"></script>

		<!-- Bootstrap js-->
		<script src="assets/plugins/bootstrap/js/popper.min.js"></script>
		<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>

		<!-- Select2 js-->
		<script src="assets/plugins/select2/js/select2.min.js"></script>

		
		<!-- Custom js -->
		<script src="assets/js/custom.js"></script>

		<!-- Switcher js -->
		<script src="assets/switcher/js/switcher.js"></script>
		

		

	</body>

<!-- Mirrored from laravel.spruko.com/spruha/ltr/signin by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 26 Jun 2021 13:32:34 GMT -->
</html>