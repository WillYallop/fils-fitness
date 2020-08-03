<?php

if (isset($_POST['distance'])) {
  session_start();
  $distance = $_POST['distance'];
  $duration = $_POST['duration'];
  $date = $_POST['date'];
  $type = $_POST['type'];
  $name = $_POST['name'];

  //Do security Checks
  if (empty($distance) || empty($duration) || empty($date) || empty($type) || empty($name)){
    echo "<p class='noCurrentLogMessage'>Make sure to fill in all of the fields!</p>";
    exit ();
  }
  if (!preg_match("/^[a-zA-Z0-9 ]*$/", $distance)) {
    echo "<p class='noCurrentLogMessage'>Distance must only be letters and numbers!</p>";
    exit ();
  }
  if (!preg_match("/^[a-zA-Z0-9 ]*$/", $duration)) {
    echo "<p class='noCurrentLogMessage'>Distance must only be letters and numbers!</p>";
    exit ();
  }
  if (!preg_match("/^[0-9 -]*$/", $date)) {
    echo "<p class='noCurrentLogMessage'>That date is not valid!</p>";
    exit ();
  }
  if (!preg_match("/^[a-z]*$/", $type)) {
    echo "<p class='noCurrentLogMessage'>Error</p>";
    exit ();
  }
  if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
    echo "<p class='noCurrentLogMessage'>Invalid exercise name!</p>";
    exit ();
  }

  //Do main action
  if (isset($_SESSION['usersId'])) {
    $usersId = $_SESSION['usersId'];
  } elseif (isset($_SESSION['cookieId'])) {
    $usersId = $_SESSION['cookieId'];
  }

  require '../dbh.inc.php';

  //Checks if the user has the exercise set in their plan
  $sql = "SELECT * FROM ft_users_tracker_logs WHERE usersId='$usersId' AND exerciseName='$name';";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();

  if ($row['exerciseType'] == null) {
    if (!isset($row['exerciseType'])) {
      $sql = "INSERT INTO ft_users_tracker_logs (usersId ,exerciseName ,exerciseType ,exerciseReps ,exerciseSets ,exerciseWeight ,exerciseUnit ,exerciseDistance ,exerciseDuration ,exerciseDate) VALUES ('$usersId','$name','$type',NULL,NULL,NULL,NULL,'$distance','$duration','$date')";
      mysqli_query($conn, $sql);
    } else {
      $sql ="UPDATE ft_users_tracker_logs SET exerciseType='$type', exerciseReps=NULL, exerciseSets=NULL, exerciseWeight=NULL, exerciseUnit=NULL, exerciseDistance='$distance', exerciseDuration='$duration', exerciseDate='$date' WHERE usersId='$usersId' AND exerciseName='$name'";
      mysqli_query($conn, $sql);
    }
  } else {
    $sql = "INSERT INTO ft_users_tracker_logs (usersId ,exerciseName ,exerciseType ,exerciseReps ,exerciseSets ,exerciseWeight ,exerciseUnit ,exerciseDistance ,exerciseDuration ,exerciseDate) VALUES ('$usersId','$name','$type',NULL,NULL,NULL,NULL,'$distance','$duration','$date')";
    mysqli_query($conn, $sql);
  }

  //Echo results into Ajax results div
  $sql = "SELECT * FROM ft_users_tracker_logs WHERE usersId='$usersId' AND exerciseName='$name' ORDER BY exerciseDate DESC LIMIT 6;";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo "SQL statement failed!";
  } else {
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);

      while ($row = mysqli_fetch_assoc($result)) {

        if ($row['exerciseType'] == 'lift') {
          echo '<div class="logResult">
                  <div class="logResultHeader">
                    <p>'.$row['exerciseName'].' - '.$row['exerciseDate'].'</p>
                    <input id="delete'.$row['id'].'" value="'.$row['id'].'" style="display:none;">
                    <input id="delete'.$row['id'],$row['id'].'" value="'.$row['exerciseName'].'" style="display:none;">
                    <button id="deleteLogBtn'.$row['id'].'"><i class="material-icons">delete</i></button>
                  </div>
                  <p>You lifted '.$row['exerciseWeight'],$row['exerciseUnit'].'</p>
                  <p>For '.$row['exerciseSets'].' Sets of '.$row['exerciseReps'].'</p>
                </div>';

          echo "<script>
                  $(document).ready(function() {
                  $('#deleteLogBtn".$row['id']."').click(function() {
                      var deleteExerciseId = $('#delete".$row['id']."').val();
                      var deleteExerciseName = $('#delete".$row['id'],$row['id']."').val();
                      $('#logResultsContainer').load('/includes/trackerIncludes/trackerLogLiftDelete.ajax.inc.php', {
                        deleteExerciseId: deleteExerciseId,
                        deleteExerciseName: deleteExerciseName
                      });
                    });
                  });
              </script>";
        } elseif ($row['exerciseType'] == 'cardio') {
          echo '<div class="logResult">
                  <div class="logResultHeader">
                    <p>'.$row['exerciseName'].' - '.$row['exerciseDate'].'</p>
                    <input id="delete'.$row['id'].'" value="'.$row['id'].'" style="display:none;">
                    <input id="delete'.$row['id'],$row['id'].'" value="'.$row['exerciseName'].'" style="display:none;">
                    <button id="deleteLogBtn'.$row['id'].'"><i class="material-icons">delete</i></button>
                  </div>
                  <p>You ran '.$row['exerciseDistance'].'</p>
                  <p>In '.$row['exerciseDuration'].'</p>
                </div>';

          echo "<script>
                  $(document).ready(function() {
                  $('#deleteLogBtn".$row['id']."').click(function() {
                      var deleteExerciseId = $('#delete".$row['id']."').val();
                      var deleteExerciseName = $('#delete".$row['id'],$row['id']."').val();
                      $('#logResultsContainer').load('/includes/trackerIncludes/trackerLogLiftDelete.ajax.inc.php', {
                        deleteExerciseId: deleteExerciseId,
                        deleteExerciseName: deleteExerciseName
                      });
                    });
                  });
              </script>";
        }

      }
      $sql = "SELECT * FROM ft_users_tracker_logs WHERE usersId='$usersId' AND exerciseName='$name';";
      $result2 = $conn->query($sql);

      $showLoadMore= mysqli_num_rows($result2);
      if ($showLoadMore > 6) {
        echo "<button class='saveLogBtn loadMoreBtn' id='loadLog'>Load More</button>";

        echo "<script>
                $(document).ready(function() {
                  var logCount = 6;
                  $('#loadLog').click(function() {
                     logCount = logCount + 2;
                     var exerciseName = '".$name."';
                    $('#logResultsContainer').load('/includes/trackerIncludes/trackerLogLoadLift.ajax.inc.php', {
                      logCount: logCount,
                      exerciseName: exerciseName
                    });
                  });
                });
              </script>";
      }
    }



} else {
  header("Location: index");
  exit ();
}
