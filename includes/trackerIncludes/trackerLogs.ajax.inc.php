<?php
  //safety checks
  if (isset($_POST['exerciseName'])) {

    $exerciseName = $_POST['exerciseName'];

    session_start();
    if (isset($_SESSION['usersId'])) {
      $usersId = $_SESSION['usersId'];
    } elseif (isset($_SESSION['cookieId'])) {
      $usersId = $_SESSION['cookieId'];
    }

    if (!preg_match("/^[a-zA-Z 0-9]*$/", $exerciseName)) {
      echo "<p class='noCurrentLogMessage'>Invalid exercise name!</p>";
      exit ();
    }

    require '../dbh.inc.php';
  }
?>

<div class="radioSelectorWrapper">
  <label>
    <input type="radio" name="previeOption" value="lifting" checked="checked"><p>Log a Lift</p>
  </label>
  <label class="lable2">
    <input type="radio" name="previeOption" value="cardio"><p>Log Cardio</p>
  </label>
</div>
<!--If the exercise is lifting-->
<div id="wrapperlifting" class="formWrapperHide">
  <div class="inputFormContainer">
    <input id="logWeight" class="threeRowInInput" type="number" placeholder="Weight">
    <select id="logUnit" class="threeRowInInput">
      <option value="kg">kg</option>
      <option value="lbs">lbs</option>
    </select>
    <input id="logDate" type="date" class="threeRowInInput" placeholder="Date">
    <input id="logSets" type="number" placeholder="Sets">
    <input id="logReps" type="number" placeholder="Reps">
    <input id="logExerciseType" value="lift" style="display: none;">
    <input id="logExerciseName" value="<?php echo $exerciseName; ?>" style="display: none;">
  </div>
  <button id="addLogAjaxBtn" class="saveLogBtn">Add Log</button>
</div>
<!--If the exercise is cardio-->
<div id="wrappercardio" class="formWrapperHide">
  <div class="inputFormContainer cardioForm">
    <input id="logCardioDistance" type="text" placeholder="Distance">
    <input id="logCardioDuration" type="text" placeholder="Duration">
    <input id="logCardioDate" type="date" placeholder="Date">
    <input id="logCardioExerciseType" value="cardio" style="display: none;">
    <input id="logCardioExerciseName" value="<?php echo $exerciseName; ?>" style="display: none;">
  </div>
  <button id="addCardioLogAjaxBtn" class="saveLogBtn">Add Log</button>
</div>

<div id="logResultsContainer" class="logResultsContainer">
  <?php

  $sql = "SELECT * FROM ft_users_tracker_logs WHERE usersId='$usersId' AND exerciseName='$exerciseName' ORDER BY exerciseDate DESC LIMIT 6;";
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
        echo "<button class='saveLogBtn loadMoreBtn' id='loadLog'>Load More</button>";

        echo "<script>
                $(document).ready(function() {
                  var logCount = 6;
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


  ?>
</div>

<script>
//Hides tab when not focused
$(document).ready(function() {
    $("input[name$='previeOption']").click(function() {
        var test = $(this).val();

        $("div.formWrapperHide").hide();
        $("#wrapper" + test).show();
    });
});

//Lift Ajax
$(document).ready(function() {
  $("#addLogAjaxBtn").click(function() {
    var logWeight = $("#logWeight").val();
    var logUnit = $("select#logUnit option:checked").val();
    var logDate = $("#logDate").val();
    var logSets = $("#logSets").val();
    var logReps = $("#logReps").val();
    var logExerciseType = $("#logExerciseType").val();
    var logExerciseName = $("#logExerciseName").val();
    $("#logResultsContainer").load("/includes/trackerIncludes/trackerLogLift.ajax.inc.php", {
      weight: logWeight,
      unit: logUnit,
      date: logDate,
      sets: logSets,
      reps: logReps,
      type: logExerciseType,
      name: logExerciseName
    });
  });
});

//Cardio Ajax
$(document).ready(function() {
  $("#addCardioLogAjaxBtn").click(function() {
    var logCardioDistance = $("#logCardioDistance").val();
    var logCardioDuration = $("#logCardioDuration").val();
    var logCardioDate = $("#logCardioDate").val();
    var logCardioExerciseType = $("#logCardioExerciseType").val();
    var logCardioExerciseName = $("#logCardioExerciseName").val();
    $("#logResultsContainer").load("/includes/trackerIncludes/trackerLogCardio.ajax.inc.php", {
      distance: logCardioDistance,
      duration: logCardioDuration,
      date: logCardioDate,
      type: logCardioExerciseType,
      name: logCardioExerciseName
    });
  });
});

</script>
