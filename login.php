<?php
session_start();
if (isset($_SESSION["username"])) {
    session_destroy();
}
include_once 'config/db.php';
$ref      = @$_GET['q'];
$username = $_POST['username'];
$password = $_POST['password'];

$username = stripslashes($username);
$username = addslashes($username);
$password = stripslashes($password);
$password = addslashes($password);
$password = md5($password);
$result = mysqli_query($con, "SELECT name FROM user WHERE username = '$username' and password = '$password'") or die('Error');
$count = mysqli_num_rows($result);
if ($count == 1) {
    while ($row = mysqli_fetch_array($result)) {
        $name = $row['name'];
    }
    $_SESSION["name"]     = $name;
    $_SESSION["username"] = $username;
    $msg = "Login Successful... Logging user";
    header("location:pages/dashboard?q=1");
} else {
    $msg = "Incorrect deatils try again! or Kindly contact your instructor";
    header("location:incorrect?msg=$msg");
}
