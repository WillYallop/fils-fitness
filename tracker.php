<!DOCTYPE html>
<html>
  <head>
    <title>Fitness Tracker | Tracker</title>
    <link rel='stylesheet' href='/assets/css/tracker.style.css'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  <?php include("header.php") ?>

  <!-- Above the fold Inlined CSS -->

  <?php
    if (!isset($_GET['exercise'])) {
      header("Location: exercise");
      exit ();
    } else {
      //Sets the userid variable
      if (isset($_SESSION['usersId'])) {
        $usersId = $_SESSION['usersId'];
      } elseif (isset($_SESSION['cookieId'])) {
        $usersId = $_SESSION['cookieId'];
      }

      $exerciseName = $_GET['exercise'];

      require 'includes/dbh.inc.php';

      //Checks if the user has the exercise set in their plan
      $sql = "SELECT * FROM ft_users_exercise_plan WHERE usersId='$usersId' AND exerciseName='$exerciseName'";
      $result = $conn->query($sql);
      $row = $result->fetch_assoc();

      if (!empty($row['exerciseName'])) {

        //Checks if the user has the exercise set in their logs table already
        $sql = "SELECT * FROM ft_users_tracker_logs WHERE usersId='$usersId' AND exerciseName='$exerciseName'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();

        if (empty($row['exerciseName'])) {
          $sql = "INSERT INTO ft_users_tracker_logs (usersId ,exerciseName ,exerciseType ,exerciseReps ,exerciseSets ,exerciseWeight ,exerciseUnit ,exerciseDistance ,exerciseDuration ,exerciseDate) VALUES ('$usersId','$exerciseName',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL)";
          mysqli_query($conn, $sql);
        }

      } else {
        header("Location: exercise");
        exit ();
      }
    }
  ?>

  <div id="togglePage" class="universalPageContainer">

    <div class="exerciseTrackerContentContainer">

      <div class="pageToggleBtnContainer">
        <div class="pageToggleBtnWrapper">
          <div id="logsAjaxBtn" class="toggleBtnCol leftToggleBtn active">
            <p>LOGS</p>
          </div>
          <div id="notesAjaxBtn" class="toggleBtnCol">
            <p>NOTES</p>
          </div>
          <div id="graphAjaxBtn" class="toggleBtnCol rightToggleBtn">
            <p>GRAPH</p>
          </div>
        </div>
      </div>

      <div class="exerciseTrackerContentWrapper">
        <div class="headerArea">
          <h1><?php echo $exerciseName; ?></h1>
          <input id="exerciseName" value="<?php echo $exerciseName; ?>" style="display: none;">
        </div>
        <div id="trackerContent">
          <?php include("includes/trackerIncludes/trackerLogs.ajax.inc.php") ?>
        </div>
      </div>

    </div>

  </div>

  <?php include("footer.php") ?>

  <script>
  //Logs Ajax
    $(document).ready(function() {
      $("#logsAjaxBtn").click(function() {
        var exerciseName = $("#exerciseName").val();
        $("#trackerContent").load("/includes/trackerIncludes/trackerLogs.ajax.inc.php", {
          exerciseName: exerciseName
        });
      });
    });
  //Notes Ajax
    $(document).ready(function() {
      $("#notesAjaxBtn").click(function() {
        var exerciseName = $("#exerciseName").val();
        $("#trackerContent").load("/includes/trackerIncludes/trackerNotes.ajax.inc.php", {
          exerciseName: exerciseName
        });
      });
    });
  //Graph Ajax
    $(document).ready(function() {
      $("#graphAjaxBtn").click(function() {
        var exerciseName = $("#exerciseName").val();
        $("#trackerContent").load("/includes/trackerIncludes/trackerGraph.ajax.inc.php", {
          exerciseName: exerciseName
        });
      });
      });
  //Toggle Ajax Tabs active function
  $(function() {
   $(".toggleBtnCol").click(function() {
      // remove classes from all
      $(".toggleBtnCol").removeClass("active");
      // add class to the one we clicked
      $(this).addClass("active");
   });
  });

  </script>
