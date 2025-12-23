


<!DOCTYPE html>
<html lang="en">
	
<!-- Mirrored from laravel.spruko.com/spruha/ltr/index by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 26 Jun 2021 13:27:27 GMT -->
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

		<!-- Select2 css-->
        <link href="assets/plugins/select2/css/select2.min.css" rel="stylesheet">
		
				<!-- Internal Specturm-color picker css-->

		<!-- Internal Ion.rangeslider css-->
		<link href="assets/plugins/ion-rangeslider/css/ion.rangeSlider.css" rel="stylesheet">
		<link href="assets/plugins/ion-rangeslider/css/ion.rangeSlider.skinFlat.css" rel="stylesheet">
		<link href="assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
		<link href="assets/plugins/datatable/dataTables.bootstrap4.min.css" rel="stylesheet" />
		<link href="assets/plugins/datatable/responsivebootstrap4.min.css" rel="stylesheet" />
		<link href="assets/plugins/datatable/fileexport/buttons.bootstrap4.min.css" rel="stylesheet" />

		<link href="assets/plugins/sweet-alert/sweetalert.css" rel="stylesheet">
		
		<!-- Sidemenu css-->
		<link href="assets/css/sidemenu/sidemenu.css" rel="stylesheet">

		<!-- Switcher css-->
		<link href="assets/switcher/css/switcher.css" rel="stylesheet">
		<link href="assets/switcher/demo.css" rel="stylesheet">
	</head>

	<body class="main-body leftmenu">

		

		<!-- Page -->
		<div class="page">

        <?php
		include('header.php');
		?>
		<?php
if(isset($_GET['id']))

$id=$_GET['id'];
$ss=mysqli_query($db,"select * from staff where id='$id'");
$rs=mysqli_fetch_row($ss);

?> 

			<!-- Mobile-header closed -->
			<!-- Main Content-->
			<div class="main-content side-content pt-0">
				<div class="container-fluid">
					<div class="inner-body">

		
						<!-- Page Header -->
						<div class="page-header">
							<div>
								<h2 class="main-content-title tx-24 mg-b-5">Manage Staff </h2>
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Pages</a></li>
									<li class="breadcrumb-item active" aria-current="page">Manage Staff</li>
								</ol>
							</div>
							
						</div>
						





<form  method="Post" enctype="multipart/form-data">
						


						<div class="row row-sm">
							<div class="col-lg-12 col-md-12">
								<div class="card custom-card">
									<div class="card-body">
										<div>
											<h6 class="main-content-label mb-1">Add Staff</h6>
											
										</div>

										<div class="row row-sm">
											<div class="col-lg">
												<label>Staff name </label>
												<input class="form-control" placeholder="Staff Name" name="name" type="text" value="<?php echo $rs[2]?>" required="">
											</div>
											<div class="col-lg">
												<label>Username</label>
												<input class="form-control" placeholder="username" name="username" type="text" value="<?php echo $rs[3]?>" required="">
											</div>

											<div class="col-lg">
												<label>Password</label>
												<input class="form-control" placeholder="Password" name="password" type="password" value="<?php echo $rs[4]?>" required="">
											</div>
											<div class="col-lg">
												<label>Email id</label>
												<input class="form-control" placeholder="Email Id " name="email" type="text" value="<?php echo $rs[5]?>" required="" >
											</div>
											<div class="col-lg mg-t-10 mg-lg-t-0">
												<div class="row row-sm">
													<label>Image</label>
													<div class="col-sm-12 col-md-12 col-lg-12">
														<div class="input-group file-browser">
															
															<input type="text" class="form-control border-right-0 browse-file" placeholder="Upload Image" name="img" readonly  required="">
															<label class="input-group-btn">
																<span class="btn btn-primary">
																	Browse <input type="file" name="img" style="display: none;">
																	
																</span>
																 
															</label>
														</div>
														<img src="assets/images/staff/<?php echo $rs[1]?>" width="100%" height="auto">
													</div>
												</div>
											</div>	
<!-- 

											<div class="col-lg">
													<div class="input-group">
														<div class="input-group-prepend">
															<div class="input-group-text">
																<i class="fe fe-calendar lh--9 op-6"></i>
															</div>
														</div>
														<input class="form-control fc-datepicker" placeholder="DOB" type="text">
													</div>

											</div> -->

											
																					
										</div>
										
										<div class="row row-sm">
											<!-- <div class="col-lg">
												<input class="form-control" placeholder="Email ID" type="email"  required="">
											</div> -->
											<div class="col-lg">
												<input class="form-control" placeholder="Phone Number" type="number" name="ph"  value="<?php echo $rs[6]?>" required="">
											</div>
											<!-- <div class="col-lg">
												<select class="form-control select2">
													<option label="Departments">
													</option>
													<option value="Firefox">
														Crew Change
													</option>
													<option value="Chrome">
														Ship Chandling
													</option>
													<option value="Safari">
														Garbage Management
													</option>
													<option value="Opera">
														Logistics
													</option>
													<option value="Internet Explorer">
														Import & Export
													</option>
													<option value="Internet Explorer">
														Office Management
													</option>
												</select>
											</div> -->
											
											
											<div class="col-lg mg-t-10 mg-lg-t-0">
												
												<input class="form-control" placeholder="Designation" type="text" name="designation" value="<?php echo $rs[7]?>" required="">
											</div>
												
											<div class="col-lg mg-t-10 mg-lg-t-0">
											<select class="form-control select2"  name="role">
													
													<option value="1">
													Admin
													</option>
													<option value="2">
														Staff
													</option>
													<!-- <option value="Safari">
														Garbage Management
													</option>
													<option value="Opera">
														Logistics
													</option>
													<option value="Internet Explorer">
														Import & Export
													</option>
													<option value="Internet Explorer">
														Office Management
													</option> -->
												</select>
											</div>
											</div>
											
											<div class="row row-sm mg-t-20">
											<div class="col-lg">
												<textarea class="form-control" placeholder="Address" name="address" rows="5"><?php echo $rs[9]?></textarea>
											</div>
											
										</div>
										
										</div>
										
												
										



										<!-- <div>
											<h6 class="main-content-label mg-t-20">Shift Duty to</h6>
											
										</div> -->

										
										<!-- <div class="row row-sm"> -->
											
											
											
											<!-- <div class="col-lg mg-t-10 mg-lg-t-0">
												<div class="input-group">
													<div class="input-group-prepend">
														<div class="input-group-text">
															<i class="fe fe-calendar  lh--9 op-6"></i>
														</div>
													</div><input type="text" class="form-control pull-right" id="reservation">
												</div>
											</div>											 -->
										</div>

										
										
										<div class="mg-t-20">
											<button type="submit"  name="sub" class="btn ripple btn-primary mb-1">Add Staff</button>
											<button type="button" class="btn ripple btn-secondary mb-1">Cancel</button>
											
										</div>
									</div>
								</div>
							</div>
						</div>


<?php
if(isset($_POST['sub'])) {
$name   = addslashes($_POST['name']);
$username    = addslashes($_POST['username']);
$password  = addslashes($_POST['password']);
$email      = addslashes($_POST['email']);
$contactno    = addslashes($_POST['ph']);
$designation  = addslashes($_POST['designation']);
$role      = addslashes($_POST['role']);
$address      = addslashes($_POST['address']);

    // check if new image uploaded
    if(isset($_FILES['img']['name']) && $_FILES['img']['name'] != "") {
        $fileName1    = $_FILES['img']['name'];
        $fileTmpPath1 = $_FILES['img']['tmp_name'];
        $fileSize1    = $_FILES['img']['size'];
        $fileType1    = $_FILES['img']['type'];
        $fileNameCmps1  = explode(".", $fileName1);
        $fileExtension1 = strtolower(end($fileNameCmps1));
        
        $newFileName1 = md5(time() . $fileName1) . '.' . $fileExtension1;
        $allowedfileExtensions1 = array('jpg', 'gif', 'png', 'jpeg','webp');

        if (in_array($fileExtension1, $allowedfileExtensions1)) {
            $uploadFileDir1 = "assets/images/staff/"; 
            $dest_path1     = $uploadFileDir1 . $newFileName1;

            // update with new image
            $upd = mysqli_query($db, "UPDATE staff 
                SET  img1='$newFileName1' WHERE id='$id'");

            if($upd) {
                move_uploaded_file($fileTmpPath1, $dest_path1);
                msg("Successfully updated","addstaff.php");
            } else {
                msg("Database error, please try again","addstaff.php");
            }
        } else {
            msg("Image extension should be jpg, jpeg, gif, png or webp", "addstaff.php");
        }
    } else {
        // update without image
        $upd = mysqli_query($db, "UPDATE `staff` SET `img1`='$newFileName1',`name`='$name ',`username`='$username',`password`='$password ',`email`='$email',`ph`='$contactno',`destination`='$designation',`role`='$role',`address`='$address'
            WHERE id='$id'");

        if($upd) {
            msg("Successfully updated","addstaff.php");
        } else {
            msg("Database error, please try again","addstaff.php");
        }
    }
}
?>

						</form>
						

													<!-- <tr>
														<td>Aravind</td>
														<td>
															<div class="main-img-user avatar-lg online text-center">
																<img alt="avatar" class="rounded-circle" src="assets/img/users/5.jpg">
															</div>
														</td>
														<td>Crew Change</td>
														<td>Operator</td>
														
														<td><a href="#"><i class="fe fe-edit-2 text-primary mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Edit"></i></a></td>
														<td id='swal-warning'><i class="fe fe-trash-2 text-danger mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Delete" aria-describedby="tooltip13131"></i></td>
													</tr> -->

													
												</tbody>
											</table>
									</div>
								</div>
							</div>
						</div>
						


					</div>
				</div>
			</div>
			<!-- End Main Content-->

		<!-- Main Footer-->
			<div class="main-footer text-center">
				<div class="container">
					<div class="row row-sm">
						<div class="col-md-12">
							<span>Copyright © 2024 India Mart. Designed by <a href="https://Dsign-pods.com/">Dsign-pods</a> All rights reserved.</span>
						</div>
					</div>
				</div>
			</div>
			<!--End Footer-->				<!-- Sidebar -->
			
			<!-- End Sidebar -->
		</div>
        <!-- End Page -->

        <!-- Back-to-top -->
		<a href="#top" id="back-to-top"><i class="fe fe-arrow-up"></i></a>

		<!-- Jquery js-->
		<script src="assets/plugins/jquery/jquery.min.js"></script>

		<!-- Bootstrap js-->
		<script src="assets/plugins/bootstrap/js/popper.min.js"></script>
        <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        
		<!-- Select2 js-->
		<script src="assets/plugins/select2/js/select2.min.js"></script>

		<!-- Perfect-scrollbar js -->
		<script src="assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>

		<!-- Sidemenu js -->
		<script src="assets/plugins/sidemenu/sidemenu.js"></script>

		<!-- Sidebar js -->
		<script src="assets/plugins/sidebar/sidebar.js"></script>
		
		        <!-- Internal Select2 js-->
        <script src="assets/js/select2.js"></script>

		<!-- Internal Jquery-Ui js-->
		<script src="assets/plugins/jquery-ui/ui/widgets/datepicker.js"></script>

		<!-- Internal Jquery.maskedinput js-->
		<script src="assets/plugins/jquery.maskedinput/jquery.maskedinput.js"></script>

		<!-- Internal Specturm-colorpicker js-->
		<script src="assets/plugins/spectrum-colorpicker/spectrum.js"></script>

		<!-- Internal Ion-rangeslider js-->
        <script src="assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js"></script>
<script src="assets/plugins/bootstrap-daterangepicker/moment.min.js"></script>
		<script src="assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
		<!-- Internal Form-elements js-->
		<script src="assets/js/form-elements.js"></script>
		
		<script src="assets/js/sticky.js"></script>

		<script src="assets/js/custom.js"></script>
		
		<script src="assets/plugins/datatable/jquery.dataTables.min.js"></script>
		<script src="assets/plugins/datatable/dataTables.bootstrap4.min.js"></script>
		<script src="assets/plugins/datatable/dataTables.responsive.min.js"></script>
		<script src="assets/plugins/datatable/fileexport/dataTables.buttons.min.js"></script>
		<script src="assets/plugins/datatable/fileexport/buttons.bootstrap4.min.js"></script>
		<script src="assets/plugins/datatable/fileexport/jszip.min.js"></script>
		<script src="assets/plugins/datatable/fileexport/pdfmake.min.js"></script>
		<script src="assets/plugins/datatable/fileexport/vfs_fonts.js"></script>
		<script src="assets/plugins/datatable/fileexport/buttons.php5.min.js"></script>
		<script src="assets/plugins/datatable/fileexport/buttons.print.min.js"></script>
		<script src="assets/plugins/datatable/fileexport/buttons.colVis.min.js"></script>
		<script src="assets/js/table-data.js"></script>




		<script src="assets/plugins/jquery-ui/ui/widgets/datepicker.js"></script>
		<script src="assets/plugins/bootstrap-daterangepicker/moment.min.js"></script>
		<script src="assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
		<script src="assets/plugins/fileuploads/js/fileupload.js"></script>
        <script src="assets/plugins/fileuploads/js/file-upload.js"></script>
		<script src="assets/plugins/fancyuploder/jquery.ui.widget.js"></script>
        <script src="assets/plugins/fancyuploder/jquery.fileupload.js"></script>
        <script src="assets/plugins/fancyuploder/jquery.iframe-transport.js"></script>
        <script src="assets/plugins/fancyuploder/jquery.fancy-fileupload.js"></script>
        <script src="assets/plugins/fancyuploder/fancy-uploader.js"></script>
		<script src="assets/js/advanced-form-elements.js"></script>
		<script src="assets/plugins/sumoselect/jquery.sumoselect.js"></script>

		<!-- Internal Sweet-Alert js-->
		<script src="assets/plugins/sweet-alert/sweetalert.min.js"></script>
		<script src="assets/plugins/sweet-alert/jquery.sweet-alert.js"></script>
	</body>

<!-- Mirrored from laravel.spruko.com/spruha/ltr/formelements by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 26 Jun 2021 13:32:00 GMT -->
</html>