<?php
if (isset($_POST['exerciseday'])) {

  session_start();
  //Asigns $usersId and if they have no session quit!
  if (isset($_SESSION['usersId'])) {
    $usersId = $_SESSION['usersId'];
  } elseif (isset($_SESSION['cookieId'])) {
    $usersId = $_SESSION['cookieId'];
  } else {
    echo "You have to login to create your workout plan!";
    exit ();
  }

  //Sets variables from AJAX Post
  $exerciseDay = $_POST['exerciseday'];
  $exerciseName = $_POST['exerciseName'];
  $exerciseSets = $_POST['exerciseSets'];
  $exerciseReps = $_POST['exerciseReps'];

  if (empty($exerciseDay) || empty($exerciseName)) {
    echo "<p>Make sure to fill in all of the fields!</p>";
    exit ();
  }
  //Add safety here once done!
  if (!preg_match("/^[a-zA-Z]*$/", $exerciseDay)) {
    echo "<p>Thats not a valid day!</p>";
    exit ();
  }
  if (!preg_match("/^[a-zA-Z 0-9]*$/", $exerciseName)) {
    echo "<p>The exercise name can only contain letters!</p>";
    exit ();
  }
  if (!preg_match("/^[0-9]*$/", $exerciseSets)) {
    echo "<p>Sets has to be a number!</p>";
    exit ();
  }
  //Add safety here once done!
  if (!preg_match("/^[0-9]*$/", $exerciseReps)) {
    echo "<p>Reps has to be a number!</p>";
    exit ();
  }

  if (empty($_POST['exerciseSets'])) {
    $exerciseSets = 'NULL';
  }
  if (empty($_POST['exerciseReps'])) {
    $exerciseReps = 'NULL';
  }

  if ($exerciseDay != 'monday') {
    if ($exerciseDay != 'tuesday') {
      if ($exerciseDay != 'wednesday') {
        if ($exerciseDay != 'thursday') {
          if ($exerciseDay != 'friday') {
            if ($exerciseDay != 'saturday') {
              if ($exerciseDay != 'sunday') {
                echo "<p>Thats not a valid day!</p>";
                exit ();
              }
            }
          }
        }
      }
    }
  }

  //Main
  require 'dbh.inc.php';

  $sql = "SELECT exerciseDay FROM ft_users_exercise_plan WHERE usersId='$usersId' AND exerciseDay='$exerciseDay';";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();

  $limitUpload = mysqli_num_rows($result);
  if ($limitUpload <= 24) {
    $sql = "INSERT INTO ft_users_exercise_plan (usersId ,exerciseDay ,exerciseName ,exerciseSets ,exerciseReps) VALUES ('$usersId','$exerciseDay','$exerciseName',$exerciseSets,$exerciseReps)";
    mysqli_query($conn, $sql);
  }


  $sql = "SELECT * FROM ft_users_exercise_plan WHERE usersId='$usersId' AND exerciseDay='$exerciseDay';";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo "SQL statement failed!";
  } else {
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);

      $upperCaseDay = ucfirst($exerciseDay);

      $showTitle = mysqli_num_rows($result);
      if ($showTitle > 0) {
        echo "<h3>Here is you workout plan for ".$upperCaseDay.":</h3>";
      }

      while ($row = mysqli_fetch_assoc($result)) {

        if ($row['exerciseReps'] == NULL || $row['exerciseSets'] == NULL) {
          $hideWrapperClass = 'hideWrapperClass';
        } else {
            $hideWrapperClass = NULL;
        }

        echo "<div class='exerciseWrapper'>";
        echo "<div class='exerciseWrapperHeader'>";
        echo "<h4>".$row['exerciseName']."</h4>";
        echo "<input id='deleteExerciseDay".$row['exerciseDay']."' name='deleteExerciseDay' value=".$row['exerciseDay']." style='display:none;'>";
        echo "<input id='deleteExerciseId".$row['id']."' name='deleteExerciseId' value=".$row['id']." style='display:none;'>";
        echo "<a href='tracker?exercise=".$row['exerciseName']."'><button class='trackExerciseBtn'><i class='material-icons'>storage</i></button></a>";
        echo "<button id='btn-".$row['id']."'><i class='material-icons'>delete</i></button>";
        echo "</div>";

        echo "<div class='exerciseInputWrapper ".$hideWrapperClass."'>
                <div class='col'>
                  <p>Reps: ".$row['exerciseReps']."</p>
                </div>
                <div class='col'>
                  <p>Sets: ".$row['exerciseSets']."</p>
                </div>
              </div>";

        echo "</div>";

        echo "<script>
                $(document).ready(function() {
                  $('#btn-".$row['id']."').click(function() {
                    var deleteExerciseDay = $('#deleteExerciseDay".$row['exerciseDay']."').val();
                    var deleteExerciseId = $('#deleteExerciseId".$row['id']."').val();

                    $('#".$row['exerciseDay']."Dropdown').load('/includes/planDeleteExercise.ajax.inc.php', {
                      deleteExerciseDay: deleteExerciseDay,
                      deleteExerciseId: deleteExerciseId

                    });
                  });
                });
            </script>";
      }

      $sql = "SELECT SUM(exerciseSets) AS setsSum FROM ft_users_exercise_plan WHERE usersId='$usersId' AND exerciseDay='$exerciseDay';";
      $result = $conn->query($sql);
      $row = $result->fetch_assoc();

      $sql2 = "SELECT * FROM ft_users_exercise_plan WHERE usersId='$usersId' AND exerciseDay='$exerciseDay';";
      $result2 = $conn->query($sql2);
      $row2 = $result2->fetch_assoc();

      $numRows = mysqli_num_rows($result2);
      $sum = $row['setsSum'];

      if ($numRows > 0) {
        $bodybuildingMultiplyer = 3;
        $powerliftingMultiplyer = 4;

        $bodybuildingResult = $bodybuildingMultiplyer * $sum;
        $powerliftingResult = $powerliftingMultiplyer * $sum;

        echo "<div class='workoutTimeContainer'>";
        echo "<div class='col colImage1'>
                <div class='col-overlay1'>
                  <h4>Hypertrophy</h4>
                  <p>".$bodybuildingResult."m workout</p>
                  <p>2-3m rest periods</p>
                </div>
              </div>";
        echo "<div class='col colImage2'>
                <div class='col-overlay2'>
                  <h4>Strength</h4>
                  <p>".$powerliftingResult."m workout</p>
                  <p>3-5m rest periods</p>
                </div>
              </div>";
        echo "</div>";
      }
    }




} else {
  header("Location: ../index");
  exit ();
}
