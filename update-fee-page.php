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
    if($_SESSION['pmsEmpIsAdmin'] == 0) {
        echo "<script>
                alert('Only Admin can update ticket rates')
                window.location.replace('dashboard.php');
            </script>";
    }else {
        if(isset($_POST['submit'])) {
            $adultRate = $_POST['adultRate'];
            $childrenRate = $_POST['childrenRate'];
            $cameraRate = $_POST['cameraRate'];
       
            $query1=mysqli_query($con, "DELETE FROM feePerUnit");
            if(!$query1) {
                echo "<script>
                        alert('Unable to remove old rates from DB, Please try again.')
                        window.location.replace('update-fee-page.php');
                    </script>";
            }

            $query2=mysqli_query($con, "INSERT INTO feePerUnit (`AdultTicketRate`, `ChildTicketRate`, `CameraCarryRate`) VALUES ($adultRate, $childrenRate, $cameraRate)");
            if($query2) {
                echo "<script>
                        alert('Ticket rates are successfully updated in DB.')
                        window.location.replace('fee-section-page.php');
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
    <title>Update Ticket Rate - Park Ticket Management System</title>
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
                        <li><a href="fee-section-page.php">Fee Section</a></li>
                        <li><span>Update Ticket Rate</span></li>
                    </ul>
                </div>
                <div style="text-align-last: end;">
                    <a href="logout.php">LogOut</a>
                </div>
            </div>
            
            <div class="main-content-inner">
                <div class="row">
                    <div class="col-lg-6 col-ml-12">
                        <div class="row">
                            <!-- employee details form start -->
                            <div class="col-12 mt-5">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title">Add updated ticket rates</h4>
                                        <form method="post" action="" name="">
                                            <div class="login-form-head">
                                                <h4>Current Rates [per head]</h4>
                                                <?php
                                                    $query = mysqli_query($con, "SELECT * FROM feePerUnit");
                                                    $ret = mysqli_fetch_array($query);

                                                    $adultRateInDB = $ret['AdultTicketRate'];
                                                    $childRateInDB = $ret['ChildTicketRate'];
                                                    $cameraRateInDB = $ret['CameraCarryRate'];
                                                ?>
                                                <p>Adults: ₹<?php echo $adultRateInDB; ?></p>
                                                <p>Children: ₹<?php echo $childRateInDB; ?></p>
                                                <p>Camera Carry: ₹<?php echo $cameraRateInDB; ?></p>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1" class="ptb--10">Adult Rate</label>
                                                <input type="text" class="form-control form-rounded" id="adultRate" name="adultRate" placeholder="Rate for adults" value="" required="true">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1" class="ptb--10">Children Rate</label>
                                                <input type="text" class="form-control form-rounded" id="childrenRate" name="childrenRate" placeholder="Rate for children" value="" required="true">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1" class="ptb--10">Camera Carry Rate</label>
                                                <input type="text" class="form-control form-rounded" id="cameraRate" name="cameraRate" placeholder="Extra charge for camera" value="" required="true">
                                            </div>
                                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4" name="submit">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
<?php } } ?>