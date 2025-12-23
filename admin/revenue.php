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

<!-- --------------------------------------------------------------------------------------------------------------- -->
 <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/moment/min/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<!-------------------------------------------------------------------------------------------------------------------------  -->







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
								<h2 class="main-content-title tx-24 mg-b-5">Revenue</h2>
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Pages</a></li>
									<li class="breadcrumb-item active" aria-current="page">Revenue</li>
								</ol>
							</div>
							
						</div>
						






						


						
						<div class="row row-sm">
							<div class="col-lg-12 col-md-12">
								<div class="card custom-card">
									<div class="card-body">
										<div>
											<h6 class="main-content-label mb-1">Reports</h6>
											
										</div>

										<form method="GET" action="">
    <div class="row row-sm">
        

       

        

       <div class="col-lg-4">
    <label>Date Range</label>
    <input type="text" class="form-control" id="date_range" name="date_range" 
           value="<?php echo $_GET['date_range'] ?? ''; ?>" 
           placeholder="Select Date Range">
</div>



		
    </div>

    <div class="mg-t-20">
        <button type="submit" class="btn ripple btn-primary mb-1">Filter Now</button>
        <a href="revenue.php" class="btn ripple btn-secondary mb-1">Clear</a>
    </div>
</form>
											
										</div>
										
									</div>
								</div>
							</div>
						</div>
						<div class="row row-sm">
							<div class="col-lg-12">
								<div class="card custom-card overflow-hidden">
									<div class="card-body">
										<div>
											<h6 class="main-content-label mb-1">Detailed Reports</h6>
											
										</div>
<div class="table-responsive">
    <div class="table-responsive">
    <table id="exportexample" class="table table-bordered border-t0 key-buttons text-nowrap w-100">
        <thead>
            <tr>
                <th>User Name</th>
                <th>User Email</th>
                <th>User Phone</th>
                <th>User Address</th>
                <th>Order ID</th>
                <th>Status</th>
                <th>Revenue Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $where = [];
            if (!empty($_GET['category_id'])) {
                $category_id = (int) $_GET['category_id'];
                $where[] = "c.id = $category_id";
            }

            if (!empty($_GET['product_id'])) {
                $product_id = (int) $_GET['product_id'];
                $where[] = "p.id = $product_id";
            }

            if (!empty($_GET['user_id'])) {
                $user_id = (int) $_GET['user_id'];
                $where[] = "u.id = $user_id";
            }

            if (!empty($_GET['order_status'])) {
                $status = mysqli_real_escape_string($db, $_GET['order_status']);
                $where[] = "o.status = '$status'";
            }

            if (!empty($_GET['date_range'])) {
                $date_range = trim($_GET['date_range']);
                if (strpos($date_range, ' - ') !== false) {
                    list($start, $end) = explode(" - ", $date_range);
                    $start = mysqli_real_escape_string($db, $start);
                    $end   = mysqli_real_escape_string($db, $end);
                    $where[] = "DATE(o.created_at) BETWEEN '$start' AND '$end'";
                } else {
                    $single = mysqli_real_escape_string($db, $date_range);
                    $where[] = "DATE(o.created_at) = '$single'";
                }
            }

            $whereSQL = "";
            if (!empty($where)) {
                $whereSQL = "WHERE " . implode(" AND ", $where);
            }

            $sql = "SELECT 
                        o.id as order_id, 
                        o.final_amount as final_amount, 
                        u.name as user_name, 
                        u.email as user_email, 
                        u.phone as user_phone, 
                        u.address as user_address,
                        GROUP_CONCAT(p.name SEPARATOR ', ') as product_names,
                        GROUP_CONCAT(c.name SEPARATOR ', ') as category_names,
                        o.status,
                        o.created_at
                    FROM orders o
                    JOIN users u ON o.user_id = u.id
                    JOIN order_items oi ON o.id = oi.order_id
                    JOIN products p ON oi.product_id = p.id
                    JOIN category c ON p.cid = c.id
                    $whereSQL
                    GROUP BY o.id, u.name, u.email, u.phone, u.address, o.status, o.created_at
                    ORDER BY o.id DESC";

            $res = mysqli_query($db, $sql);

            $totalRevenue = 0; // Initialize total revenue

            while ($row = mysqli_fetch_assoc($res)) {
                $totalRevenue += $row['final_amount']; // Add each order's final_amount
            ?>
            <tr>
                <td><?php echo $row['user_name']; ?></td>
                <td><?php echo $row['user_email']; ?></td>
                <td><?php echo $row['user_phone']; ?></td>
                <td><?php echo $row['user_address']; ?></td>
                <td>EB <?php echo $row['order_id']; ?></td>
                <td><?php echo ucfirst($row['status']); ?></td>
                <td>₹<?php echo number_format($row['final_amount'], 2); ?></td>
            </tr>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="6" class="text-right"><strong>Total Revenue:</strong></td>
                <td><strong>₹<?php echo number_format($totalRevenue, 2); ?></strong></td>
            </tr>
        </tfoot>
    </table>
</div>


									</div>
								</div>
							</div>
						</div>
						


					</div>
				</div>
			</div>
<script>
$(function() {
    $('#date_range').daterangepicker({
        autoUpdateInput: false,
        locale: { cancelLabel: 'Clear' }
    });

    $('#date_range').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
    });

    $('#date_range').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });
});
</script>




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