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

<!-- --------------------------Model------------------------------------------------------ -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<!-- --------------------------Model------------------------------------------------------ -->











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
								<span class="main-img-user" ><img alt="avatar" src="assets/img/users/1.jpg"></span>
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
								<h2 class="main-content-title tx-24 mg-b-5">Order Management </h2>
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Pages</a></li>
									<li class="breadcrumb-item active" aria-current="page">Order Management</li>
								</ol>
							</div>
							
						</div>
						






						


						
						<div class="row row-sm">
							<div class="col-lg-12 col-md-12">
								<div class="card custom-card">
									<div class="card-body">
										<div>
											<h6 class="main-content-label mb-1">Order Management</h6>
										</div>
										<table class="table" id="example2">
												<thead>
													<tr>
														<th class="wd-20p">Date</th>
														<th class="wd-20p">Order ID</th>
														<th class="wd-20p">User Name</th>
														<th class="wd-20p">Contact Number</th>
														
														<th class="wd-20p">Amount</th>
														<th class="wd-20p">Category</th>
														<th class="wd-20p">ProductName</th>
														<th class="wd-20p">Status</th>
														<th class="wd-20p">View</th>
														<!-- <th class="wd-20p">Accept / Reject</th> -->
													</tr>
												</thead>
												<tbody>
<?php

// Sample DB query
$sql = "SELECT 
    o.id as order_id, 
    o.created_at as created_at,
    o.final_amount as final_amount,
	  o.status as status, 
    u.name as user_name, 
    u.email as user_email, 
    u.phone as user_phone, 
    u.address as user_address,
    GROUP_CONCAT(p.name SEPARATOR '||') as product_names,
    GROUP_CONCAT(c.name SEPARATOR ', ') as category_names,
    GROUP_CONCAT(p.img SEPARATOR '||') as product_images,
    GROUP_CONCAT(oi.quantity SEPARATOR '||') as product_qty
FROM orders o
JOIN users u ON o.user_id = u.id
JOIN order_items oi ON o.id = oi.order_id
JOIN products p ON oi.product_id = p.id
JOIN category c ON p.cid = c.id
GROUP BY o.id, u.name, u.email, u.phone, u.address
ORDER BY o.id DESC";


$res = mysqli_query($db, $sql);
?>
<?php while ($row = mysqli_fetch_assoc($res)) { ?>
      <tr>
        <td><?php echo $row['created_at']; ?></td>
        <td>EB <?php echo $row['order_id']; ?></td>
        <td><?php echo $row['user_name']; ?></td>
        <td><?php echo $row['user_phone']; ?></td>
        <td>₹<?php echo $row['final_amount']; ?></td>
        <td><?php echo $row['category_names']; ?></td>
        <td><?php echo str_replace('||', ', ', $row['product_names']); ?></td>


		<?php

$statusClasses = [
    'pending'           => 'badge badge-warning',       
    'received'          => 'badge badge-info',           
    'confirmed'         => 'badge badge-primary',        
    'out for delivery'  => 'badge badge-secondary',      
    'completed'         => 'badge badge-success',        
    'cancelled'         => 'badge badge-danger',         
];

// When outputting each row
$status = strtolower($row['status']);  // normalize
$badgeClass = $statusClasses[$status] ?? 'badge badge-light';  // default

?>
<td>
  <span class="<?= $badgeClass ?> badge-pill">
    <?= ucfirst($row['status']) ?>
  </span>
</td>
        <!-- <td><span class="badge badge-danger"><?php echo $row['status']; ?></span></td> -->
        <td>
          <a href="javascript:void(0);" 
   class="viewOrder btn btn-sm btn-info"
   data-orderid="<?php echo $row['order_id']; ?>"
   data-username="<?php echo $row['user_name']; ?>"
   data-userphone="<?php echo $row['user_phone']; ?>"
   data-useremail="<?php echo $row['user_email']; ?>"
   data-useraddress="<?php echo $row['user_address']; ?>"
   data-products="<?php echo $row['product_names']; ?>"
   data-images="<?php echo $row['product_images']; ?>"
   data-qty="<?php echo $row['product_qty']; ?>"
   data-final="<?php echo $row['final_amount']; ?>">
   <i class="fa fa-eye"></i>
</a>

        </td>
      </tr>
      <?php } ?>

													

													
												</tbody>
											</table>
									</div>
								</div>
							</div>
						</div>
						


					</div>
				</div>
			</div>
<!-- ----------------------------------------------Model--------------------------------------------------------------- -->
<!-- Order Details Modal -->
<div class="modal fade" id="orderModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Order Details</h5>
        <button type="button" class="close" data-dismiss="modal">
          <span>&times;</span>
        </button>
      </div>
      <div class="modal-body" id="orderDetails">
        <!-- Loaded by JS -->
      </div>
    </div>
  </div>
</div>

	<!-- jQuery + Bootstrap Bundle JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
$(document).on("click", ".viewOrder", function() {
  let orderId    = $(this).data("orderid");
  let userName   = $(this).data("username");
  let userPhone  = $(this).data("userphone");
  let userEmail  = $(this).data("useremail");
  let userAddr   = $(this).data("useraddress");
  let products   = ($(this).data("products") || "").toString().split("||");
  let images     = ($(this).data("images") || "").toString().split("||");
  let qty        = ($(this).data("qty") || "").toString().split("||");
  let finalAmt   = $(this).data("final");

  let html = `
    <p><strong>Order ID:</strong> EB ${orderId}</p>
    <p><strong>User:</strong> ${userName} (${userPhone}, ${userEmail})</p>
    <p><strong>Address:</strong> ${userAddr}</p>
    <p><strong>Final Amount:</strong> ₹${finalAmt}</p>
    <hr>
    <h5>Products:</h5>
    <div class="row">`;

  for (let i = 0; i < products.length; i++) {
    if (products[i].trim() !== "") {
      let imgPath = images[i] ? `assets/images/products/${images[i]}` : "assets/images/no-image.png";
      let count   = qty[i] ? qty[i] : 1;
      html += `
        <div class="col-md-3 text-center mb-3">
          <img src="${imgPath}" class="img-fluid border" style="max-height:100px;"><br>
          <small>${products[i]}</small><br>
          <span class="badge badge-primary">Qty: ${count}</span>
        </div>`;
    }
  }

  html += "</div>";

  $("#orderDetails").html(html);
  $("#orderModal").modal("show");
});

</script>




















			<!-- End Main Content-->

		<!-- Main Footer-->
			<div class="main-footer text-center">
				<div class="container">
					<div class="row row-sm">
						<div class="col-md-12">
							<span>Copyright © 2025 Designed by <a href="https://design-pods.com/">Design-pods</a> All rights reserved.</span>
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