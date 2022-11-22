<?php
session_start();
include "../temp/header.php";
?>

<div class="main-panel">
  <div class="content-wrapper">
    <!-- Page Title Header Starts-->
    <div>
      <h3>INSTRUCTIONS</h3>


      You are allowed to start the test whenever you want to. The timer would start only when you start the test. However remember that admin has full rights to disable the test at any time. So it is recommended to start the test at the prescribed time.
      <ul>
        <li>
          You cannot see the scores of the test you have taken.
        </li>
        <li>
          To start the test, click on 'Start'.
        </li>
        <li>
          Once the test is started the timer would run irrespective of your logged in or logged our status. So it is recommended not to logout before test completion.
        </li>
        <li>
          To mark an answer you need to select it and press next button. Upon locking, the selected answer would be displayed and the question will be marked "green"
        </li>
        <li>
          Use the navigation buttons to navigate through different questions.
        </li>
        <li>
          The marks for correct and incorrect answer are listed above in the table. 0 marks would be awarded for the questions that are "not marked".
        </li>
      </ul>

    </div>

  </div>

  <?php
  include "../temp/footer.php";
  ?>