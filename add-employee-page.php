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
                alert('Only Admin can add new staff members')
                window.location.replace('staff-members-page.php');
            </script>";
    }else {
        if(isset($_POST['submit'])) {
            $empName = $_POST['empName'];
            $gender = $_POST['gender'];
            $username = $_POST['username'];
            $contactNo = $_POST['contactNo'];
            $emailId = $_POST['emailId'];
            $password = $_POST['password'];
            $regDate = $_POST['regDate'];
            $dob = $_POST['dob'];
            if(isset($_POST['isAdmin'])) {
                $isAdmin = 'TRUE';
            }else {
                $isAdmin = 'FALSE';
            }
       
            $query1 = mysqli_query($con, "INSERT INTO staffMembers (`Name`, `UserName`, `MobileNumber`, `Email`, `Gender`, `Password`, `DOB`, `RegDate`, `IsAdmin`) VALUES ('$empName', '$username', '$contactNo', '$emailId', '$gender', '$password', '$dob', '$regDate', $isAdmin)");

            if($query1) {
                $query2 = mysqli_query($con, "SELECT StaffId FROM staffMembers WHERE UserName='$username'");
                $ret = mysqli_fetch_array($query2);
                $staffId = $ret['StaffId'];

                $query3 = mysqli_query($con, "INSERT INTO staffPerformance (`StaffId`, `NoOfTicket`, `Rating`) VALUES ($staffId, 0, 0);");
                if(!$query3) {
                    echo "Error description: " . mysqli_error($con);
                    echo '<script>alert("Something Went Wrong. Please try again.")</script>';
                }

                echo "<script>
                        alert('New staff member successfully added.')
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
    <title>Add New Staff Member - Park Ticket Management System</title>
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
                        <li><span>Add Staff Memeber</span></li>
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
                                        <h4 class="header-title">Add employee details</h4>
                                        <form method="post" action="" name="">
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
                                                <label for="exampleInputEmail1" class="ptb--10">Username</label>
                                                <input type="text" class="form-control form-rounded" id="username" name="username" placeholder="User handle" value="" required="true">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1" class="ptb--10">Mobile Number</label>
                                                <input type="text" class="form-control form-rounded" id="contactNo" name="contactNo" placeholder="Contact details" value="" required="true">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1" class="ptb--10">Email Id</label>
                                                <input type="text" class="form-control form-rounded" id="emailId" name="emailId" placeholder="Mail ID" value="" required="true">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1" class="ptb--10">Password</label>
                                                <input type="password" class="form-control form-rounded" id="password" name="password" placeholder="Password" value="" required="true">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1" class="ptb--10">Registration Date</label>
                                                <input type="date" class="form-control form-rounded" id="regDate" name="regDate">
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