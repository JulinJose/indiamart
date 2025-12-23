
<?php 
include('connection.php');
if(isset($_SESSION['admin']))
{

}
else
{
    header("location:login.php");
}
?>


<?php
if($_SESSION['admin'] && $_SESSION['role']== 1)
{
?>
<div class="main-sidebar main-sidebar-sticky side-menu">
        <div class="sidemenu-logo">
          <a class="main-logo" href="index.php">
            <img
              src="assets/img/brand/logo.png"
              class="header-brand-img desktop-logo"
              alt="logo"
            />
            <img
              src="assets/img/brand/icon-light.png"
              class="header-brand-img icon-logo"
              alt="logo"
            />
            <img
              src="assets/img/brand/logo.png"
              class="header-brand-img desktop-logo theme-logo"
              alt="logo"
            />
            <img
              src="assets/img/brand/icon.png"
              class="header-brand-img icon-logo theme-logo"
              alt="logo"
            />
          </a>
        </div>
        <div class="main-sidebar-body">
          <ul class="nav">
            <li class="nav-header"><span class="nav-label">Dashboard</span></li>
            <li class="nav-item">
              <a class="nav-link" href="index.php"
                ><span class="shape1"></span><span class="shape2"></span
                ><i class="ti-home sidemenu-icon"></i
                ><span class="sidemenu-label">Dashboard</span></a
              >
            </li>




            <li class="nav-item">
              <a class="nav-link with-sub" href="#"
                ><span class="shape1"></span><span class="shape2"></span
                ><i class="ti-map-alt sidemenu-icon"></i
                ><span class="sidemenu-label">Excel Upload</span
                ><i class="angle fe fe-chevron-right"></i
              ></a>
              <ul class="nav-sub">
                <!-- <li class="nav-sub-item">
                  <a class="nav-sub-link" href="brands.php">Brands</a>
                </li> -->
                <li class="nav-sub-item">
                  <a class="nav-sub-link" href="fileupload.php">File Upload Field</a>
                </li>
                 <!-- <li class="nav-sub-item">
                  <a class="nav-sub-link" href="weight.php">Weight</a>
                </li>
                <li class="nav-sub-item">
                  <a class="nav-sub-link" href="products.php">Products</a>
                </li> -->

                <!-- <li class="nav-sub-item">
                  <a class="nav-sub-link" href="offer.php">Offer</a>
                </li> -->

                <!-- <li class="nav-sub-item">
                  <a class="nav-sub-link" href="wishlist.php">Wishlist</a>
                </li> -->
              </ul>
            </li>


            <li class="nav-item">
              <a class="nav-link with-sub" href="#"
                ><span class="shape1"></span><span class="shape2"></span
                ><i class="ti-map-alt sidemenu-icon"></i
                ><span class="sidemenu-label">Products</span
                ><i class="angle fe fe-chevron-right"></i
              ></a>
              <ul class="nav-sub">
                <!-- <li class="nav-sub-item">
                  <a class="nav-sub-link" href="brands.php">Brands</a>
                </li> -->
                <li class="nav-sub-item">
                  <a class="nav-sub-link" href="category.php">Category</a>
                </li>
                 <li class="nav-sub-item">
                  <a class="nav-sub-link" href="weight.php">Weight</a>
                </li>
                <li class="nav-sub-item">
                  <a class="nav-sub-link" href="products.php">Products</a>
                </li>

                <!-- <li class="nav-sub-item">
                  <a class="nav-sub-link" href="offer.php">Offer</a>
                </li> -->

                <li class="nav-sub-item">
                  <a class="nav-sub-link" href="wishlist.php">Wishlist</a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link with-sub" href="#"
                ><span class="shape1"></span><span class="shape2"></span
                ><i class="ti-agenda sidemenu-icon"></i
                ><span class="sidemenu-label">Order Management</span
                ><i class="angle fe fe-chevron-right"></i
              ></a>
              <ul class="nav-sub">
                <li class="nav-sub-item">
                  <a class="nav-sub-link" href="orderlist.php">Orders</a>
                </li>
                <li class="nav-sub-item">
                  <a class="nav-sub-link" href="trackproduct.php"
                    >Track Orders</a
                  >
                </li>
              </ul>
            </li>
<li class="nav-item">
              <a class="nav-link with-sub" href="#"
                ><span class="shape1"></span><span class="shape2"></span
                ><i class="ti-agenda sidemenu-icon"></i
                ><span class="sidemenu-label">Coupon Management</span
                ><i class="angle fe fe-chevron-right"></i
              ></a>
              <ul class="nav-sub">
                <li class="nav-sub-item">
                  <a class="nav-sub-link" href="add_coupon.php">Add Coupon</a>
                </li>
                <li class="nav-sub-item">
                  <a class="nav-sub-link" href="coupons.php"
                    >View coupons</a
                  >
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link with-sub" href="#"
                ><span class="shape1"></span><span class="shape2"></span
                ><i class="ti-shield sidemenu-icon"></i
                ><span class="sidemenu-label">Staff Management</span
                ><i class="angle fe fe-chevron-right"></i></a>
              <ul class="nav-sub">
                <li class="nav-sub-item">
                  <a class="nav-sub-link" href="addstaff.php">Add Staff</a>
                </li>
              </ul>
            </li>
            
            <li class="nav-header"><span class="nav-label">Reports</span></li>
            <li class="nav-item">
              <a class="nav-link with-sub" href="#"
                ><span class="shape1"></span><span class="shape2"></span
                ><i class="ti-package sidemenu-icon"></i
                ><span class="sidemenu-label">invoice</span
                ><i class="angle fe fe-chevron-right"></i
              ></a>
              <ul class="nav-sub">
                <li class="nav-sub-item">
                  <a class="nav-sub-link" href="reports.php">View Invoice</a>
                </li>
                
              </ul>
            </li>

            <li class="nav-item">
              <a class="nav-link with-sub" href="#"
                ><span class="shape1"></span><span class="shape2"></span
                ><i class="ti-package sidemenu-icon"></i
                ><span class="sidemenu-label">Accounts</span
                ><i class="angle fe fe-chevron-right"></i
              ></a>
              <ul class="nav-sub">
                <li class="nav-sub-item">
                  <a class="nav-sub-link" href="revenue.php">Revenue</a>
                </li>
              </ul>
               <ul class="nav-sub">
                <li class="nav-sub-item">
                  <a class="nav-sub-link" href="expense.php">expense</a>
                </li>
              </ul>
              <ul class="nav-sub">
                <li class="nav-sub-item">
                  <a class="nav-sub-link" href="daybook.php">Daybook</a>
                </li>
              </ul>
              <ul class="nav-sub">
                <li class="nav-sub-item">
                  <a class="nav-sub-link" href="balancesheet.php">Balancesheet</a>
                </li>
              </ul>
            </li>

<li class="nav-item">
              <a class="nav-link with-sub" href="#"
                ><span class="shape1"></span><span class="shape2"></span
                ><i class="ti-package sidemenu-icon"></i
                ><span class="sidemenu-label">Stock</span
                ><i class="angle fe fe-chevron-right"></i
              ></a>
              <ul class="nav-sub">
                <li class="nav-sub-item">
                  <a class="nav-sub-link" href="productfilter.php">Update Stock</a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link with-sub" href="#"
                ><span class="shape1"></span><span class="shape2"></span
                ><i class="ti-lock sidemenu-icon"></i
                ><span class="sidemenu-label">Authorization</span
                ><i class="angle fe fe-chevron-right"></i
              ></a>
              <ul class="nav-sub">
                <li class="nav-sub-item">
                  <a class="nav-sub-link" href="#">Reset Password</a>
                </li>

                <li class="nav-sub-item">
                  <a class="nav-sub-link" href="logout.php">Sign Out</a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
      <!-- End Sidemenu -->
      <!-- Main Header-->
      <div class="main-header side-header sticky">
        <div class="container-fluid">
          <div class="main-header-left">
            <a class="main-header-menu-icon" href="#" id="mainSidebarToggle"
              ><span></span
            ></a>
          </div>
          <div class="main-header-center">
            <div class="responsive-logo">
              <a href="index.php"
                ><img
                  src="assets/img/brand/logo.png"
                  class="mobile-logo"
                  alt="logo"
              /></a>
              <a href="index.php"
                ><img
                  src="assets/img/brand/logo-light.png"
                  class="mobile-logo-dark"
                  alt="logo"
              /></a>
            </div>
          </div>
          <div class="main-header-right">
            <div class="dropdown d-md-flex">
              <a class="nav-link icon full-screen-link" href="#">
                <i
                  class="fe fe-maximize fullscreen-button fullscreen header-icons"
                ></i>
                <i
                  class="fe fe-minimize fullscreen-button exit-fullscreen header-icons"
                ></i>
              </a>
            </div>

            <div class="dropdown main-profile-menu">
              <a class="d-flex" href="profile.php">
                <span class="main-img-user"
                  ><img alt="avatar" src="assets/img/brand/logo.png"
                /></span>
              </a>
              <div class="dropdown-menu">
                <div class="header-navheading">
                  <h6 class="main-notification-title">Admin</h6>
                  <p class="main-notification-text">India Mart</p>
                </div>

                <a class="dropdown-item" href="logout.php">
                  <i class="fe fe-power"></i> Sign Out
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php
}

else if($_SESSION['admin'] && $_SESSION['role']== 2){
	?>
<div class="main-sidebar main-sidebar-sticky side-menu">
        <div class="sidemenu-logo">
          <a class="main-logo" href="index.php">
            <img
              src="assets/img/brand/logo.png"
              class="header-brand-img desktop-logo"
              alt="logo"
            />
            <img
              src="assets/img/brand/icon-light.png"
              class="header-brand-img icon-logo"
              alt="logo"
            />
            <img
              src="assets/img/brand/logo.png"
              class="header-brand-img desktop-logo theme-logo"
              alt="logo"
            />
            <img
              src="assets/img/brand/icon.png"
              class="header-brand-img icon-logo theme-logo"
              alt="logo"
            />
          </a>
        </div>
        <div class="main-sidebar-body">
          <ul class="nav">
            <li class="nav-header"><span class="nav-label">Dashboard</span></li>
            <li class="nav-item">
              <a class="nav-link" href="index.php"
                ><span class="shape1"></span><span class="shape2"></span
                ><i class="ti-home sidemenu-icon"></i
                ><span class="sidemenu-label">Dashboard</span></a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link with-sub" href="#"
                ><span class="shape1"></span><span class="shape2"></span
                ><i class="ti-map-alt sidemenu-icon"></i
                ><span class="sidemenu-label">Products</span
                ><i class="angle fe fe-chevron-right"></i
              ></a>
              <ul class="nav-sub">
                <!-- <li class="nav-sub-item">
                  <a class="nav-sub-link" href="brands.php">Brands</a>
                </li> -->
                <li class="nav-sub-item">
                  <a class="nav-sub-link" href="category.php">Category</a>
                </li>
                 <li class="nav-sub-item">
                  <a class="nav-sub-link" href="weight.php">Weight</a>
                </li>
                <li class="nav-sub-item">
                  <a class="nav-sub-link" href="products.php">Products</a>
                </li>

                <li class="nav-sub-item">
                  <a class="nav-sub-link" href="offer.php">Offer</a>
                </li>

                <li class="nav-sub-item">
                  <a class="nav-sub-link" href="wishlist.php">Wishlist</a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link with-sub" href="#"
                ><span class="shape1"></span><span class="shape2"></span
                ><i class="ti-agenda sidemenu-icon"></i
                ><span class="sidemenu-label">Order Management</span
                ><i class="angle fe fe-chevron-right"></i
              ></a>
              <ul class="nav-sub">
                <li class="nav-sub-item">
                  <a class="nav-sub-link" href="orderlist.php">Orders</a>
                </li>
                <li class="nav-sub-item">
                  <a class="nav-sub-link" href="trackproduct.php"
                    >Track Orders</a
                  >
                </li>
              </ul>
            </li>
<li class="nav-item">
              <a class="nav-link with-sub" href="#"
                ><span class="shape1"></span><span class="shape2"></span
                ><i class="ti-agenda sidemenu-icon"></i
                ><span class="sidemenu-label">Coupon Management</span
                ><i class="angle fe fe-chevron-right"></i
              ></a>
              <ul class="nav-sub">
                <li class="nav-sub-item">
                  <a class="nav-sub-link" href="add_coupon.php">Add Coupon</a>
                </li>
                <li class="nav-sub-item">
                  <a class="nav-sub-link" href="coupons.php"
                    >View coupons</a
                  >
                </li>
              </ul>
            </li>
             <li class="nav-header"><span class="nav-label">Reports</span></li>
            <li class="nav-item">
              <a class="nav-link with-sub" href="#"
                ><span class="shape1"></span><span class="shape2"></span
                ><i class="ti-package sidemenu-icon"></i
                ><span class="sidemenu-label">invoice</span
                ><i class="angle fe fe-chevron-right"></i
              ></a>
              <ul class="nav-sub">
                <li class="nav-sub-item">
                  <a class="nav-sub-link" href="reports.php">View Invoice</a>
                </li>
                
              </ul>
            </li>
            </li>
<li class="nav-item">
              <a class="nav-link with-sub" href="#"
                ><span class="shape1"></span><span class="shape2"></span
                ><i class="ti-package sidemenu-icon"></i
                ><span class="sidemenu-label">Stock</span
                ><i class="angle fe fe-chevron-right"></i
              ></a>
              <!-- <ul class="nav-sub">
                <li class="nav-sub-item">
                  <a class="nav-sub-link" href="categoryfilter.php">Products Category </a>
                </li>
              </ul> -->
              <ul class="nav-sub">
                <li class="nav-sub-item">
                  <a class="nav-sub-link" href="productfilter.php">Update Stock</a>
                </li>
              </ul>
            </li>







            <li class="nav-item">
              <a class="nav-link with-sub" href="#"
                ><span class="shape1"></span><span class="shape2"></span
                ><i class="ti-lock sidemenu-icon"></i
                ><span class="sidemenu-label">Authorization</span
                ><i class="angle fe fe-chevron-right"></i
              ></a>
              <ul class="nav-sub">
                <li class="nav-sub-item">
                  <a class="nav-sub-link" href="#">Reset Password</a>
                </li>
                <!-- <li class="nav-sub-item">
                  <a class="nav-sub-link" href="lockscreen.php">Lockscreen</a>
                </li> -->

                <li class="nav-sub-item">
                  <a class="nav-sub-link" href="logout.php">Sign Out</a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
      <?php
} 
else {
    header("location:login.php");
}
?>

      <!-- Mobile-header closed -->