<!DOCTYPE html>
<?php session_start(); ?>
<html>
  <head>
    <title>Fitness Tracker | Plan</title>
    <link rel='stylesheet' href='/assets/css/plan.style.css'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  <?php include("header.php") ?>

  <!-- Above the fold Inlined CSS -->

  <div id="togglePage" class="universalPageContainer">
    <div class="planDayContainer">
      <div class="scrollToTopDiv" id="mondayScrollTop"></div>
      <div class="planDayWrapper">
        <h3>Monday</h3>
        <div class="planDayForm">
          <input id="mondayPlan" style="display:none;" type="text" value="monday">
          <input id="mondayExercise" class="largeInput" type="text" name="mondayExerciseName" value="" placeholder="Exercise Name">
          <input id="mondayReps" class="smallInput" type="number" name="mondayReps" value="" placeholder="Reps">
          <input id="mondaySets" class="smallInput" type="number" name="mondaySets" value="" placeholder="Sets">
          <button id="mondayAjax">Add Exercise</button>
        </div>
        <div class="planDayDropdownContainer">
          <div class="planDayDropdownButtonWrapper">
            <button id="mondayDropdownBtn" onclick="mondayToggle()"><i id="mondayToggle" class="material-icons mondayDropdownBtn">arrow_drop_down</i></button>
          </div>
          <div id="mondayDropdown" class="planDayDropdownContent mondayDropdown">
            <?php

            if (isset($_SESSION['usersId'])) {
              $usersId = $_SESSION['usersId'];
            } elseif (isset($_SESSION['cookieId'])) {
              $usersId = $_SESSION['cookieId'];
            } else {
              $usersId = null;
            }

            require 'includes/dbh.inc.php';

            $sql = "SELECT * FROM ft_users_exercise_plan WHERE usersId='$usersId' AND exerciseday='monday';";
            $stmt = mysqli_stmt_init($conn);

            if (!mysqli_stmt_prepare($stmt, $sql)) {
              echo "SQL statement failed!";
            } else {
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                $showTitle = mysqli_num_rows($result);
                if ($showTitle > 0) {
                  echo "<h3>Here is you workout plan for Monday:</h3>";
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

                $sql = "SELECT SUM(exerciseSets) AS setsSum FROM ft_users_exercise_plan WHERE usersId='$usersId' AND exerciseDay='monday';";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();

                $sql2 = "SELECT * FROM ft_users_exercise_plan WHERE usersId='$usersId' AND exerciseDay='monday';";
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
             ?>
          </div>
        </div>
      </div>
    </div>

    <!--Tuesday Dropdown-->
    <div class="planDayContainer">
      <div class="scrollToTopDiv" id="tuesdayScrollTop"></div>
      <div class="planDayWrapper">
        <h3>Tuesday</h3>
        <div class="planDayForm">
          <input id="tuesdayPlan" style="display:none;" type="text" value="tuesday">
          <input id="tuesdayExercise" class="largeInput" type="text" name="tuesdayExerciseName" value="" placeholder="Exercise Name">
          <input id="tuesdayReps" class="smallInput" type="number" name="tuesdayReps" value="" placeholder="Reps">
          <input id="tuesdaySets" class="smallInput" type="number" name="tuesdaySets" value="" placeholder="Sets">
          <button id="tuesdayAjax">Add Exercise</button>
        </div>
        <div class="planDayDropdownContainer">
          <div class="planDayDropdownButtonWrapper">
            <button id="tuesdayDropdownBtn" onclick="tuesdayToggle()"><i id="tuesdayToggle" class="material-icons tuesdayDropdownBtn">arrow_drop_down</i></button>
          </div>
          <div id="tuesdayDropdown" class="planDayDropdownContent tuesdayDropdown">
            <?php
              if (isset($_SESSION['usersId'])) {
                $usersId = $_SESSION['usersId'];
              } elseif (isset($_SESSION['cookieId'])) {
                $usersId = $_SESSION['cookieId'];
              } else {
                $usersId = null;
              }

              require 'includes/dbh.inc.php';

              $sql = "SELECT * FROM ft_users_exercise_plan WHERE usersId='$usersId' AND exerciseday='tuesday';";
              $stmt = mysqli_stmt_init($conn);

              if (!mysqli_stmt_prepare($stmt, $sql)) {
                echo "SQL statement failed!";
              } else {
                  mysqli_stmt_execute($stmt);
                  $result = mysqli_stmt_get_result($stmt);

                  $showTitle = mysqli_num_rows($result);
                  if ($showTitle > 0) {
                    echo "<h3>Here is you workout plan for Tuesday:</h3>";
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

                    echo "<div class='exerciseInputWrapper  ".$hideWrapperClass."'>
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

                  $sql = "SELECT SUM(exerciseSets) AS setsSum FROM ft_users_exercise_plan WHERE usersId='$usersId' AND exerciseDay='tuesday';";
                  $result = $conn->query($sql);
                  $row = $result->fetch_assoc();

                  $sql2 = "SELECT * FROM ft_users_exercise_plan WHERE usersId='$usersId' AND exerciseDay='tuesday';";
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
             ?>
          </div>
        </div>
      </div>
    </div>
    <!--wednesday Dropdown-->
    <div class="planDayContainer">
      <div class="scrollToTopDiv" id="wednesdayScrollTop"></div>
      <div class="planDayWrapper">
        <h3>Wednesday</h3>
        <div class="planDayForm">
          <input id="wednesdayPlan" style="display:none;" type="text" value="wednesday">
          <input id="wednesdayExercise" class="largeInput" type="text" name="wednesdayExerciseName" value="" placeholder="Exercise Name">
          <input id="wednesdayReps" class="smallInput" type="number" name="wednesdayReps" value="" placeholder="Reps">
          <input id="wednesdaySets" class="smallInput" type="number" name="wednesdaySets" value="" placeholder="Sets">
          <button id="wednesdayAjax">Add Exercise</button>
        </div>
        <div class="planDayDropdownContainer">
          <div class="planDayDropdownButtonWrapper">
            <button id="wednesdayDropdownBtn" onclick="wednesdayToggle()"><i id="wednesdayToggle" class="material-icons wednesdayDropdownBtn">arrow_drop_down</i></button>
          </div>
          <div id="wednesdayDropdown" class="planDayDropdownContent wednesdayDropdown">
            <?php
              if (isset($_SESSION['usersId'])) {
                $usersId = $_SESSION['usersId'];
              } elseif (isset($_SESSION['cookieId'])) {
                $usersId = $_SESSION['cookieId'];
              } else {
                $usersId = null;
              }

              require 'includes/dbh.inc.php';

              $sql = "SELECT * FROM ft_users_exercise_plan WHERE usersId='$usersId' AND exerciseday='wednesday';";
              $stmt = mysqli_stmt_init($conn);

              if (!mysqli_stmt_prepare($stmt, $sql)) {
                echo "SQL statement failed!";
              } else {
                  mysqli_stmt_execute($stmt);
                  $result = mysqli_stmt_get_result($stmt);

                  $showTitle = mysqli_num_rows($result);
                  if ($showTitle > 0) {
                    echo "<h3>Here is you workout plan for Wednesday:</h3>";
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

                    echo "<div class='exerciseInputWrapper  ".$hideWrapperClass."'>
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

                  $sql = "SELECT SUM(exerciseSets) AS setsSum FROM ft_users_exercise_plan WHERE usersId='$usersId' AND exerciseDay='wednesday';";
                  $result = $conn->query($sql);
                  $row = $result->fetch_assoc();

                  $sql2 = "SELECT * FROM ft_users_exercise_plan WHERE usersId='$usersId' AND exerciseDay='wednesday';";
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
             ?>
          </div>
        </div>
      </div>
    </div>
    <!--Thursday Dropdown-->
    <div class="planDayContainer">
      <div class="scrollToTopDiv" id="thursdayScrollTop"></div>
      <div class="planDayWrapper">
        <h3>Thursday</h3>
        <div class="planDayForm">
          <input id="thursdayPlan" style="display:none;" type="text" value="thursday">
          <input id="thursdayExercise" class="largeInput" type="text" name="thursdayExerciseName" value="" placeholder="Exercise Name">
          <input id="thursdayReps" class="smallInput" type="number" name="thursdayReps" value="" placeholder="Reps">
          <input id="thursdaySets" class="smallInput" type="number" name="thursdaySets" value="" placeholder="Sets">
          <button id="thursdayAjax">Add Exercise</button>
        </div>
        <div class="planDayDropdownContainer">
          <div class="planDayDropdownButtonWrapper">
            <button id="thursdayDropdownBtn" onclick="thursdayToggle()"><i id="thursdayToggle" class="material-icons thursdayDropdownBtn">arrow_drop_down</i></button>
          </div>
          <div id="thursdayDropdown" class="planDayDropdownContent thursdayDropdown">
            <?php
              if (isset($_SESSION['usersId'])) {
                $usersId = $_SESSION['usersId'];
              } elseif (isset($_SESSION['cookieId'])) {
                $usersId = $_SESSION['cookieId'];
              } else {
                $usersId = null;
              }

              require 'includes/dbh.inc.php';

              $sql = "SELECT * FROM ft_users_exercise_plan WHERE usersId='$usersId' AND exerciseday='thursday';";
              $stmt = mysqli_stmt_init($conn);

              if (!mysqli_stmt_prepare($stmt, $sql)) {
                echo "SQL statement failed!";
              } else {
                  mysqli_stmt_execute($stmt);
                  $result = mysqli_stmt_get_result($stmt);

                  $showTitle = mysqli_num_rows($result);
                  if ($showTitle > 0) {
                    echo "<h3>Here is you workout plan for Thursday:</h3>";
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

                    echo "<div class='exerciseInputWrapper  ".$hideWrapperClass."'>
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

                  $sql = "SELECT SUM(exerciseSets) AS setsSum FROM ft_users_exercise_plan WHERE usersId='$usersId' AND exerciseDay='thursday';";
                  $result = $conn->query($sql);
                  $row = $result->fetch_assoc();

                  $sql2 = "SELECT * FROM ft_users_exercise_plan WHERE usersId='$usersId' AND exerciseDay='thursday';";
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
             ?>
          </div>
        </div>
      </div>
    </div>
    <!--Friday Dropdown-->
    <div class="planDayContainer">
      <div class="scrollToTopDiv" id="fridayScrollTop"></div>
      <div class="planDayWrapper">
        <h3>Friday</h3>
        <div class="planDayForm">
          <input id="fridayPlan" style="display:none;" type="text" value="friday">
          <input id="fridayExercise" class="largeInput" type="text" name="fridayExerciseName" value="" placeholder="Exercise Name">
          <input id="fridayReps" class="smallInput" type="number" name="fridayReps" value="" placeholder="Reps">
          <input id="fridaySets" class="smallInput" type="number" name="fridaySets" value="" placeholder="Sets">
          <button id="fridayAjax">Add Exercise</button>
        </div>
        <div class="planDayDropdownContainer">
          <div class="planDayDropdownButtonWrapper">
            <button id="fridayDropdownBtn" onclick="fridayToggle()"><i id="fridayToggle" class="material-icons fridayDropdownBtn">arrow_drop_down</i></button>
          </div>
          <div id="fridayDropdown" class="planDayDropdownContent fridayDropdown">
            <?php
              if (isset($_SESSION['usersId'])) {
                $usersId = $_SESSION['usersId'];
              } elseif (isset($_SESSION['cookieId'])) {
                $usersId = $_SESSION['cookieId'];
              } else {
                $usersId = null;
              }

              require 'includes/dbh.inc.php';

              $sql = "SELECT * FROM ft_users_exercise_plan WHERE usersId='$usersId' AND exerciseday='friday';";
              $stmt = mysqli_stmt_init($conn);

              if (!mysqli_stmt_prepare($stmt, $sql)) {
                echo "SQL statement failed!";
              } else {
                  mysqli_stmt_execute($stmt);
                  $result = mysqli_stmt_get_result($stmt);

                  $showTitle = mysqli_num_rows($result);
                  if ($showTitle > 0) {
                    echo "<h3>Here is you workout plan for Friday:</h3>";
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

                    echo "<div class='exerciseInputWrapper  ".$hideWrapperClass."'>
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

                  $sql = "SELECT SUM(exerciseSets) AS setsSum FROM ft_users_exercise_plan WHERE usersId='$usersId' AND exerciseDay='friday';";
                  $result = $conn->query($sql);
                  $row = $result->fetch_assoc();

                  $sql2 = "SELECT * FROM ft_users_exercise_plan WHERE usersId='$usersId' AND exerciseDay='friday';";
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
             ?>
          </div>
        </div>
      </div>
    </div>
    <!--Saturday Dropdown-->
    <div class="planDayContainer">
      <div class="scrollToTopDiv" id="saturdayScrollTop"></div>
      <div class="planDayWrapper">
        <h3>Saturday</h3>
        <div class="planDayForm">
          <input id="saturdayPlan" style="display:none;" type="text" value="saturday">
          <input id="saturdayExercise" class="largeInput" type="text" name="saturdayExerciseName" value="" placeholder="Exercise Name">
          <input id="saturdayReps" class="smallInput" type="number" name="saturdayReps" value="" placeholder="Reps">
          <input id="saturdaySets" class="smallInput" type="number" name="saturdaySets" value="" placeholder="Sets">
          <button id="saturdayAjax">Add Exercise</button>
        </div>
        <div class="planDayDropdownContainer">
          <div class="planDayDropdownButtonWrapper">
            <button id="saturdayDropdownBtn" onclick="saturdayToggle()"><i id="saturdayToggle" class="material-icons saturdayDropdownBtn">arrow_drop_down</i></button>
          </div>
          <div id="saturdayDropdown" class="planDayDropdownContent saturdayDropdown">
            <?php
              if (isset($_SESSION['usersId'])) {
                $usersId = $_SESSION['usersId'];
              } elseif (isset($_SESSION['cookieId'])) {
                $usersId = $_SESSION['cookieId'];
              } else {
                $usersId = null;
              }

              require 'includes/dbh.inc.php';

              $sql = "SELECT * FROM ft_users_exercise_plan WHERE usersId='$usersId' AND exerciseday='saturday';";
              $stmt = mysqli_stmt_init($conn);

              if (!mysqli_stmt_prepare($stmt, $sql)) {
                echo "SQL statement failed!";
              } else {
                  mysqli_stmt_execute($stmt);
                  $result = mysqli_stmt_get_result($stmt);

                  $showTitle = mysqli_num_rows($result);
                  if ($showTitle > 0) {
                    echo "<h3>Here is you workout plan for Saturday:</h3>";
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

                    echo "<div class='exerciseInputWrapper  ".$hideWrapperClass."'>
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

                  $sql = "SELECT SUM(exerciseSets) AS setsSum FROM ft_users_exercise_plan WHERE usersId='$usersId' AND exerciseDay='saturday';";
                  $result = $conn->query($sql);
                  $row = $result->fetch_assoc();

                  $sql2 = "SELECT * FROM ft_users_exercise_plan WHERE usersId='$usersId' AND exerciseDay='saturday';";
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
             ?>
          </div>
        </div>
      </div>
    </div>
    <!--Sunday Dropdown-->
    <div class="planDayContainer">
      <div class="scrollToTopDiv" id="sundayScrollTop"></div>
      <div class="planDayWrapper">
        <h3>Sunday</h3>
        <div class="planDayForm">
          <input id="sundayPlan" style="display:none;" type="text" value="sunday">
          <input id="sundayExercise" class="largeInput" type="text" name="sundayExerciseName" value="" placeholder="Exercise Name">
          <input id="sundayReps" class="smallInput" type="number" name="sundayReps" value="" placeholder="Reps">
          <input id="sundaySets" class="smallInput" type="number" name="sundaySets" value="" placeholder="Sets">
          <button id="sundayAjax">Add Exercise</button>
        </div>
        <div class="planDayDropdownContainer">
          <div class="planDayDropdownButtonWrapper">
            <button id="sundayDropdownBtn" onclick="sundayToggle()"><i id="sundayToggle" class="material-icons sundayDropdownBtn">arrow_drop_down</i></button>
          </div>
          <div id="sundayDropdown" class="planDayDropdownContent sundayDropdown">
            <?php
              if (isset($_SESSION['usersId'])) {
                $usersId = $_SESSION['usersId'];
              } elseif (isset($_SESSION['cookieId'])) {
                $usersId = $_SESSION['cookieId'];
              } else {
                $usersId = null;
              }

              require 'includes/dbh.inc.php';

              $sql = "SELECT * FROM ft_users_exercise_plan WHERE usersId='$usersId' AND exerciseday='sunday';";
              $stmt = mysqli_stmt_init($conn);

              if (!mysqli_stmt_prepare($stmt, $sql)) {
                echo "SQL statement failed!";
              } else {
                  mysqli_stmt_execute($stmt);
                  $result = mysqli_stmt_get_result($stmt);

                  $showTitle = mysqli_num_rows($result);
                  if ($showTitle > 0) {
                    echo "<h3>Here is you workout plan for Sunday:</h3>";
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

                    echo "<div class='exerciseInputWrapper  ".$hideWrapperClass."'>
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

                  $sql = "SELECT SUM(exerciseSets) AS setsSum FROM ft_users_exercise_plan WHERE usersId='$usersId' AND exerciseDay='sunday';";
                  $result = $conn->query($sql);
                  $row = $result->fetch_assoc();

                  $sql2 = "SELECT * FROM ft_users_exercise_plan WHERE usersId='$usersId' AND exerciseDay='sunday';";
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
             ?>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="deleteExerciseSuccessError">

  </div>

  <?php include("footer.php") ?>
  <script src='/assets/js/plan.js'></script>

  <?php
    if (!isset($_SESSION['usersId'])) {
      if (!isset($_SESSION['cookieId'])) {
        echo "<div id='togglePageLogin' class='loginBackgroundOverlay'>";
        echo '<div class="loginWrapper">
                <div class="signupWrapperHeader">
                  <h1>Log in</h1>
                </div>
                <div class="formSignup">
                  <input id="emailAddress" name="emailAddress" type="email" placeholder="Email Address">
                  <input id="passwordInput" name="pword" type="password" placeholder="Password">
                  <div class="showPasswordCheckboxWrapper">
                    <label class="myCheckbox">
                      <input type="checkbox" class="showPasswordCheckbox" name="showPasswordCheckbox" onclick="showPassword()">
                      <span></span>
                    </label>
                    <label class="showPasswordText" for="showPasswordCheckbox"><p>Show Password</p></label>
                  </div>
                  <button id="loginAjax" class="globalBtnStyle">Continue</button>
                </div>
                <div id="errorPopup">
                <p>Create an account <a href="/signup">here</a></p>
                </div>
              </div>';
        echo "</div>";


        echo '<script>
                function showPassword() {
                  var x = document.getElementById("passwordInput");
                  if (x.type === "password") {
                    x.type = "text";
                  } else {
                    x.type = "password";
                  }
                };

                var navToggleLoginPage = function(x) {
                  $(x).toggleClass("hidePage")
                };

                $(function() {
                  $("#toggleNavButton").click(function() {
                    navToggleLoginPage("#togglePageLogin");
                  });
                });

                //Ajax Area
                $(document).ready(function() {
                  $("#loginAjax").click(function() {
                    var emailAddress = $("#emailAddress").val();
                    var passwordInput = $("#passwordInput").val();
                    $("#errorPopup").load("/includes/loginPlan.ajax.inc.php", {
                      emailAddress: emailAddress,
                      pword: passwordInput
                    });
                  });
                });
              </script>';
      }
    }
   ?>
