<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/db_config.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

if (isset($_POST['upload_excel'])) {

    if (!isset($_FILES['excel_file']) || $_FILES['excel_file']['error'] !== 0) {
        die("File upload failed");
    }

    $ext = strtolower(pathinfo($_FILES['excel_file']['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, ['xls', 'xlsx'])) {
        die("Invalid file type");
    }

    if (!is_dir("uploads")) {
        mkdir("uploads", 0777, true);
    }

    $filePath = "uploads/" . time() . "_" . $_FILES['excel_file']['name'];
    move_uploaded_file($_FILES['excel_file']['tmp_name'], $filePath);

    $spreadsheet = IOFactory::load($filePath);
    $rows = $spreadsheet->getActiveSheet()->toArray();

    $inserted = 0;

    foreach ($rows as $i => $row) {

        if ($i === 0) continue; // skip header

        $row = array_pad($row, 17, '');

        [
            $itemid,
            $img,
            $category,
            $weight,
            $name,
            $old_price,
            $new_price,
            $stock,
            $desc,
            $care,
            $return,
            $package,
            $manufacture,
            $item_no,
            $showin,
            $pdate,
            $udate
        ] = $row;

		$category = trim((string)$category);
		$weight   = trim((string)$weight);
		$name     = trim((string)$name);
		
		if ($name === '' || $category === '') {
			continue; // FIX: prevents cid NULL error
		}
		

        // if ($name === '') continue; // CRITICAL FIX

        $old_price   = (string)$old_price;
        $new_price   = (string)$new_price;
        $stock       = (string)$stock;
        $desc        = (string)$desc;
        $care        = (string)$care;
        $return      = (string)$return;
        $package     = (string)$package;
        $manufacture = (string)$manufacture;
        $item_no     = (string)$item_no;
        $showin      = (string)$showin;
        $img         = (string)$img;
        $pdate       = $pdate ?: date('Y-m-d');
        $udate       = $udate ?: date('Y-m-d');

        /* ---------- CATEGORY ---------- */
        $cid = null;
        if ($category !== '') {
            $stmt = $mysqli->prepare("SELECT id FROM category WHERE name=?");
            $stmt->bind_param("s", $category);
            $stmt->execute();
            $res = $stmt->get_result();

            if ($res->num_rows === 0) {
                $ins = $mysqli->prepare(
                    "INSERT INTO category(name, date) VALUES (?, CURDATE())"
                );
                $ins->bind_param("s", $category);
                $ins->execute();
                $cid = $ins->insert_id;
            } else {
                $cid = $res->fetch_assoc()['id'];
            }
        }

        /* ---------- WEIGHT ---------- */
        $wid = null;
        if ($weight !== '') {
            $stmt = $mysqli->prepare("SELECT id FROM weight WHERE t1=?");
            $stmt->bind_param("s", $weight);
            $stmt->execute();
            $res = $stmt->get_result();

            if ($res->num_rows === 0) {
                $ins = $mysqli->prepare(
                    "INSERT INTO weight(t1, date) VALUES (?, CURDATE())"
                );
                $ins->bind_param("s", $weight);
                $ins->execute();
                $wid = $ins->insert_id;
            } else {
                $wid = $res->fetch_assoc()['id'];
            }
        }

        /* ---------- PRODUCT ---------- */
        $stmt = $mysqli->prepare("
            INSERT INTO products
            (img, cid, wid, name, old_price, new_price, stock,
             description, care_instruction, return_policy,
             package_info, manufacture, item_partnumber,
             showin, pdate, udate)
            VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)
        ");

        $stmt->bind_param(
            "siisssssssssssss",
            $img,
            $cid,
            $wid,
            $name,
            $old_price,
            $new_price,
            $stock,
            $desc,
            $care,
            $return,
            $package,
            $manufacture,
            $item_no,
            $showin,
            $pdate,
            $udate
        );

        $stmt->execute();
        $inserted++;
    }

    echo "<script>alert('Import completed. Inserted {$inserted} products');</script>";
}
?>









<!DOCTYPE html>
<html lang="en">
	
<!-- Mirrored from laravel.spruko.com/spruha/ltr/index by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 26 Jun 2021 13:27:27 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>

		<meta charset="utf-8">
		<meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
		
        <!-- Favicon -->
		<link rel="icon" href="assets/img/brand/logo.png" type="image/png"/>

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
			

<!--  -->

<!-- Main Content -->
<div class="main-content side-content pt-0">
	<div class="container-fluid">
		<div class="inner-body">

			<!-- Page Header -->
			<div class="page-header">
				<div>
					<h2 class="main-content-title tx-24 mg-b-5">Excel Upload</h2>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#">Pages</a></li>
						<li class="breadcrumb-item active">Excel Upload</li>
					</ol>
				</div>
			</div>

			<!-- Excel Upload Form -->
			<form method="POST" enctype="multipart/form-data">

<div class="card custom-card">
  <div class="card-body">
    <h6 class="main-content-label mb-3">Upload Product Excel</h6>

    <div class="form-group">
      <input type="file" name="excel_file" accept=".xls,.xlsx" required class="form-control">
    </div>

    <button type="submit" name="upload_excel" class="btn btn-primary">
      Upload & Import
    </button>
  </div>
</div>

</form>


		</div>
	</div>
</div>
			<!-- End Main Content-->

		<!-- Main Footer-->
			<div class="main-footer text-center">
				<div class="container">
					<div class="row row-sm">
						<div class="col-md-12">
							<span>Copyright © 2025 India Mart. Designed by <a href="https://Dsign-pods.com/">Dsign-pods</a> All rights reserved.</span>
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