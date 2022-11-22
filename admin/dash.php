<?php
include_once 'db.php';
session_start();
if (!(isset($_SESSION['email']))) {
    header("location:index.php");
} else {
    $name = $_SESSION['name'];
    $email = $_SESSION['email'];
    include_once 'db.php';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Dashboard</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../assets/vendors/iconfonts/ionicons/dist/css/ionicons.css">
    <link rel="stylesheet" href="../assets/vendors/iconfonts/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.addons.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <script src="../assets/js/jquery.js" type="text/javascript"></script>
    <!-- endinject -->
    <!-- plugin css for this page -->
    <script src="../assets/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="../assets/css/shared/style.css">
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="../assets/css/demo_1/style.css">
    <!-- End Layout styles -->
    <link rel="shortcut icon" href="../assets/images/favicon.ico" />
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
                <a class="navbar-brand brand-logo" href="#">
                    <span>FPI</span>
                </a>
                <a class="navbar-brand brand-logo-mini" href="#">
                    <span>FPI</span></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center">
                <ul class="navbar-nav">
                    <li class="nav-item font-weight-semibold d-none d-lg-block">Help : +234 0000 0000</li>
                    <li class="nav-item language-drop">
                        <a class="nav-link  px-2 d-flex align-items-center" id="LanguageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                            <div class="d-inline-flex mr-0 mr-md-3">
                                <div class="flag-icon-holder">
                                    <i class="flag-icon flag-icon-ng"></i>
                                </div>
                            </div>
                            <span class="profile-text font-weight-medium d-none d-md-block">English</span>
                        </a>
                    </li>
                </ul>

                <ul class="navbar-nav ml-auto">
                    <li><a href="logout.php"><span class="glyphicon glyphicon-log-out btn-danger" aria-hidden="true"></span>&nbsp;Log out</a></li>
                    <li class="nav-item dropdown d-none d-xl-inline-block user-dropdown">
                        <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                            <img class="img-xs rounded-circle" src="../assets/images/faces/face10.jpg" alt="Profile image"> </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                            <div class="dropdown-header text-center">
                                <img class="img-md rounded-circle" src="../assets/images/faces/face10.jpg" alt="Profile image">
                                <p class="mb-1 mt-3 font-weight-semibold"><?php echo $_SESSION['username']; ?></p>
                            </div>
                            <a href="logout" class="dropdown-item">Sign Out<i class="dropdown-item-icon ti-power-off"></i></a>
                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item nav-profile">
                        <a href="#" class="nav-link">
                            <div class="profile-image">
                                <img class="img-xs rounded-circle" src="../assets/images/faces/face10.jpg" alt="profile image">
                                <div class="dot-indicator bg-success"></div>
                            </div>
                            <div class="text-wrapper">
                                <p class="profile-name"><?php echo $_SESSION['username']; ?></p>
                                <p class="designation">Admin</p>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item nav-category">Main Menu</li>
                    <li class="nav-item">
                        <a class="nav-link" href="dash?q=0">
                            <i class="menu-icon typcn typcn-document-text"></i>
                            <span class="menu-title">Courses Details</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="dash?q=1">
                            <i class="menu-icon typcn typcn-document-text"></i>
                            <span class="menu-title">Users</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="dash?q=2">
                            <i class="menu-icon typcn typcn-document-text"></i>
                            <span class="menu-title">Student Score</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="dash?q=6">
                            <i class="menu-icon typcn typcn-document-text"></i>
                            <span class="menu-title">Add Student</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="dash?q=4">
                            <i class="menu-icon typcn typcn-document-text"></i>
                            <span class="menu-title">Input New Quiz</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="dash?q=5">
                            <i class="menu-icon typcn typcn-document-text"></i>
                            <span class="menu-title">Delete Quiz</span>
                        </a>
                    </li>




                </ul>
            </nav>
            <!-- partial -->




            <div class="row">
                <div class="col-md-12">
                    <?php
                    if (@$_GET['q'] == 0) {

                        $result = mysqli_query($con, "SELECT * FROM quiz ORDER BY date DESC") or die('Error');
                        echo '<div class="panel"><table class="table table-striped title1"  style="vertical-align:middle">
<tr><td style="vertical-align:middle"><b>S.N.</b></td><td style="vertical-align:middle"><b>Name</b></td><td style="vertical-align:middle"><b>Total question</b></td><td style="vertical-align:middle"><b>Marks</b></td><td style="vertical-align:middle"><b>Time limit</b></td><td style="vertical-align:middle"><b>Status</b></td><td style="vertical-align:middle"><b>Action</b></td></tr>';
                        $c = 1;
                        while ($row = mysqli_fetch_array($result)) {
                            $title   = $row['title'];
                            $total   = $row['total'];
                            $time    = $row['time'];
                            $eid     = $row['eid'];
                            $status  = $row['status'];
                            if ($status == "enabled") {
                                echo '<tr><td style="vertical-align:middle">' . $c++ . '</td><td style="vertical-align:middle">' . $title . '</td><td style="vertical-align:middle">' . $total . '</td><td style="vertical-align:middle">' . $total . '</td><td style="vertical-align:middle">' . $time . '&nbsp;min</td><td style="vertical-align:middle">Enabled</td>
  <td style="vertical-align:middle"><b><a href="update?deidquiz=' . $eid . '" class="btn logb" style="color:#FFFFFF;background:#ff0000;font-size:12px;padding:5px;">&nbsp;<span><b>Disable</b></span></a></b></td></tr>';
                            } else {
                                echo '<tr><td style="vertical-align:middle">' . $c++ . '</td><td style="vertical-align:middle">' . $title . '</td><td style="vertical-align:middle">' . $total . '</td><td style="vertical-align:middle">' . $total . '</td><td style="vertical-align:middle">' . $time . '&nbsp;min</td><td style="vertical-align:middle">Disabled</td>
  <td style="vertical-align:middle"><b><a href="update?eeidquiz=' . $eid . '" class="btn logb" style="color:#FFFFFF;background:darkgreen;font-size:12px;padding:5px;">&nbsp;<span><b>Enable</b></span></a></b></td></tr>';
                            }
                        }
                    }
                    if (@$_GET['q'] == 2) {
                        if (isset($_GET['show'])) {
                            $show = $_GET['show'];
                            $showfrom = (($show - 1) * 10) + 1;
                            $showtill = $showfrom + 9;
                        } else {
                            $show = 1;
                            $showfrom = 1;
                            $showtill = 10;
                        }
                        $q = mysqli_query($con, "SELECT * FROM result") or die('Error223');
                        echo '<div class="panel title">
<table class="table table-striped title1" >
<tr><td style="vertical-align:middle"><b>Rank</b></td><td style="vertical-align:middle"><b>Name</b></td><td style="vertical-align:middle"><b>Course</b></td><td style="vertical-align:middle"><b>Score</b></td></tr>';
                        $c = $showfrom - 1;
                        $total = mysqli_num_rows($q);
                        if ($total >= $showfrom) {
                            while ($row = mysqli_fetch_array($q)) {
                                $name = $row['names'];
                                $s = $row['total'];
                                $eid = $row['eid'];
                                $qid = $row['qid'];

                                $q12 = mysqli_query($con, "SELECT * FROM quiz WHERE eid='$eid' ") or die('Error231');
                                while ($row = mysqli_fetch_array($q12)) {
                                    $course     = $row['title'];
                                }
                                $c++;
                                echo '<tr><td style="color:#99cc32"><b>' . $c . '</b></td><td style="vertical-align:middle">' . $name . '</td><td style="vertical-align:middle">' . $course . '</td><td style="vertical-align:middle">' . $s . '</td><td style="vertical-align:middle">';
                            }
                        } else {
                        }
                        echo '</table></div>';
                        echo '<div class="panel title"><table class="table table-striped title1" ><tr>';
                        $total = round($total / 10) + 1;
                        if (isset($_GET['show'])) {
                            $show = $_GET['show'];
                        } else {
                            $show = 1;
                        }
                        if ($show == 1 && $total == 1) {
                        } else if ($show == 1 && $total != 1) {
                            $i = 1;
                            while ($i <= $total) {
                                echo '<td style="vertical-align:middle;text-align:center"><a style="font-size:14px;font-family:typo;font-weight:bold" href="dash?q=2&show=' . $i . '">&nbsp;' . $i . '&nbsp;</a></td>';
                                $i++;
                            }
                            echo '<td style="vertical-align:middle;text-align:center"><a style="font-size:14px;font-family:typo;font-weight:bold" href="dash?q=2&show=' . ($show + 1) . '">&nbsp;>>&nbsp;</a></td>';
                        } else if ($show != 1 && $show == $total) {
                            echo '<td style="vertical-align:middle;text-align:center"><a style="font-size:14px;font-family:typo;font-weight:bold" href="dash?q=2&show=' . ($show - 1) . '">&nbsp;<<&nbsp;</a></td>';

                            $i = 1;
                            while ($i <= $total) {
                                echo '<td style="vertical-align:middle;text-align:center"><a style="font-size:14px;font-family:typo;font-weight:bold" href="dash?q=2&show=' . $i . '">&nbsp;' . $i . '&nbsp;</a></td>';
                                $i++;
                            }
                        } else {
                            echo '<td style="vertical-align:middle;text-align:center"><a style="font-size:14px;font-family:typo;font-weight:bold" href="dash?q=2&show=' . ($show - 1) . '">&nbsp;<<&nbsp;</a></td>';
                            $i = 1;
                            while ($i <= $total) {
                                echo '<td style="vertical-align:middle;text-align:center"><a style="font-size:14px;font-family:typo;font-weight:bold" href="dash?q=2&show=' . $i . '">&nbsp;' . $i . '&nbsp;</a></td>';
                                $i++;
                            }
                            echo '<td style="vertical-align:middle;text-align:center"><a style="font-size:14px;font-family:typo;font-weight:bold" href="dash?q=2&show=' . ($show + 1) . '">&nbsp;>>&nbsp;</a></td>';
                        }
                        echo '</tr></table></div>';
                    }
                    if (@$_GET['q'] == 1) {

                        $result = mysqli_query($con, "SELECT * FROM user") or die('Error');
                        echo '<div class="panel"><table class="table table-striped title1">
<tr><td style="vertical-align:middle"><b>S.N.</b></td><td style="vertical-align:middle"><b>Name</b></td><td style="vertical-align:middle"><b>Gender</b></td><td style="vertical-align:middle"><b>Rollno</b></td><td style="vertical-align:middle"><b>Branch</b></td><td style="vertical-align:middle"><b>Username</b></td><td style="vertical-align:middle"><b>Phno</b></td><td style="vertical-align:middle"></td></tr>';
                        $c = 1;
                        while ($row = mysqli_fetch_array($result)) {
                            $name      = $row['name'];
                            $phno      = $row['phno'];
                            $gender    = $row['gender'];
                            $rollno    = $row['rollno'];
                            $branch    = $row['branch'];
                            $username1 = $row['username'];

                            echo '<tr><td style="vertical-align:middle">' . $c++ . '</td><td style="vertical-align:middle">' . $name . '</td><td style="vertical-align:middle">' . $gender . '</td><td style="vertical-align:middle">' . $rollno . '</td><td style="vertical-align:middle">' . $branch . '</td><td style="vertical-align:middle">' . $username1 . '</td><td style="vertical-align:middle">' . $phno . '</td>
  <td style="vertical-align:middle"><a title="Delete User" href="update?dusername=' . $username1 . '"><b><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></b></a></td></tr>';
                        }
                        $c = 0;
                        echo '</table></div>';
                    }
                    if (@$_GET['q'] == 3) {
                        $result = mysqli_query($con, "SELECT * FROM `feedback` ORDER BY `feedback`.`date` DESC") or die('Error');
                        echo '<div class="panel"><table class="table table-striped title1">
<tr><td style="vertical-align:middle"><b>S.N.</b></td><td style="vertical-align:middle"><b>Subject</b></td><td style="vertical-align:middle"><b>Username</b></td><td style="vertical-align:middle"><b>Date</b></td><td style="vertical-align:middle"><b>Time</b></td><td style="vertical-align:middle"><b>By</b></td><td style="vertical-align:middle"></td><td style="vertical-align:middle"><b>Action</b></td></tr>';
                        $c = 1;
                        while ($row = mysqli_fetch_array($result)) {
                            $date      = $row['date'];
                            $date      = date("d-m-Y", strtotime($date));
                            $time      = $row['time'];
                            $subject   = $row['subject'];
                            $name      = $row['name'];
                            $username1 = $row['username'];
                            $id        = $row['id'];
                            echo '<tr><td style="vertical-align:middle">' . $c++ . '</td>';
                            echo '<td style="vertical-align:middle"><a title="Click to open feedback" href="dash?q=3&fid=' . $id . '">' . $subject . '</a></td><td style="vertical-align:middle">' . $username1 . '</td><td style="vertical-align:middle">' . $date . '</td><td style="vertical-align:middle">' . $time . '</td><td style="vertical-align:middle">' . $name . '</td>
  <td style="vertical-align:middle"><a title="Open Feedback" href="dash?q=3&fid=' . $id . '"><b><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span></b></a></td>';
                            echo '<td style="vertical-align:middle"><a title="Delete Feedback" href="update?fdid=' . $id . '"><b><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></b></a></td>

  </tr>';
                        }
                        echo '</table></div>';
                    }
                    if (@$_GET['fid']) {
                        echo '<br />';
                        $id = @$_GET['fid'];
                        $result = mysqli_query($con, "SELECT * FROM feedback WHERE id='$id' ") or die('Error');
                        while ($row = mysqli_fetch_array($result)) {
                            $name     = $row['name'];
                            $subject  = $row['subject'];
                            $date     = $row['date'];
                            $date     = date("d-m-Y", strtotime($date));
                            $time     = $row['time'];
                            $feedback = $row['feedback'];

                            echo '<div class="panel"<a title="Back to Archive" href="update?q1=2"><b><span class="glyphicon glyphicon-level-up" aria-hidden="true"></span></b></a><h2 style="text-align:center; margin-top:-15px;font-family: "Ubuntu", sans-serif;"><b>' . $subject . '</b></h1>';
                            echo '<div class="mCustomScrollbar" data-mcs-theme="dark" style="margin-left:10px;margin-right:10px; max-height:450px; line-height:35px;padding:5px;"><span style="line-height:35px;padding:5px;">-&nbsp;<b>DATE:</b>&nbsp;' . $date . '</span>
<span style="line-height:35px;padding:5px;">&nbsp;<b>Time:</b>&nbsp;' . $time . '</span><span style="line-height:35px;padding:5px;">&nbsp;<b>By:</b>&nbsp;' . $name . '</span><br />' . $feedback . '</div></div>';
                        }
                    }
                    if (@$_GET['q'] == 4 && !(@$_GET['step'])) {
                        echo ' <div class="col-md-12 row">
<span class="title1" style="margin-left:40%;font-size:30px;"><b>Enter Quiz Details</b></span><br /><br />
<div class="col-md-12">   
 <form class="form-horizontal title1" name="form" action="update?q=addquiz"  method="POST">
<fieldset>
<div class="form-group">
  <label class="col-md-12 control-label" for="name"></label>  
  <div class="col-md-12">
  <input id="name" name="name" placeholder="Enter Quiz title" class="form-control input-md" type="text">
    
  </div>
</div>
<div class="form-group">
  <label class="col-md-12 control-label" for="total"></label>  
  <div class="col-md-12">
  <input id="total" name="total" placeholder="Enter total number of questions" class="form-control input-md" type="number">
    
  </div>
</div>

<div class="form-group">
  <label class="col-md-12 control-label" for="time"></label>  
  <div class="col-md-12">
  <input id="time" name="time" placeholder="Enter time limit for test in minute" class="form-control input-md" min="1" type="number">
    
  </div>
</div>


<div class="form-group">
  <label class="col-md-12 control-label" for=""></label>
  <div class="col-md-12"> 
    <input  type="submit" style="margin-left:5%" class="btn btn-primary" value="Submit" class="btn btn-primary"/>
  </div>
</div>

</fieldset>
</form></div>';
                    }
                    if (@$_GET['q'] == 4 && (@$_GET['step']) == 2) {
                        echo ' 
<div class="row">
<span class="title1" style="margin-left:10%;font-size:30px;"><b>Enter Question Details</b></span><br /><br />
 <div class="col-md-12">
    <form class="form-horizontal title1" name="form" action="update?q=addqns&n=' . @$_GET['n'] . '&eid=' . @$_GET['eid'] . '&ch=4 "  method="POST">
<fieldset>';

                        for ($i = 1; $i <= @$_GET['n']; $i++) {
                            echo '<b style="margin-left:10%">Question number&nbsp;' . $i . '&nbsp;:</><br /><!-- Text input-->
<div class="form-group" style="margin-left:10%">
  <label class="col-md-12 control-label" for="qns' . $i . ' "></label>  
  <div class="col-md-12">
  <textarea rows="3" cols="5" name="qns' . $i . '" class="form-control" placeholder="Write question number ' . $i . ' here..."></textarea>  
  </div>
</div>
<div class="form-group" style="margin-left:10%">
  <label class="col-md-12 control-label" for="' . $i . '1"></label>  
  <div class="col-md-12">
  <input id="' . $i . '1" name="' . $i . '1" placeholder="Enter 1st Keyword" class="form-control input-md" type="text">
    
  </div>
</div>
<div class="form-group" style="margin-left:10%">
  <label class="col-md-12 control-label" for="' . $i . '2"></label>  
  <div class="col-md-12">
  <input id="' . $i . '2" name="' . $i . '2" placeholder="Enter 2nd Keyword" class="form-control input-md" type="text">
    
  </div>
</div>
<div class="form-group" style="margin-left:10%">
  <label class="col-md-12 control-label" for="' . $i . '3"></label>  
  <div class="col-md-12">
  <input id="' . $i . '3" name="' . $i . '3" placeholder="Enter 3rd Keyword" class="form-control input-md" type="text">
    
  </div>
</div>
<div class="form-group" style="margin-left:10%">
  <label class="col-md-12 control-label" for="' . $i . '4"></label>  
  <div class="col-md-12">
  <input id="' . $i . '4" name="' . $i . '4" placeholder="Enter 4th Keyword" class="form-control input-md" type="text">
    
  </div>
</div>';
                        }

                        echo '<div class="form-group" style="margin-left:10%">
  <label class="col-md-12 control-label" for=""></label>
  <div class="col-md-12"> 
    <input  type="submit" style="margin-left:5%" class="btn btn-primary" value="Submit" class="btn btn-primary"/>
  </div>
</div>

</fieldset>
</form></div>';
                    }
                    if (@$_GET['q'] == 5) {

                        $result = mysqli_query($con, "SELECT * FROM quiz ORDER BY date DESC") or die('Error');
                        echo '<div class="panel col-12"><table class="table table-striped title1">
<tr><td style="vertical-align:middle"><b>S.N.</b></td><td style="vertical-align:middle"><b>Topic</b></td><td style="vertical-align:middle"><b>Total question</b></td><td style="vertical-align:middle"><b>Marks</b></td><td style="vertical-align:middle"><b>Time limit</b></td><td style="vertical-align:middle"><b>Action</b></td></tr>';
                        $c = 1;
                        while ($row = mysqli_fetch_array($result)) {
                            $title   = $row['title'];
                            $total   = $row['total'];
                            $time    = $row['time'];
                            $eid     = $row['eid'];
                            echo '<tr><td style="vertical-align:middle">' . $c++ . '</td><td style="vertical-align:middle">' . $title . '</td><td style="vertical-align:middle">' . $total . '</td><td style="vertical-align:middle">' . $total . '</td><td style="vertical-align:middle">' . $time . '&nbsp;min</td>
  <td style="vertical-align:middle"><b><a href="update?q=rmquiz&eid=' . $eid . '" class="btn" style="margin:0px;background:red;color:white">&nbsp;<span class="title1"><b>Remove</b></span></a></b></td></tr>';
                        }
                        $c = 0;
                        echo '</table></div>';
                    }
                    ?>
                </div>
            </div>
            <?php
            if (@$_GET['q'] == 6) {
                echo '<div class="col-md-4">  
                <h3>Register Student</h3> 
 <form class="form-horizontal title1" name="form" action="sign.php?q=account.php"  method="POST">
<fieldset>
<div class="form-group">
 <label class="col-md-3 control-label" for="name"></label>  
  <div class="col-md-6">
  <input id="name" name="name" placeholder="Enter Fullname" class="form-control input-md" type="username"> 
  </div>
</div>
<div class="form-group">
  <label class="col-md-3 control-label" for="username"></label>
  <div class="col-md-6">
    <input id="username" name="username" placeholder="Enter your Username" class="form-control input-md" type="username" required>
</div>
<div class="form-group">
  <label class="col-md-12 control-label" for="phno"></label>  
  <div class="col-md-12">
  <input id="phno" name="phno" placeholder="Enter Phone Number" class="form-control input-md" min="0" type="number" required>
    
  </div>
</div>
<div class="form-group">
  <label class="col-md-12 control-label" for="rollno"></label>  
  <div class="col-md-12">
  <input id="rollno" name="rollno" placeholder="Enter Roll Number" class="form-control type="text" required>
    
  </div>
</div>
<div class="form-group">
  <label class="col-md-12 control-label" for="gender"></label>  
  <select id="gender" name="gender" placeholder="Select your gender" class="form-control input-md" required>
    <option value="" >Select Gender</option>
    <option value="M">Male</option>
    <option value="F">Female</option> 
  </select>  
</div>
<div class="form-group">
  <label class="col-md-12 control-label" for="password"></label>  
  <div class="col-md-12">
  <input id="password" name="password" placeholder="Enter password" class="form-control type="password" required>
    
  </div>
</div>


<div class="form-group">
  <label class="col-md-12 control-label" for=""></label>
  <div class="col-md-12"> 
    <input  type="submit" style="margin-left:5%" class="btn btn-primary" value="Submit" class="btn btn-primary"/>
  </div>
</div>

</fieldset>
</form></div>';
            }

            ?>

            <!-- container-scroller -->
            <!-- plugins:js -->
            <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
            <script src="../assets/vendors/js/vendor.bundle.addons.js"></script>
            <!-- endinject -->
            <!-- Plugin js for this page-->
            <!-- End plugin js for this page-->
            <!-- inject:js -->
            <script src="../assets/js/shared/off-canvas.js"></script>
            <!-- Custom js for this page-->
            <script src="../assets/js/demo_1/dashboard.js"></script>
            <!-- End custom js for this page -->
            <script src="../assets/js/shared/jquery.cookie.js" type="text/javascript"></script>