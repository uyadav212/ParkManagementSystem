<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if(isset($_POST['submit'])) {
    $contactno = $_POST['contactno'];
    $email = $_POST['email'];

    $query = mysqli_query($con,"SELECT StaffId FROM staffMembers WHERE Email='$email' && MobileNumber='$contactno'");
    $ret = mysqli_fetch_array($query);

    if($ret > 0){
        $_SESSION['contactno'] = $contactno;
        $_SESSION['email'] = $email;
        header('location:reset-password.php');
    }
    else{
        echo '<script>alert("Invalid Details. Please try again..")</script>';
    }
  }
?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Forgot Password - Park Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="assets/images/icon/favicon.ico">
    <!-- css -->
    <link rel="stylesheet" href="assets/css/typography.css">
    <link rel="stylesheet" href="assets/css/default-css.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <!-- modernizr css -->
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

    <!-- forgot password area start (using same code as login page)-->
    <div class="login-area" style="background-image: linear-gradient(-90deg, lightblue, white)">
        <div class="container">
            <div class="login-box ptb--100">
                <form action="#" method="post" name="submit">
                   
                    <div class="login-form-head">
                        <h4>Forgot Password</h4>
                        <p>Hello there, Recover your Password</p>
                    </div>

                    <div class="login-form-body">
                        <div class="form-gp">
                            <label for="exampleInputEmail1">Email Address</label>
                            <input type="email" id="email" name="email" required="true">
                        </div>
                        <div class="form-gp">
                            <label for="exampleInputPassword1">Contact Number</label>
                            <input type="text" id="contactno" name="contactno" required="true">
                        </div>
                        <div class="submit-btn-area">
                            <button id="form_submit" type="submit" name="submit">Reset Password</button>
                        </div>
                        <div class="row rmber-area">
                            <div class="text-right">
                                <a href="index.php">LogIn</a>
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