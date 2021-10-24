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
    <title>Staff Member List - Park Ticket Management System</title>
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
                        <li><a href="staff-members-page.php">Staff Members</a></li>
                        <li><span>Staff Member List</span></li>
                    </ul>
                </div>
                <div style="text-align-last: end;">
                    <a href="logout.php">LogOut</a>
                </div>
            </div>
            
            <div class="login-form-head" style="margin-bottom: 10px;">
                <h4>Staff Members List: </h4>    
            </div>
            <div class="login-box">
                <form>
                    <?php
                        $query = mysqli_query($con, "SELECT StaffId AS 'Employee Id', Name, UserName, Gender, MobileNumber, Email, DOB AS 'Date of birth', RegDate AS 'Joining date', IsAdmin AS 'Is Admin' FROM staffMembers");

                        while ($row = mysqli_fetch_assoc($query)) {
                            echo "<div class='login-form-head' style='margin-bottom: 10px;'>";
                            foreach ($row as $field => $value) {
                                echo "<p>" . $field . ": " . $value . "</p>";
                            }
                            echo "</div>";
                        }
                    ?>
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