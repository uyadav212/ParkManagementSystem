<?php
session_start();
include('includes/dbconnection.php');
error_reporting(0);

if(strlen($_SESSION['pmsEmpId'] == 0)) {
    echo "<script>
            alert('Session expired, Please login again.')
            window.location.replace('logout.php');
        </script>";
} else {

?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Employee Performance - Park Ticket Management System</title>
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

    <div class="page-container">
        <div class="main-content">
            
            <!-- header area start -->
            <?php include_once('includes/header.php');?>
            <!-- header area end -->
            
            <div style="width: 100%; display: inline-block;">
                <div style="float: left;">
                    <ul class="breadcrumbs pull-left">
                        <li><a href="dashboard.php">Dashboard</a></li>
                        <li><a href="employee-statistic-page.php">Employee Stats Section</a></li>
                        <li><span>Employee Performance</span></li>
                    </ul>
                </div>
                <div style="text-align-last: end;">
                    <a href="logout.php">LogOut</a>
                </div>
            </div>

            <?php
                $staffId = $_SESSION['pmsEmpId'];
                $name = $_SESSION['pmsEmpName'];

                $query1 = mysqli_query($con, "SELECT Rating, NoOfTicket FROM staffPerformance WHERE StaffId = $staffId");
                $ret1 = mysqli_fetch_array($query1);
                $rating = $ret1['Rating'];
                $noOfTickets = $ret1['NoOfTicket'];

                $query2 = mysqli_query($con, "SELECT SUM(AmountPayable) AS todayCollection FROM ticket WHERE DATE(Date) = CURDATE() AND StaffId = $staffId");
                $ret2 = mysqli_fetch_array($query2);
                $todayCollection = $ret2['todayCollection'];

                $query3 = mysqli_query($con, "SELECT SUM(AmountPayable) AS currMonthCollection FROM ticket WHERE MONTH(Date) = MONTH(CURDATE()) AND YEAR(Date) = YEAR(CURDATE()) AND StaffId = $staffId");
                $ret3 = mysqli_fetch_array($query3);
                $currMonthCollection = $ret3['currMonthCollection'];

                $query4 = mysqli_query($con, "SELECT SUM(AmountPayable) AS currYearCollection FROM ticket WHERE YEAR(Date) = YEAR(CURDATE()) AND StaffId = $staffId");
                $ret4 = mysqli_fetch_array($query4);
                $currYearCollection = $ret4['currYearCollection'];
            ?>
            <div class="login-form-head" style="margin-bottom: 10px;">
                <h4>Employee Performance</h4>
                <p>ID: <?php echo $staffId;?></p>
                <p>Name: <?php echo $name;?></p>
            </div>
            <div class="login-box">
                <form>
                    <div class="login-form-head" style="margin-bottom: 10px;">
                        <h4>Rating</h4>
                        <p>Present rating of <?php echo $name;?> is <?php echo $rating;?> [out of 10]</p>
                    </div>
                    <div class="login-form-head" style="margin-bottom: 10px;">
                        <h4>Tickets</h4>
                        <p>Total number of tickets issued by <?php echo $name;?> are <?php echo $noOfTickets;?></p>
                    </div>
                    <div class="login-form-head" style="margin-bottom: 10px;">
                        <h4>Amount Collected</h4>
                        <p>Total amount collected by <?php echo $name;?></p>
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
<?php }?>