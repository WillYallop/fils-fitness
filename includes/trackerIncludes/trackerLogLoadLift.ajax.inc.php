<?php

if (isset($_POST['logCount'])) {
  session_start();

  $logResultNumber = $_POST['logCount'];
  $exerciseName = $_POST['exerciseName'];

  if (!preg_match("/^[0-9]*$/", $logResultNumber)) {
    echo "<p class='noCurrentLogMessage'>error</p>";
    exit ();
  }
  if (!preg_match("/^[a-zA-Z0-9 ]*$/", $exerciseName)) {
    echo "<p class='noCurrentLogMessage'>error</p>";
    exit ();
  }

  if (isset($_SESSION['usersId'])) {
    $usersId = $_SESSION['usersId'];
  } elseif (isset($_SESSION['cookieId'])) {
    $usersId = $_SESSION['cookieId'];
  }

  require '../dbh.inc.php';

  //Echo results into Ajax results div
  $sql = "SELECT * FROM ft_users_tracker_logs WHERE usersId='$usersId' AND exerciseName='$exerciseName' ORDER BY exerciseDate DESC LIMIT $logResultNumber;";
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

      $sql = "SELECT * FROM ft_users_tracker_logs WHERE usersId='$usersId' AND exerciseName='$exerciseName';";
      $result2 = $conn->query($sql);

      $showLoadMore= mysqli_num_rows($result2);
      if ($showLoadMore > 6) {

        if ($showLoadMore < $logResultNumber) {
          echo "<div class='loadBtnCon'>
                  <button id='noloadLog' class='saveLogBtn loadMoreBtn'>No More</button>
                </div>";
        } else {
          echo "<div class='loadBtnCon'>
                  <button id='loadLog' class='saveLogBtn loadMoreBtn'>Load More</button>
                </div>";

          $newLogResultNumber = $logResultNumber + 2;

          echo "<script>
                  $(document).ready(function() {
                    var logCount = ".$newLogResultNumber.";
                    $('#loadLog').click(function() {
                       logCount = logCount + 2;
                       var exerciseName = '".$exerciseName."';
                      $('#logResultsContainer').load('/includes/trackerIncludes/trackerLogLoadLift.ajax.inc.php', {
                        logCount: logCount,
                        exerciseName: exerciseName
                      });
                    });
                  });
                </script>";
        }
      }

    }

}
