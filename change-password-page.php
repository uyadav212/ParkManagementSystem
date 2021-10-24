<?php
session_start();
include('includes/dbconnection.php');
error_reporting(0);

if(strlen($_SESSION['pmsEmpId'] == 0)) {
    echo "<script>
            alert('Session expired, Please login again.')
            window.location.replace('logout.php');
        </script>";
}else{
    if(isset($_POST['submit'])) {
        $staffId = $_SESSION['pmsEmpId'];
        $password = $_POST['newpassword'];
        $query = mysqli_query($con,"UPDATE staffMembers SET Password='$password' WHERE StaffId = $staffId");
        
        if($query) {
            echo "<script>
                    alert('Password Successfully Updated')
                    window.location.replace('staff-members-page.php');
                </script>";
        }else{
            echo "Error description: " . mysqli_error($con);
            echo '<script>alert("Something Went Wrong. Please try again.")</script>';
        }
    }
?>

<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Change Password - Park Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="assets/images/icon/favicon.ico">
    <!-- css -->
    <link rel="stylesheet" href="assets/css/typography.css">
    <link rel="stylesheet" href="assets/css/default-css.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
    <script type="text/javascript">
        function checkPassword() {
            if(document.changepassword.newpassword.value != document.changepassword.confirmpassword.value) {
                alert('Re-entered Password do not match');
                document.changepassword.confirmpassword.focus();
                return false;
            }
            return true;
        } 
    </script>
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
                <li><a href="staff-members-page.php">Staff Members</a></li>
                <li><span>Change Password</span></li>
            </ul>
        </div>
        <div style="text-align-last: end;">
            <a href="logout.php">LogOut</a>
        </div>
    </div>

    <!-- Change password area start -->
    <div class="login-area" style="background-image: linear-gradient(-90deg, lightblue, white)">
        <div class="container">
            <div class="login-box ptb--100">
                <form action="" method="post" name="changepassword" onsubmit="return checkPassword();">
                    <div class="login-form-head">
                        <h4>Change Password</h4>
                    </div>

                    <div class="login-form-body">
                         <div class="form-gp">
                            <label for="exampleInputPassword1">New Password</label>
                            <input type="password" id="password" name="newpassword" required="true">
                        </div>
                        <div class="form-gp">
                            <label for="exampleInputPassword1">Re-enter Password</label>
                            <input type="password" id="password" name="confirmpassword" required="true">
                        </div>
                        <div class="submit-btn-area">
                            <button id="form_submit" type="submit" name="submit">Change Password</button>
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
<?php } ?>