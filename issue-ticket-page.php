<?php
session_start();
include('includes/dbconnection.php');
error_reporting(0);

if(strlen($_SESSION['pmsEmpId'] == 0)) {
    echo "<script>
            alert('Session expired, Please login again.')
            window.location.replace('logout.php');
        </script>";
} else{
    if(isset($_POST['submit'])) {
        $name = $_POST['name'];
        $contactNo = $_POST['contactNo'];
        $emailId = $_POST['emailId'];
        $date = $_POST['date'];
        $noOfAdults = $_POST['noOfAdults'];
        $noOfChild = $_POST['noOfChild'];
        $staffId = $_SESSION['pmsEmpId'];

        if($noOfAdults == 0 && $noOfChild == 0) {
            echo "<script>alert('Cannot issue ticket Adult and children count is zero')</script>";
            echo '<script>window.location.replace("issue-ticket-page.php")</script>';
        }else{
            $query1 = mysqli_query($con,"SELECT * FROM feePerUnit");
            $ret = mysqli_fetch_array($query1);

            if($ret > 0 && $query1) {
                $adultRate = $ret['AdultTicketRate'];
                $childRate = $ret['ChildTicketRate'];
                $cameraRate = $ret['CameraCarryRate'];
            }else{
                echo 'Error description: ' . mysqli_error($con);
                echo "<script>alert('Could not fetch ticket rate from database. Please try again.')</script>";
                echo '<script>window.location.replace("issue-ticket-page.php")</script>';
            }

            if(isset($_POST['isCamera'])) {
                $isCamera = 'TRUE';
                $totalAmountPayble = ($noOfAdults * $adultRate) + ($noOfChild * $childRate) + $cameraRate;
            }else {
                $isCamera = 'FALSE';
                $totalAmountPayble = ($noOfAdults * $adultRate) + ($noOfChild * $childRate);
            }

            $query2 = mysqli_query($con, "INSERT INTO ticket (`Name`, `MobileNumber`, `Email`, `NoOfAdult`, `NoOfChildren`, `IsCamera`, `Date`, `AdultTicketRate`, `ChildTicketRate`, `CameraCarryRate`, `AmountPayable`, `StaffId`) VALUES ('$name', '$contactNo', '$emailId', $noOfAdults, $noOfChild, $isCamera, '$date', $adultRate, $childRate, $cameraRate, $totalAmountPayble, $staffId)");

            if($query2) {

                $query3 = mysqli_query($con,"SELECT NoOfTicket FROM staffPerformance where StaffId = $staffId");
                $ret = mysqli_fetch_array($query3);
                $ticketTillNow = $ret['NoOfTicket'] + 1;

                $query3 = mysqli_query($con,"UPDATE staffPerformance SET NoOfTicket=$ticketTillNow WHERE StaffId=$staffId");
                if($query3) {
                    $oldRating = (($ticketTillNow - 1) / 100);
                    $rating = ($ticketTillNow / 100);
                    
                    if($rating == 10 && $oldRating == 9) {
                        $query4 = mysqli_query($con,"INSERT INTO bestEmployee (`StaffId`, `DateOfAddition`) VALUES ($staffId, $date)");
                        $query5 = mysqli_query($con,"UPDATE staffPerformance SET Rating=$rating WHERE StaffId=$staffId");
                    }elseif($rating < 10 && $rating != $oldRating) {
                        $query6 = mysqli_query($con,"UPDATE staffPerformance SET Rating=$rating WHERE StaffId=$staffId");
                    }
                }else{
                    echo 'Error description: ' . mysqli_error($con);
                    echo '<script>alert("Performance table not updated, Please try again.")</script>';
                }
                
                $msg = "New Ticket Issued, amount payable is ₹" . $totalAmountPayble;
                echo "<script>alert('$msg')</script>";
            }else{
                echo 'Error description: ' . mysqli_error($con);
                echo '<script>alert("Something Went Wrong. Please try again.")</script>';
            }
        }
    }
?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Issue Ticket - Park Ticket Management System</title>
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
                        <li><span>Issue Ticket</span></li>
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
                                        <h4 class="header-title">Issue New Ticket</h4>
                                        <form method="post" action="" name="">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1" class="ptb--10">Name</label>
                                                <input type="text" class="form-control form-rounded" id="name" name="name" placeholder="Name of the ticket holder" value="" required="true">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1" class="ptb--10">Mobile Number</label>
                                                <input type="text" class="form-control form-rounded" id="contactNo" name="contactNo" placeholder="Contact details" value="" required="true">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1" class="ptb--10">Email Id</label>
                                                <input type="text" class="form-control form-rounded" id="emailId" name="emailId" placeholder="Mail ID" value="">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1" class="ptb--10">Adult Count</label>
                                                <input type="text" class="form-control form-rounded" id="noOfAdults" name="noOfAdults" placeholder="Number of adults" value="0" required="true">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1" class="ptb--10">Children Count</label>
                                                <input type="text" class="form-control form-rounded" id="noOfChild" name="noOfChild" placeholder="Number of Children" value="0" required="true">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1" class="ptb--10">Ticket Date</label>
                                                <input type="date" class="form-control form-rounded" id="date" name="date" required="true">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1" class="ptb--10">Carrying Camera</label>
                                                <input type="checkbox" class="form-control form-rounded" id="isCamera" name="isCamera" value="">
                                            </div>
                                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4" name="submit">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!--form end -->
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
<?php } ?>