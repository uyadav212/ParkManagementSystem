<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if(isset($_POST['login'])) {
    $user = $_POST['username'];
    $password = $_POST['password'];
    $msg = "";

    $query = mysqli_query($con,"SELECT StaffId, IsAdmin, Name FROM staffMembers WHERE UserName='$user' && Password='$password'");
    $ret = mysqli_fetch_array($query);

    if($ret > 0) {
        $_SESSION['pmsEmpId'] = $ret['StaffId'];
        $_SESSION['pmsEmpIsAdmin'] = $ret['IsAdmin'];
        $_SESSION['pmsEmpName'] = $ret['Name'];
        header('location:dashboard.php');
    }
    else {
        $msg = "Invalid Login detail. Please click forget password [if needed]";
    }
}
?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>LogIn - Park Management System</title>
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

    <!-- login area start -->
    <div class="login-area" style="background-image: linear-gradient(-90deg, lightblue, white)">
        <div class="container">
            <div class="login-box">
                <form action="#" method="post" name="login">

                    <p style="font-size:16px; color:red" align="center"> 
                        <?php if($msg){
                            echo $msg;
                        }  ?> 
                    </p>

                    <div class="login-form-head">
                        <h4>Park Management System</h4>
                        <p>Staff LogIn</p>
                    </div>

                    <div class="login-form-body" style="color:blue">
                        <div class="form-gp">
                            <label for="exampleInputEmail1">User Name</label>
                            <input type="text" id="username" name="username" required="true">
                        </div>
                        <div class="form-gp">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" id="password" name="password" required="true">
                        </div>
                        <div class="submit-btn-area">
                            <button id="form_submit" type="submit" name="login"> LOGIN </button>
                        </div>
                        <div class="row mb-4 rmber-area">
                            <div class="text-right">
                                <a href="forgot-password.php">Forgot Password?</a>
                            </div>
                        </div>
                                             
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