<?php
include_once '../config/db.php';
session_start();
if (@$_GET['q'] == 'quiz' && @$_GET['step'] == 2) {
    $eid   = @$_GET['eid'];
    $sn    = @$_GET['n'];
    $total = @$_GET['t'];
    $qid   = @$_GET['qid'];
    $myA = ($_GET['ans'] + rand(10, 80));
    $name = $_SESSION['username'];

    print_r($_GET);
    $myAnswer = mysqli_query($con, "INSERT INTO result(qid,eid,names,total) VALUES  ('$qid','$eid','$name','$myA')");
    if (isset($_GET['endquiz']) == 'end') {
        unset($_SESSION['6e447159425d2d']);
        $q = mysqli_query($con, "UPDATE history SET status='finished' WHERE username='$_SESSION[username]' AND eid='$_GET[eid]' ") or die('Error197');
    }
    header("location:quiz?q=1");
}
