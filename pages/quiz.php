<?php
session_start();
include "../temp/header.php";

if (@$_GET['w']) {
    echo '<script>alert("' . @$_GET['w'] . '");</script>';
}
include_once '../config/db.php';

if (!(isset($_SESSION['username']))) {
    header("location:index.php");
} else {
    $name     = $_SESSION['name'];
    $username = $_SESSION['username'];

    include_once '../config/db.php';
    echo '<span class="pull-right top title1" ><span style="color:white"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;&nbsp;Hello,</span> <span class="log log1" style="color:lightyellow">' . $username . '&nbsp;&nbsp;|&nbsp;&nbsp;</span>';
}
?>

<div class="bg">
    <?php
    if (@$_GET['q'] == 1) {
        $result = mysqli_query($con, "SELECT * FROM quiz WHERE status = 'enabled' ORDER BY date DESC") or die('Error');
        echo '<div class="panel"><table class="table table-striped title1"  style="vertical-align:middle">
<tr><td style="vertical-align:middle"><b>S.N.</b></td><td style="vertical-align:middle"><b>Name</b></td><td style="vertical-align:middle"><b>Total question</b></td><td style="vertical-align:middle"><b>Time limit</b></td><td style="vertical-align:middle"><b>Action</b></td></tr>';
        $c = 1;
        while ($row = mysqli_fetch_array($result)) {
            $title   = $row['title'];
            $total   = $row['total'];
            $time    = $row['time'];
            $eids     = $row['eid'];
            $q12 = mysqli_query($con, "SELECT score FROM history WHERE eid='$eids' AND username='$username'") or die('Error98');
            $rowcount = mysqli_num_rows($q12);
            if ($rowcount == 0) {
                echo '<tr><td style="vertical-align:middle">' . $c++ . '</td><td style="vertical-align:middle">' . $title . '</td><td style="vertical-align:middle">' . $total . '</td><td style="vertical-align:middle">' . $time . '&nbsp;min</td>
  <td style="vertical-align:middle"><b><a href="quiz.php?q=quiz&step=2&eid=' . $eids . '&n=1&t=' . $total . '&start=start" class="btn" style="color:#FFFFFF;background:darkgreen;font-size:12px;padding:7px;padding-left:10px;padding-right:10px"><span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>&nbsp;<span><b>Start</b></span></a></b></td></tr>';
            } else {
                $q = mysqli_query($con, "SELECT * FROM history WHERE username='$_SESSION[username]' AND eid='$eids' ") or die('Error197');
                while ($row = mysqli_fetch_array($q)) {
                    $timec  = $row['timestamp'];
                    $status = $row['status'];
                }
                $q = mysqli_query($con, "SELECT * FROM quiz WHERE eid='$eids' ") or die('Error197');
                while ($row = mysqli_fetch_array($q)) {
                    $ttimec  = $row['time'];
                    $qstatus = $row['status'];
                }
                $remaining = (($ttimec * 60) - ((time() - $timec)));
                if ($remaining > 0 && $qstatus == "enabled" && $status == "ongoing") {
                    echo '<tr style="color:darkgreen"><td style="vertical-align:middle">' . $c++ . '</td><td style="vertical-align:middle">' . $title . '&nbsp;<span title="This quiz is already solve by you" class="glyphicon glyphicon-ok" aria-hidden="true"></span></td><td style="vertical-align:middle">' . $total . '<td style="vertical-align:middle">' . $total . '</td><td style="vertical-align:middle">' . $time . '&nbsp;min</td>
  <td style="vertical-align:middle"><b><a href="quiz.php?q=quiz&step=2&eid=' . $eids . '&n=1&t=' . $total . '&start=start" class="btn" style="margin:0px;background:darkorange;color:white">&nbsp;<span class="title1"><b>Continue</b></span></a></b></td></tr>';
                } else {
                    echo '<tr style="color:darkgreen"><td style="vertical-align:middle">' . $c++ . '</td><td style="vertical-align:middle">' . $title . '&nbsp;<span title="This quiz is already solve by you" class="glyphicon glyphicon-ok" aria-hidden="true"></span></td><td style="vertical-align:middle">' . $total . '<td style="vertical-align:middle">' . $total . '</td><td style="vertical-align:middle">' . $time . '&nbsp;min</td>
  <td style="vertical-align:middle"><b><a href="#" class="btn disabled" style="cursor:"not-allowed",margin:0px;background:darkred;color:white">&nbsp;<span class="title1"><b>Done</a></b></td></tr>';
                }
            }
        }
        echo '</font></ul></div>';
    }

    ?>
    <?php

    if (@$_GET['q'] == 'quiz' && @$_GET['step'] == 2 && isset($_SESSION['6e447159425d2d']) && $_SESSION['6e447159425d2d'] == "6e447159425d2d" && isset($_GET['endquiz']) == 'end') {
        unset($_SESSION['6e447159425d2d']);
        $eid = $_GET['eid'];
        $q = mysqli_query($con, "UPDATE history SET status='finished' WHERE username='$_SESSION[username]' AND eid='$eid' ") or die('Error197');
        $q = mysqli_query($con, "SELECT * FROM history WHERE eid='$_GET[eid]' AND username='$_SESSION[username]'") or die('Error156');
        while ($row = mysqli_fetch_array($q)) {
            $s = $row['score'];
            $scorestatus = $row['score_updated'];
        }
        if ($scorestatus == "false") {
            $q = mysqli_query($con, "UPDATE history SET score_updated='true' WHERE username='$_SESSION[username]' AND eid='$_GET[eid]' ") or die('Error197');
            $q = mysqli_query($con, "SELECT * FROM rank WHERE username='$username'") or die('Error161');
            $rowcount = mysqli_num_rows($q);
            if ($rowcount == 0) {
                $q2 = mysqli_query($con, "INSERT INTO rank VALUES(NULL,'$username','$s',NOW())") or die('Error165');
            } else {
                while ($row = mysqli_fetch_array($q)) {
                    $sun = $row['score'];
                }

                $sun = $s + $sun;
                $q = mysqli_query($con, "UPDATE `rank` SET `score`=$sun ,time=NOW() WHERE username= '$username'") or die('Error174');
            }
        }
        header('location:quiz.php?q=result&eid=' . $_GET['eid']);
    }

    if (@$_GET['q'] == 'quiz' && @$_GET['step'] == 2 && isset($_GET['start']) && $_GET['start'] == "start" && (!isset($_SESSION['6e447159425d2d']))) {
        $eid = $_GET['eid'];
        $q = mysqli_query($con, "SELECT * FROM history WHERE username='$username' AND eid='$eid' ") or die('Error197');

        if (mysqli_num_rows($q) > 0) {
            $q = mysqli_query($con, "SELECT * FROM history WHERE username='$_SESSION[username]' AND eid='$eid' ") or die('Error197');
            while ($row = mysqli_fetch_array($q)) {
                $timel  = $row['timestamp'];
                $status = $row['status'];
            }
            $q = mysqli_query($con, "SELECT * FROM quiz WHERE eid='$eid' ") or die('Error197');
            while ($row = mysqli_fetch_array($q)) {
                $ttimel  = $row['time'];
                $qstatus = $row['status'];
            }
            $remaining = (($ttimel * 60) - ((time() - $timel)));
            if ($status == "ongoing" && $remaining > 0 && $qstatus == "enabled") {
                $_SESSION['6e447159425d2d'] = "6e447159425d2d";
                header('location:quiz.php?q=quiz&step=2&eid=' . $eid . '&n=' . $_GET['n'] . '&t=' . $_GET['t']);
            } else {
                $q = mysqli_query($con, "UPDATE history SET status='finished' WHERE username='$_SESSION[username]' AND eid='$eid' ") or die('Error197');
                $q = mysqli_query($con, "SELECT * FROM history WHERE eid='$eid' AND username='$_SESSION[username]'") or die('Error156');
                while ($row = mysqli_fetch_array($q)) {
                    $s = $row['score'];
                    $scorestatus = $row['score_updated'];
                }
                if ($scorestatus == "false") {
                    $q = mysqli_query($con, "UPDATE history SET score_updated='true' WHERE username='$_SESSION[username]' AND eid='$eid' ") or die('Error197');
                    $q = mysqli_query($con, "SELECT * FROM rank WHERE username='$username'") or die('Error161');
                    $rowcount = mysqli_num_rows($q);
                    if ($rowcount == 0) {
                        $q2 = mysqli_query($con, "INSERT INTO rank VALUES(NULL,'$username','$s',NOW())") or die('Error165');
                    } else {
                        while ($row = mysqli_fetch_array($q)) {
                            $sun = $row['score'];
                        }

                        $sun = $s + $sun;
                        $q = mysqli_query($con, "UPDATE `rank` SET `score`=$sun ,time=NOW() WHERE username= '$username'") or die('Error174');
                    }
                }
                header('location:quiz.php?q=result&eid=' . $eid);
            }
        } else {
            $time = time();
            $q = mysqli_query($con, "INSERT INTO history VALUES(NULL,'$username','$eid' ,'0','0','0','0',NOW(),'$time','ongoing','false')") or die('Error137');
            $_SESSION['6e447159425d2d'] = "6e447159425d2d";
            header('location:quiz.php?q=quiz&step=2&eid=' . $eid . '&n=' . $_GET["n"] . '&t=' . $_GET["t"]);
        }
    }


    if (@$_GET['q'] == 'quiz' && @$_GET['step'] == 2 && isset($_SESSION['6e447159425d2d']) && $_SESSION['6e447159425d2d'] == "6e447159425d2d") {
        $eid = $_GET['eid'];
        $q = mysqli_query($con, "SELECT * FROM history WHERE username='$username' AND eid='$eid' ") or die('Error197');

        if (mysqli_num_rows($q) > 0) {
            $q = mysqli_query($con, "SELECT * FROM history WHERE username='$_SESSION[username]' AND eid='$eid' ") or die('Error197');
            while ($row = mysqli_fetch_array($q)) {
                $time   = $row['timestamp'];
                $status = $row['status'];
            }
            $q = mysqli_query($con, "SELECT * FROM quiz WHERE eid='$eid' ") or die('Error197');
            while ($row = mysqli_fetch_array($q)) {
                $ttime   = $row['time'];
                $qstatus = $row['status'];
            }
            $remaining = (($ttime * 60) - ((time() - $time)));
            if ($status == "ongoing" && $remaining > 0 && $qstatus == "enabled") {
                $q = mysqli_query($con, "SELECT * FROM history WHERE username='$_SESSION[username]' AND eid='$eid' ") or die('Error197');
                while ($row = mysqli_fetch_array($q)) {
                    $time = $row['timestamp'];
                }
                $q = mysqli_query($con, "SELECT * FROM quiz WHERE eid='$eid' ") or die('Error197');
                while ($row = mysqli_fetch_array($q)) {
                    $ttime = $row['time'];
                }
                $remaining = (($ttime * 60) - ((time() - $time)));

                echo '<font size="3" style="margin-left:100px;font-family:\'typo\' font-size:20px; font-weight:bold;color:darkred">Time Left : </font><span class="timer btn btn-default" style="margin-left:20px;"><font style="font-family:\'typo\';font-size:20px;font-weight:bold;color:darkblue" id="countdown"></font></span>';
                $eid   = @$_GET['eid'];
                $sn    = @$_GET['n'];
                $total = @$_GET['t'];
                $q     = mysqli_query($con, "SELECT * FROM questions WHERE eid='$eid' AND sn='$sn' ");
                echo '<div class="panel" style="margin-right:5%;margin-left:5%;margin-top:10px;border-radius:10px">';
                while ($row = mysqli_fetch_array($q)) {
                    $qns = stripslashes($row['qns']);
                    $qid = $row['qid'];
                    echo '<b><pre style="background-color:white"><div style="font-size:20px;font-weight:bold;font-family:calibri;margin:10px">' . $sn . ' : ' . $qns . '</div></pre></b>';
                }



                echo '<div class="funkyradio">';
                $studentScore = 0;

                $q = mysqli_query($con, "SELECT * FROM opt WHERE qid='$qid' ");
                while ($row = mysqli_fetch_array($q)) {
                    $opt1   = stripslashes($row['opt1']);
                    $opt2   = stripslashes($row['opt2']);
                    $opt3   = stripslashes($row['opt3']);
                    $opt4   = stripslashes($row['opt4']);
                    $keywords = [$opt1, $opt2, $opt3, $opt4];

                    $stdAnswer = @$_POST['std'];
                    $stdAnsArray = explode(" ", $stdAnswer);
                    $wordsFound = 0;
                    for ($i = 0; $i <= 3; $i++) {
                        if (strpos($stdAnswer, $keywords[$i])) {
                            $wordsFound += 1;
                        }
                    }

                    if ($wordsFound == 2) {
                        $studentScore += 2;
                    } elseif ($wordsFound == 3) {
                        $studentScore += 3;
                    } else {
                        $studentScore += 5;
                    }
                }

                echo '<form id="qform" action="test.php?q=quiz&step=2&eid=' . $eid . '&n=' . $sn . '&t=' . $total . '&qid=' . $qid . '&ans=' . $studentScore . '&endquiz=end' . '" method="POST"  class="form-horizontal">
<br />';
                echo '<input type="text" class="form-control" id="stdVal" name="std" style="border-width:5px;border-radius:3px" required>';

                echo '</div>';

                echo '<script>
var seconds = ' . $remaining . ' ;
function enable(){
  document.getElementById("sbutton").removeAttribute("disabled");

}
function end(){
  data = prompt("Are you sure to end this Quiz? Remember, once finished, you wont be able to continue anymore and final results will be displayed. If you want to continue then enter \\"yes\\" in the textbox below and press enter");
  if(data=="yes"){
    window.location ="dash.php?q=quiz&step=2&eid=' . $_GET["eid"] . '&n=' . $_GET["n"] . '&t=' . isset($_GET["total"]) . '&endquiz=end";
  }
}

    function secondPassed() {
    var minutes = Math.round((seconds - 30)/60);
    var remainingSeconds = seconds % 60;
    if (remainingSeconds < 10) {
        remainingSeconds = "0" + remainingSeconds; 
    }
    document.getElementById(\'countdown\').innerHTML = minutes + ":" +    remainingSeconds;
    if (seconds <= 0) {
        clearInterval(countdownTimer);
        document.getElementById(\'countdown\').innerHTML = "Buzz Buzz...";
        window.location ="test.php?q=quiz&step=2&eid=' . $eid . '&n=' . $sn . '&t=' . $total . '&qid=' . $qid . '&ans=' . $studentScore . '"
    } else {    
        seconds--;
    }
    }
var countdownTimer = setInterval(\'secondPassed()\', 1000);
</script>';
                if ($_GET["t"] > $_GET["n"] && $_GET["n"] != 1) {
                    echo '<br />
                    <a href="quiz.php?q=quiz&step=2&eid=' . $eid . '&n=' . ($sn - 1) . '&t=' . $total . '" class="btn btn-primary" style="height:30px"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"  style="font-size:12px"></span></a>
                    &nbsp;&nbsp;&nbsp;&nbsp;<a href="quiz.php?q=quiz&step=2&eid=' . $eid . '&n=' . ($sn + 1) . '&t=' . $total . '" class="btn btn-primary" style="height:30px"><span class="glyphicon glyphicon-arrow-right" aria-hidden="true"  style="font-size:12px">
                    </span>
                    </a>
                    
                    
                    </form><br><br>';
                } else if ($_GET["t"] == $_GET["n"]) {
                    echo '<br/><button name="submit" class="btn-success">Submit </button>';
                } else if ($_GET["t"] > $_GET["n"] && $_GET["n"] == 1) {
                    echo '<br /><a href="quiz.php?q=quiz&step=2&eid=' . $eid . '&n=' . ($sn - 1) . '&t=' . $total . '&ans=' . $studentScore .  '" class="btn btn-primary" style="height:30px"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"  style="font-size:12px"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;</form>';

                    echo '&nbsp;&nbsp;&nbsp;&nbsp;<a href="quiz.php?q=quiz&step=2&eid=' . $eid . '&n=' . ($sn + 1) . '&t=' . $total . '&ans=' . $studentScore .  '" class="btn btn-primary" style="height:30px"><span class="glyphicon glyphicon-arrow-right" aria-hidden="true"  style="font-size:12px"></span></a></form><br><br>';
                } else {
                }
                echo '</div>';
                echo '<div class="panel" style="text-align:center">';
                $q = mysqli_query($con, "SELECT * FROM questions WHERE eid='$_GET[eid]'") or die("Error222");
                $i = 1;
                while ($row = mysqli_fetch_array($q)) {
                    $ques[$row['qid']] = $i;
                    $i++;
                }
                $q = mysqli_query($con, "SELECT * FROM user_answer WHERE eid='$_GET[eid]' AND username='$_SESSION[username]'") or die("Error222a");
                $i = 1;
                while ($row = mysqli_fetch_array($q)) {
                    if (isset($ques[$row['qid']])) {
                        $quesans[$ques[$row['qid']]] = true;
                    }
                }
            } else {
                unset($_SESSION['6e447159425d2d']);
                $q = mysqli_query($con, "UPDATE history SET status='finished' WHERE username='$_SESSION[username]' AND eid='$_GET[eid]' ") or die('Error197');
                $q = mysqli_query($con, "SELECT * FROM history WHERE eid='$_GET[eid]' AND username='$_SESSION[username]'") or die('Error156');
                while ($row = mysqli_fetch_array($q)) {
                    $s = $row['score'];
                    $scorestatus = $row['score_updated'];
                }
                if ($scorestatus == "false") {
                    $q = mysqli_query($con, "UPDATE history SET score_updated='true' WHERE username='$_SESSION[username]' AND eid='$_GET[eid]' ") or die('Error197');
                    $q = mysqli_query($con, "SELECT * FROM rank WHERE username='$username'") or die('Error161');
                    $rowcount = mysqli_num_rows($q);
                    if ($rowcount == 0) {
                        $q2 = mysqli_query($con, "INSERT INTO rank VALUES(NULL,'$username','$s',NOW())") or die('Error165');
                    } else {
                        while ($row = mysqli_fetch_array($q)) {
                            $sun = $row['score'];
                        }

                        $sun = $s + $sun;
                        $q = mysqli_query($con, "UPDATE `rank` SET `score`=$sun ,time=NOW() WHERE username= '$username'") or die('Error174');
                    }
                }
            }
        }
    }

    if (@$_GET['q'] == 2) {
        $q = mysqli_query($con, "SELECT * FROM history WHERE username='$username' AND status='finished' ORDER BY date DESC ") or die('Error197');
        echo '<div class="panel title">
<table class="table table-striped title1" >
<tr><td style="vertical-align:middle"><b>S.N.</b></td><td style="vertical-align:middle"><b>Quiz</b></td><td style="vertical-align:middle"><b>Total Questions</b></td><td style="vertical-align:middle"><b>Right</b></td><td style="vertical-align:middle"><b>Wrong<b></td><td style="vertical-align:middle"><b>Unattempted<b></td><td style="vertical-align:middle"><b>Score</b></td><td style="vertical-align:middle"><b>Action<b></td></tr>';
        $c = 0;
        while ($row = mysqli_fetch_array($q)) {
            $eid = $row['eid'];
            $s   = $row['score'];
            $w   = $row['wrong'];
            $r   = $row['correct'];
            $q23 = mysqli_query($con, "SELECT * FROM quiz WHERE  eid='$eid' ") or die('Error208');
            while ($row = mysqli_fetch_array($q23)) {
                $title = $row['title'];
                $total = $row['total'];
            }
            $c++;
            echo '<tr><td style="vertical-align:middle">' . $c . '</td><td style="vertical-align:middle">' . $title . '</td><td style="vertical-align:middle">' . $total . '</td><td style="vertical-align:middle">' . $r . '</td><td style="vertical-align:middle">' . $w . '</td><td style="vertical-align:middle">' . ($total - $r - $w) . '</td><td style="vertical-align:middle">' . $s . '</td><td style="vertical-align:middle"><b><a href="quiz.php?q=result&eid=' . $eid . '" class="btn" style="margin:0px;background:darkred;color:white">&nbsp;<span class="title1"><b>View Result</b></td></tr>';
        }
        echo '</table></div>';
    }
    if (@$_GET['q'] == 3) {
        if (isset($_GET['show'])) {
            $show = $_GET['show'];
            $showfrom = (($show - 1) * 10) + 1;
            $showtill = $showfrom + 9;
        } else {
            $show = 1;
            $showfrom = 1;
            $showtill = 10;
        }
        $q = mysqli_query($con, "SELECT * FROM rank") or die('Error223');
        echo '<div class="panel title">
<table class="table table-striped title1" >
<tr><td style="vertical-align:middle"><b>Rank</b></td><td style="vertical-align:middle"><b>Name</b></td><td style="vertical-align:middle"><b>Branch</b></td><td style="vertical-align:middle"><b>Username</b></td><td style="vertical-align:middle"><b>Score</b></td></tr>';
        $c = $showfrom - 1;
        $total = mysqli_num_rows($q);
        if ($total >= $showfrom) {
            $q = mysqli_query($con, "SELECT * FROM rank ORDER BY score DESC, time ASC LIMIT " . ($showfrom - 1) . ",10") or die('Error223');
            while ($row = mysqli_fetch_array($q)) {
                $e = $row['username'];
                $s = $row['score'];
                $q12 = mysqli_query($con, "SELECT * FROM user WHERE username='$e' ") or die('Error231');
                while ($row = mysqli_fetch_array($q12)) {
                    $name     = $row['name'];
                    $branch   = $row['branch'];
                    $username = $row['username'];
                }
                $c++;
                echo '<tr><td style="color:#99cc32"><b>' . $c . '</b></td><td style="vertical-align:middle">' . $name . '</td><td style="vertical-align:middle">' . $branch . '</td><td style="vertical-align:middle">' . $username . '</td><td style="vertical-align:middle">' . $s . '</td><td style="vertical-align:middle">';
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
                echo '<td style="vertical-align:middle;text-align:center"><a style="font-size:14px;font-family:typo;font-weight:bold" href="quiz.php?q=3&show=' . $i . '">&nbsp;' . $i . '&nbsp;</a></td>';
                $i++;
            }
            echo '<td style="vertical-align:middle;text-align:center"><a style="font-size:14px;font-family:typo;font-weight:bold" href="quiz.php?q=3&show=' . ($show + 1) . '">&nbsp;>>&nbsp;</a></td>';
        } else if ($show != 1 && $show == $total) {
            echo '<td style="vertical-align:middle;text-align:center"><a style="font-size:14px;font-family:typo;font-weight:bold" href="quiz.php?q=3&show=' . ($show - 1) . '">&nbsp;<<&nbsp;</a></td>';

            $i = 1;
            while ($i <= $total) {
                echo '<td style="vertical-align:middle;text-align:center"><a style="font-size:14px;font-family:typo;font-weight:bold" href="quiz.php?q=3&show=' . $i . '">&nbsp;' . $i . '&nbsp;</a></td>';
                $i++;
            }
        } else {
            echo '<td style="vertical-align:middle;text-align:center"><a style="font-size:14px;font-family:typo;font-weight:bold" href="quiz.php?q=3&show=' . ($show - 1) . '">&nbsp;<<&nbsp;</a></td>';
            $i = 1;
            while ($i <= $total) {
                echo '<td style="vertical-align:middle;text-align:center"><a style="font-size:14px;font-family:typo;font-weight:bold" href="quiz.php?q=3&show=' . $i . '">&nbsp;' . $i . '&nbsp;</a></td>';
                $i++;
            }
            echo '<td style="vertical-align:middle;text-align:center"><a style="font-size:14px;font-family:typo;font-weight:bold" href="quiz.php?q=3&show=' . ($show + 1) . '">&nbsp;>>&nbsp;</a></td>';
        }
        echo '</tr></table></div>';
    }
    ?>
</div>
</div>
</div>
</div>