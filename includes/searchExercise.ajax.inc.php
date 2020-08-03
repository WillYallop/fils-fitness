<?php

if (isset($_POST['searchExercise'])) {

  session_start();

  $searchExercise = $_POST['searchExercise'];

  if (isset($_SESSION['usersId'])) {
    $usersId = $_SESSION['usersId'];
  } elseif (isset($_SESSION['cookieId'])) {
    $usersId = $_SESSION['cookieId'];
  } else {
    $usersId = NULL;
  }

  if (!preg_match("/^[a-zA-Z ]*$/", $searchExercise)) {
    exit ();
  }

  if (empty($searchExercise)) {
    exit ();
  }

  require 'dbh.inc.php';

  //Echo results into Ajax results div
  $sql = "SELECT DISTINCT exerciseName FROM ft_users_exercise_plan WHERE usersId='$usersId' AND (`exerciseName` LIKE '%$searchExercise%') LIMIT 4;";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo "SQL statement failed!";
  } else {
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);

      $searchResults= mysqli_num_rows($result);
      if ($searchResults > 1) {
        echo "<div class='searchResultWrapper'>";
      }

      while ($row = mysqli_fetch_assoc($result)) {

        echo "<div class='exerciseResultRow'>
                <a href='tracker?exercise=".$row['exerciseName']."'><p>".$row['exerciseName']."</p></a>
              </div>";

      }

      if ($searchResults > 1) {
        echo "</div>";
      }
    }

} else {
  // code...
}
