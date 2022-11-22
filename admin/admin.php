<?php
session_start();
include_once 'db.php';
$username = $_POST['uname'];
$password = $_POST['password'];

// $username = stripslashes($username);
// $username = addslashes($username);
// $password = stripslashes($password);
// $password = addslashes($password);
$result = mysqli_query($con, "SELECT username FROM admin WHERE username = '$username' and password = '$password'") or die('Error');
$count = mysqli_num_rows($result);
if ($count == 1) {
    if (isset($_SESSION['username'])) {
        session_unset();
    }
    $_SESSION["name"]     = 'Admin';
    $_SESSION["key"]      = '54585c506829293a2d4c3b68543b316e2e7a2d277858545a36362e5f39';
    $_SESSION["username"] = $username;
    $_SESSION["email"] = $username;
    header("location:dash.php?q=0");
} else {
    $msg = "Hey admin! <br/>Incorrect deatils, try again!";
    header("location:../incorrect?msg=$msg");
}
