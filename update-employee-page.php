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
                alert('Only Admin can update staff members details')
                window.location.replace('staff-members-page.php');
            </script>";
    }else {
        if(isset($_POST['submit'])) {
            $username = $_POST['username'];
            $emailId = $_POST['emailId'];

            $query1 = mysqli_query($con, "SELECT StaffId FROM staffMembers WHERE UserName = '$username' AND Email = '$emailId'");
            $ret1 = mysqli_fetch_array($query1);
            
            if($ret1['StaffId'] > 0) {
                $staffId = $ret1['StaffId'];
                $empName = $_POST['empName'];
                $gender = $_POST['gender'];
                $contactNo = $_POST['contactNo'];
                $dob = $_POST['dob'];
                if(isset($_POST['isAdmin'])) {
                    $isAdmin = 'TRUE';
                }else {
                    $isAdmin = 'FALSE';
                }
           
                $query1 = mysqli_query($con, "UPDATE staffMembers SET Name = '$empName', MobileNumber = $contactNo, Gender = '$gender', DOB = '$dob', IsAdmin = $isAdmin WHERE StaffId = $staffId");

                if($query1) {
                    echo "<script>
                            alert('Staff member details successfully updated.')
                            window.location.replace('staff-members-page.php');
                        </script>";
                }else{
                    echo "Error description: " . mysqli_error($con);
                    echo '<script>alert("Something Went Wrong. Please try again.")</script>';
                }
            }else{
                $msg = "NO staff member found [Username: " . $username . " and Email address: " . $emailId . "]";
                echo "<script>alert('$msg')</script>";
            }
        }
?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Update Staff Member Details - Park Ticket Management System</title>
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
                        <li><span>Update Staff Member Details</span></li>
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
                                        <h4 class="header-title">Employee to update</h4>
                                        <form method="post" action="" name="">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1" class="ptb--10">Username</label>
                                                <input type="text" class="form-control form-rounded" id="username" name="username" placeholder="User handle" value="" required="true">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1" class="ptb--10">Email Id</label>
                                                <input type="text" class="form-control form-rounded" id="emailId" name="emailId" placeholder="Mail ID" value="" required="true">
                                            </div>
                                            
                                            <br>
                                            <h4 class="header-title">Add updated details</h4>
                                            <h8>[Only below mentioned field can be updated]</h8>
                                            <br><br>

                                            <div class="form-group">
                                                <label for="exampleInputEmail1" class="ptb--10">Employee Name</label>
                                                <input type="text" class="form-control form-rounded" id="empName" name="empName" placeholder="Name of the employee" value="" required="true">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1" class="ptb--10">DOB</label>
                                                <input type="date" class="form-control form-rounded" id="dob" name="dob" required="true">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1" class="ptb--10">Gender</label>
                                                <select class="form-control form-rounded" id="gender" name="gender" required="true">
                                                    <option value="female">Female</option>
                                                    <option value="male">Male</option>
                                                    <option value="others">Others</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1" class="ptb--10">Mobile Number</label>
                                                <input type="text" class="form-control form-rounded" id="contactNo" name="contactNo" placeholder="Contact details" value="" required="true">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1" class="ptb--10">Is Admin</label>
                                                <input type="checkbox" class="form-control form-rounded" id="isAdmin" name="isAdmin" value="">
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
<?php } } ?>