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
    <title>Customer Stats Section - Park Management System</title>
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
                <li><span>Customer Stats Section</span></li>
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
                    <div class="login-form-head">
                        <h4>Total Number of visitors</h4>
                        <?php
                            $query2 = mysqli_query($con, "SELECT SUM(NoOfAdult) AS todayAdultCount, SUM(NoOfChildren) AS todayChildCount FROM ticket WHERE DATE(Date) = CURDATE()");
                            $ret2 = mysqli_fetch_array($query2);
                            $todayAdultCount = $ret2['todayAdultCount'];
                            $todayChildCount = $ret2['todayChildCount'];

                            $query3 = mysqli_query($con, "SELECT SUM(NoOfAdult) AS currMonthAdultCount, SUM(NoOfChildren) AS currMonthChildCount FROM ticket WHERE MONTH(Date) = MONTH(CURDATE()) AND YEAR(Date) = YEAR(CURDATE())");
                            $ret3 = mysqli_fetch_array($query3);
                            $currMonthAdultCount = $ret3['currMonthAdultCount'];
                            $currMonthChildCount = $ret3['currMonthChildCount'];

                            $query4 = mysqli_query($con, "SELECT SUM(NoOfAdult) AS currYearAdultCount, SUM(NoOfChildren) AS currYearChildCount FROM ticket WHERE YEAR(Date) = YEAR(CURDATE())");
                            $ret4 = mysqli_fetch_array($query4);
                            $currYearAdultCount = $ret4['currYearAdultCount'];
                            $currYearChildCount = $ret4['currYearChildCount'];
                        ?>
                        <p>Today: Adults[<?php echo $todayAdultCount;?>] Children[<?php echo $todayChildCount;?>]</p>
                        <p>Current month: Adults[<?php echo $currMonthAdultCount;?>] Children[<?php echo $currMonthChildCount;?>]</p>
                        <p>Current year: Adults[<?php echo $currYearAdultCount;?>] Children[<?php echo $currYearChildCount;?>]</p>
                    </div>
                    <div class="login-form-head">
                        <h4>Total Amount Collected</h4>
                        <?php
                            $query2 = mysqli_query($con, "SELECT SUM(AmountPayable) AS todayCollection FROM ticket WHERE DATE(Date) = CURDATE()");
                            $ret2 = mysqli_fetch_array($query2);
                            $todayCollection = $ret2['todayCollection'];

                            $query2 = mysqli_query($con, "SELECT SUM(AmountPayable) AS currMonthCollection FROM ticket WHERE MONTH(Date) = MONTH(CURDATE()) AND YEAR(Date) = YEAR(CURDATE())");
                            $ret2 = mysqli_fetch_array($query2);
                            $currMonthCollection = $ret2['currMonthCollection'];

                            $query2 = mysqli_query($con, "SELECT SUM(AmountPayable) AS currYearCollection FROM ticket WHERE YEAR(Date) = YEAR(CURDATE())");
                            $ret2 = mysqli_fetch_array($query2);
                            $currYearCollection = $ret2['currYearCollection'];
                        ?>
                        <p>Today: ₹<?php echo $todayCollection;?></p>
                        <p>Current month: ₹<?php echo $currMonthCollection;?></p>
                        <p>Current year: ₹<?php echo $currYearCollection;?></p>
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