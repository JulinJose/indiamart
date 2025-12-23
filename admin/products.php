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
                                <option value="">Select category</option>
                                <?php
                                $s3 = mysqli_query($db, "select * from category");
                                while ($r3 = mysqli_fetch_row($s3)) {
                                ?>
                                <option value="<?php echo $r3[0]; ?>"><?php echo $r3[1]; ?></option>
                                <?php
                                }
                                ?>
                            </select>
											</div>

											
											<div class="col-lg">
												<label>Weight </label>
												<select class="form-control select2" name="b">
                                <option value="">Select category</option>
                                <?php
                                $s3 = mysqli_query($db, "select * from weight");
                                while ($r3 = mysqli_fetch_row($s3)) {
                                ?>
                                <option value="<?php echo $r3[0]; ?>"><?php echo $r3[1]; ?></option>
                                <?php
                                }
                                ?>
                            </select>
											</div>
											

											

											
																					
										</div>
										<div class="row row-sm mg-t-20">
											<div class="col-lg">
												<input class="form-control" placeholder="Product Name" name="c" type="text" required="">
											</div>

											<div class="col-lg">
												<div class="row row-sm">
													<div class="col-sm-12 col-md-12 col-lg-12">
														<div class="input-group file-browser">
															<input type="text" class="form-control border-right-0 browse-file" placeholder="Upload Image" name="img1"  required="">
															<label class="input-group-btn">
																<span class="btn btn-primary">
																	Browse <input type="file" style="display: none;"  name="img1">
																</span>
															</label>
														</div>
													</div>
												</div>
											</div>	
											
											<div class="col-lg">
												<div class="row row-sm">
													<div class="col-sm-12 col-md-12 col-lg-12">
														<div class="input-group file-browser">
															<input type="text" class="form-control border-right-0 browse-file" placeholder="Upload Image" name="img2[]" required="">
															<label class="input-group-btn">
																<span class="btn btn-primary">
																		Browse Multiple Image <input type="file" style="display: none;" name="img2[]" multiple>
																</span>
															</label>
														</div>
													</div>
												</div>
											</div>	
											
											
											
																					
										</div>


										<div class="row row-sm mg-t-20">
											<div class="col-lg">
												<input class="form-control" placeholder="Old Price" type="text" name="d"  required="">
											</div>
											<div class="col-lg">
												<input class="form-control" placeholder="New Price" type="text"  name="e" required="">
											</div>
											
											
											
											<div class="col-lg mg-t-10 mg-lg-t-0">
												<input class="form-control" name="f" placeholder="Stock" type="text" required="">
											</div>											
										</div>

										<div class="row row-sm mg-t-20">
											<div class="col-lg">
												<textarea class="form-control" name="g" placeholder="Description" rows="5"></textarea>
											</div>
											<div class="col-lg">
												<textarea class="form-control" name="h" placeholder="Care Instruction" rows="5"></textarea>
											</div>
											<div class="col-lg mg-t-10 mg-lg-t-0">
												<textarea class="form-control" name="i" placeholder="Return Policy" rows="5"></textarea>
												
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
												<input class="form-control" placeholder="Package Information" type="text"  name="j" required="">
											</div>
											<div class="col-lg">
												<input class="form-control" placeholder="Manufacturer" type="text"  name="k" required="">
											</div>
											
											
											<div class="col-lg mg-t-10 mg-lg-t-0">
												<input class="form-control" placeholder="Item Part Number" type="text"  name="l" required="">
											</div>											
										</div>


										<div>
											<h6 class="main-content-label mg-t-20">Showin</h6>
											
										</div>

										<div class="row row-sm mg-t-20">
											<div class="col-lg">
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="m" value="offers">
													<label class="form-check-label" for="inlineCheckbox1">Offers</label>
													</div>
													<div class="form-check form-check-inline">
													<input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="n" value="dealoftheday">
													<label class="form-check-label" for="inlineCheckbox2">Deal Of the Day</label>
													</div>

													<div class="form-check form-check-inline">
													<input class="form-check-input" type="checkbox" id="inlineCheckbox3" name="o" value="bestseller">
													<label class="form-check-label" for="inlineCheckbox3">Best Seller</label>
													</div>
													<div class="form-check form-check-inline">
													<input class="form-check-input" type="checkbox" id="inlineCheckbox4"  name="p" value="trendingproduct">
													<label class="form-check-label" for="inlineCheckbox4">Trending Product</label>
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

    // Convert to comma-separated string
    $featuresStr = implode(",", $features);

    $pd = date('Y-m-d H:i:s');
    $ud = date('Y-m-d H:i:s');

    // Cover image
    $coverImage = $_FILES['img1']['name'];
    $coverTmp   = $_FILES['img1']['tmp_name'];

    $allowedExt = array('jpg','jpeg','png','gif');

    if (!empty($coverImage)) {
        $ext = strtolower(pathinfo($coverImage, PATHINFO_EXTENSION));
        $newCover = md5(time().$coverImage).".".$ext;

        if (in_array($ext, $allowedExt)) {
            $uploadDir = "assets/images/products/";
            $destCover = $uploadDir.$newCover;

            if (move_uploaded_file($coverTmp, $destCover)) {
                // Insert into products table
                $ins = mysqli_query($db, "INSERT INTO products 
                (`id`, `img`, `cid`, `wid`, `name`, `old_price`, `new_price`, `stock`, `description`, `care_instruction`, `return_policy`, `Package_info`, `manufacture`, `item_partnumber`, `showin`)
                VALUES 
                ('0', '$newCover', '$a', '$b', '$c', '$d', '$e', '$f', '$g', '$h', '$i', '$j', '$k', '$l', '$featuresStr')");

                $lastId = mysqli_insert_id($db); // Get the newly created product ID

                // ✅ Loop for multiple sub images
                if (!empty($_FILES['img2']['name'][0])) {
                    $fileCount = count($_FILES['img2']['name']);

                    for ($i = 0; $i < $fileCount; $i++) {
                        $fileName = $_FILES['img2']['name'][$i];
                        $fileTmp  = $_FILES['img2']['tmp_name'][$i];

                        // Generate unique filename
                        $newFile = time() . "_" . uniqid() . "_" . $fileName;

                        // Move file to uploads folder
                        move_uploaded_file($fileTmp, "assets/images/products/" . $newFile);

                        // Insert into sub image table
                        $sql = "INSERT INTO pro_subimg (`pid`, `img`) VALUES ('$lastId', '$newFile')";
                        mysqli_query($db, $sql) or die(mysqli_error($db));
                    }
                }
            }
        }
    }

    msg("Successfully added", "products.php");
}
?>




<?php

if(isset($_REQUEST['deletepro_id']))
{
 $sql_query="DELETE FROM products WHERE id=".$_REQUEST['deletepro_id'];
 
     mysqli_query($db,$sql_query);
     header("Location: products.php");
}

?>

   <script type="text/javascript">
function deletepro_id(id)
{

 
     if(confirm('Sure To Remove This Details ?'))
     {
        window.location.href='products.php?deletepro_id='+id;
     }
}
</script>












						<div class="row row-sm">
							<div class="col-lg-12 col-md-12">
								<div class="card custom-card">
									<div class="card-body">
										<div>
											<h6 class="main-content-label mb-1">Product List</h6>
										</div>
										<table class="table" id="example2">
												<thead>
																
													<tr>
														<!-- <th class="wd-20p">Brand Name</th> -->
														<th class="wd-20p">Category</th>
														<th class="wd-20p">Product Name</th>
														<th class="wd-20p">Product Image</th>
														<th class="wd-20p">Price</th>
														<th class="wd-20p">Stock</th>

														<th class="wd-20p">Edit</th>
														<th class="wd-15p">Delete</th>
													</tr>
												</thead>
												<tbody>
													<?php
												$i=1;
                                    $s1=mysqli_query($db,"select * from `products`");
                                    while($rproducts=mysqli_fetch_row($s1))
                                    {
										$sc=mysqli_query($db,"select * from category where id=$rproducts[2] ");
                                    	$rc=mysqli_fetch_row($sc);
										?>
													<tr>
									
														<!-- <td>Godrej</td> -->
														<td><?php echo $rc[1]?></td>
														<td><?php echo $rproducts[4]?></td>
														<td>
															<div class="main-img-user avatar-lg online text-center">
																<img alt="avatar" class="rounded-circle" src="assets/images/products/<?php echo $rproducts[1]?>">
															</div>
														</td>
														<td><?php echo $rproducts[6]?></td>
														<td><?php echo $rproducts[7]?></td>
														
														<td><a href="products_edit.php?id=<?php echo $rproducts[0]?>"><i class="fe fe-edit-2 text-primary mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Edit"></i></a></td>
														<td id='swal-warning'><a href="javascript:deletepro_id(<?php echo $rproducts[0]; ?>)" title="Delete" data-toggle="tooltip" data-original-title="Delete" title="Delete"><i class="ti-trash" class="mst"style="font-size: 15px !important;"></i> </a>  </td>
													</tr>
													<?php
									}
									?>

													

													
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