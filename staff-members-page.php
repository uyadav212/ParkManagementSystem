<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if(strlen($_SESSION['pmsEmpId'] == 0)) {
    echo "<script>
            alert('Session expired, Please login again.')
            window.location.replace('logout.php');
        </script>";
}else{

?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Staff Members - Park Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="assets/images/icon/favicon.ico">
    <!-- css -->
    <link rel="stylesheet" href="assets/css/typography.css">
    <link rel="stylesheet" href="assets/css/default-css.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <!-- modernizer css -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->

    <!-- header area start -->
    <?php include_once('includes/header.php');?>
    <!-- header area end -->

    <div style="width: 100%; display: inline-block;">
        <div style="float: left;">
            <ul class="breadcrumbs pull-left">
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><span>Staff Members</span></li>
            </ul>
        </div>
        <div style="text-align-last: end;">
            <a href="logout.php">LogOut</a>
        </div>
    </div>

    <!-- dashboard area start -->
    <div style="background-image: linear-gradient(-90deg, lightblue, white)">
        <div class="container">
            <div class="login-box">
                <form>
                    <div class="login-form-head" style="margin-bottom: 10px;">
                        <a href="add-employee-page.php">
                            <h4>Add new staff member</h4>
                        </a>
                    </div>
                    <div class="login-form-head" style="margin-bottom: 10px;">
                        <a href="update-employee-page.php">
                            <h4>Update staff member details</h4>
                        </a>
                    </div>
                    <div class="login-form-head" style="margin-bottom: 10px;">
                        <a href="view-employee-list-page.php">
                            <h4>View staff members</h4>
                        </a>
                    </div>
                    <div class="login-form-head">
                        <a href="change-password-page.php">
                            <h4>Change Password</h4>
                        </a>
                    </div>
                </form>
            </div>
        </div>
        <!-- footer area start-->
        <?php include_once('includes/footer.php');?>
        <!-- footer area end-->
    </div>
    <!-- login area end -->

    <!-- jquery latest version -->
    <script src="assets/js/vendor/jquery-2.2.4.min.js"></script>
    <!-- bootstrap 4 js -->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/metisMenu.min.js"></script>
    <script src="assets/js/jquery.slimscroll.min.js"></script>
    <script src="assets/js/jquery.slicknav.min.js"></script>
    
    <!-- others plugins -->
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/scripts.js"></script>
</body>

</html>
<?php } ?>