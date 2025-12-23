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

        <!-- Sidemenu -->
			<?php
			include('header.php');
			?>
			<!-- End Sidemenu -->        <!-- Main Header-->
			<div class="main-header side-header sticky">
				<div class="container-fluid">
					<div class="main-header-left">
						<a class="main-header-menu-icon" href="#" id="mainSidebarToggle"><span></span></a>
					</div>
					<div class="main-header-center">
						<div class="responsive-logo">
							<a href="index.php"><img src="assets/img/brand/logo.png" class="mobile-logo" alt="logo"></a>
							<a href="index.php"><img src="assets/img/brand/logo-light.png" class="mobile-logo-dark" alt="logo"></a>
						</div>
						
					</div>
					<div class="main-header-right">
						
						
						<div class="dropdown d-md-flex">
							<a class="nav-link icon full-screen-link" href="#">
								<i class="fe fe-maximize fullscreen-button fullscreen header-icons"></i>
								<i class="fe fe-minimize fullscreen-button exit-fullscreen header-icons"></i>
							</a>
						</div>
						
						
						<div class="dropdown main-profile-menu">
							<a class="d-flex" href="profile.php">
								<span class="main-img-user" ><img alt="avatar" src="assets/img/brand/logo.png"></span>
							</a>
							<div class="dropdown-menu">
								<div class="header-navheading">
									<h6 class="main-notification-title">Admin</h6>
									<p class="main-notification-text">India Mart</p>
								</div>
								
								
																
								<a class="dropdown-item" href="login.php">
									<i class="fe fe-power"></i> Sign Out
								</a>
							</div>
						</div>
						
					</div>
				</div>
			</div>
			<!-- Mobile-header closed -->
			<!-- Main Content-->
			<div class="main-content side-content pt-0">
				<div class="container-fluid">
					<div class="inner-body">

		
						<!-- Page Header -->
						<div class="page-header">
							<div>
								<h2 class="main-content-title tx-24 mg-b-5">Manage Products </h2>
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Pages</a></li>
									<li class="breadcrumb-item active" aria-current="page">Manage Products</li>
								</ol>
							</div>
							
						</div>
						


<?php
if(isset($_GET['id']))
$id=$_GET['id'];
$s=mysqli_query($db,"select * from products where id='$id'");
$r=mysqli_fetch_row($s);
 $existingFeatures = explode(",", $r[14]);
?>  



						


						<div class="row row-sm">
							<div class="col-lg-12 col-md-12">
								<div class="card custom-card">
									<div class="card-body">
										<div>
											<h6 class="main-content-label mb-1">Add Products</h6>
											
										</div>

										<form method="post" enctype="multipart/form-data">
										<div class="row row-sm">
											

											<div class="col-lg">
												<label>Category Name </label>

												<select class="form-control select2" name="a">

<?php
$scat=mysqli_query($db,"select * from category where id='$r[2]'");
$rcat=mysqli_fetch_row($scat);
?>
<option value="<?php echo $rcat[0];?>"><?php echo $rcat[1];?></option>
                                <?php
$sc=mysqli_query($db,"select * from category ");
while($rc=mysqli_fetch_row($sc))
{

?>
            <option value="<?php echo $rc[0];?>"><?php echo $rc[1];?></option>
			<?php
}
?>
                            </select>
											</div>

											
											<div class="col-lg">
												<label>Weight </label>
												<select class="form-control select2" name="b">
<?php
$sw=mysqli_query($db,"select * from weight where id='$r[3]'");
$rw=mysqli_fetch_row($sw);
?>
                                 <option value="<?php echo $rw[0];?>"><?php echo $rw[1];?></option>
                                <?php
$sw1=mysqli_query($db,"select * from weight");
while($rw1=mysqli_fetch_row($sw1))
{
?>
            <option value="<?php echo $rw1[0];?>"><?php echo $rw1[1];?></option>
			<?php
}
?>
                            </select>
											</div>										
										</div>
										<div class="row row-sm mg-t-20">
											<div class="col-lg">
												<input class="form-control" placeholder="Product Name" name="c"  value="<?php echo $r[4]?>" type="text" required="">
											</div>

											<div class="col-lg">
												<div class="row row-sm">
													<div class="col-sm-12 col-md-12 col-lg-12">
														<div class="input-group file-browser">
															<input type="text" class="form-control border-right-0 browse-file" placeholder="Upload Image" name="img1" >
															<label class="input-group-btn">
																<span class="btn btn-primary">
																	Browse <input type="file" style="display: none;"  name="img1">
																</span>
															</label>
														</div>
													</div>
                                                     <img alt="avatar" style="width:100px;"  src="assets/images/products/<?php echo $r[1];?>">
												</div>
											</div>	
											
											<div class="col-lg">
												<div class="row row-sm">
													<div class="col-sm-12 col-md-12 col-lg-12">
														<div class="input-group file-browser">
															<input type="text" class="form-control border-right-0 browse-file" placeholder="Upload Image" name="img2[]">
															<label class="input-group-btn">
																<span class="btn btn-primary">
																		Browse Multiple Image <input type="file" style="display: none;" name="img2[]" multiple>
																</span>
															</label>
														</div>
													</div>
                                                    <?php
                    $sqq=mysqli_query(  $db,"select * from pro_subimg where pid='$id'");

                    while($rqq=mysqli_fetch_row($sqq))
                        {
                    ?>
                <div >
                        <img alt="avatar" style="width:100px;"  src="assets/images/products/<?php echo $rqq[2];?>">
                         <a href="delete_subimg.php?id=<?php echo $rqq[0];?>&pid=<?php echo $id;?>" 
                               onclick="return confirm('Delete this image?')" title="Delete">
                                <i class="ti-trash" style="font-size:15px;"></i>
                            </a>


                </div>
                <?php
                        }
                        ?>
												</div>
											</div>	
											
											
											
																					
										</div>


										<div class="row row-sm mg-t-20">
											<div class="col-lg">
												<input class="form-control" placeholder="Old Price" type="text" name="d" value="<?php echo $r[5]?>"  required="">
											</div>
											<div class="col-lg">
												<input class="form-control" placeholder="New Price" type="text"  name="e" value="<?php echo $r[6]?>" required="">
											</div>
											
											
											
											<div class="col-lg mg-t-10 mg-lg-t-0">
												<input class="form-control" name="f" placeholder="Stock" type="text"  value="<?php echo $r[7]?>"required="">
											</div>											
										</div>

										<div class="row row-sm mg-t-20">
											<div class="col-lg">
												<textarea class="form-control" name="g" placeholder="Description" rows="5"><?php echo $r[8]?></textarea>
											</div>
											<div class="col-lg">
												<textarea class="form-control" name="h" placeholder="Care Instruction" rows="5"><?php echo $r[9]?></textarea>
											</div>
											<div class="col-lg mg-t-10 mg-lg-t-0">
												<textarea class="form-control" name="i" placeholder="Return Policy" rows="5"><?php echo $r[10]?></textarea>
												
											</div>	
											
										</div>



										<div>
											<h6 class="main-content-label mg-t-20">Additional Info</h6>
											
										</div>

										<div class="row row-sm mg-t-20">
											<!-- <div class="col-lg">
												<input class="form-control" placeholder="Material" type="text"  required="">
											</div> -->
											<div class="col-lg">
												<input class="form-control" placeholder="Package Information" type="text"  name="j" value="<?php echo $r[11]?>" required="">
											</div>
											<div class="col-lg">
												<input class="form-control" placeholder="Manufacturer" type="text"  name="k" value="<?php echo $r[12]?>" required="">
											</div>
											
											
											<div class="col-lg mg-t-10 mg-lg-t-0">
												<input class="form-control" placeholder="Item Part Number" type="text"  name="l" value="<?php echo $r[13]?>" required="">
											</div>											
										</div>


										<div>
											<h6 class="main-content-label mg-t-20">Showin</h6>
											
										</div>

										 <div class="row row-sm mg-t-20">
                        <div class="col-lg">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="m" value="Offers" 
                                <?php if(in_array("Offers",$existingFeatures)) echo "checked";?>>
                                <label class="form-check-label">Offers</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="n" value="Deal of the Day"
                                <?php if(in_array("Deal of the Day",$existingFeatures)) echo "checked";?>>
                                <label class="form-check-label">Deal of the Day</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="o" value="Best Seller"
                                <?php if(in_array("Best Seller",$existingFeatures)) echo "checked";?>>
                                <label class="form-check-label">Best Seller</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="p" value="Trending"
                                <?php if(in_array("Trending",$existingFeatures)) echo "checked";?>>
                                <label class="form-check-label">Trending</label>
                            </div>
                        </div>
                    </div>
										
										
										
										
										<div class="mg-t-20">
											<button type="submit" name="sub" class="btn ripple btn-primary mb-1">Add Product</button>
											<button type="button" class="btn ripple btn-secondary mb-1">Cancel</button>
											
										</div>
									</div>
								</div>
							</div>
						</div>
</form>
<?php 
if (isset($_POST['sub'])) {   
    // Form inputs
    $a = addslashes($_POST['a']); // category
    $b = addslashes($_POST['b']); // weight
    $c = addslashes($_POST['c']); // product name
    $d = addslashes($_POST['d']); // old price
    $e = addslashes($_POST['e']); // new price
    $f = addslashes($_POST['f']); // stock
    $g = addslashes($_POST['g']); // description
    $h = addslashes($_POST['h']); // care
    $i = addslashes($_POST['i']); // return policy
    $j = addslashes($_POST['j']); // package info
    $k = addslashes($_POST['k']); // manufacturer
    $l = addslashes($_POST['l']); // part number

    // Collect checkbox values into one array
    $features = [];
                    if (isset($_POST['m'])) { $features[] = "Offers"; }
                    if (isset($_POST['n'])) { $features[] = "Deal of the Day"; }
                    if (isset($_POST['o'])) { $features[] = "Best Seller"; }
                    if (isset($_POST['p'])) { $features[] = "Trending"; }
                    $featuresStr = implode(",", $features);


    // Convert to comma-separated string
    $featuresStr = implode(",", $features);

    $pd = date('Y-m-d H:i:s');
    $ud = date('Y-m-d H:i:s');

    // Cover image
    $coverImage = $_FILES['img1']['name'];
    $coverTmp   = $_FILES['img1']['tmp_name'];

    $allowedExt = array('jpg','jpeg','png','gif');

     // update cover image if uploaded
                    if (!empty($_FILES['img1']['name'])) {
                        $coverImage = $_FILES['img1']['name'];
                        $ext = strtolower(pathinfo($coverImage, PATHINFO_EXTENSION));
                        $newCover = md5(time().$coverImage).".".$ext;
                        $uploadDir = "assets/images/products/";
                        move_uploaded_file($_FILES['img1']['tmp_name'], $uploadDir.$newCover);
                        mysqli_query($db,"UPDATE products SET img='$newCover' WHERE id='$id'");
                    }

                    // update product info
                    mysqli_query($db,"UPDATE `products` SET `cid`='$a',`wid`='$b',`name`='$c',`old_price`='$d',
                    `new_price`='$e',`stock`='$f',`description`='$g',`care_instruction`='$h',`return_policy`='$i',`Package_info`='$j',`manufacture`='$k',`item_partnumber`='$l',
                    `showin`='$featuresStr',`pdate`='$pd',`udate`='$ud'
                        WHERE id='$id'");

                    // handle new sub images
                    if (!empty($_FILES['img2']['name'][0])) {
                        $fileCount = count($_FILES['img2']['name']);
                        for ($i=0; $i<$fileCount; $i++) {
                            $fileName = $_FILES['img2']['name'][$i];
                            $fileTmp  = $_FILES['img2']['tmp_name'][$i];
                            $newFile  = time() . "_" . uniqid() . "_" . $fileName;
                            move_uploaded_file($fileTmp, "assets/images/products/" . $newFile);
                            mysqli_query($db, "INSERT INTO pro_subimg (`pid`,`img`) VALUES ('$id','$newFile')");
                        }
                    }

                    msg("Product Updated Successfully","products.php");
                }
                ?>

						


					</div>
				</div>
			</div>



























			<!-- End Main Content-->

		<!-- Main Footer-->
			<div class="main-footer text-center">
				<div class="container">
					<div class="row row-sm">
						<div class="col-md-12">
							<span>Copyright © 2025 India Mart. Designed by <a href="https://design-pods.com/">Design-pods</a> All rights reserved.</span>
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