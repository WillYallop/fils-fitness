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

    if (!preg_match("/^[a-zA-Z ]*$/", $exerciseName)) {
      echo "<p class='noCurrentLogMessage'>Invalid exercise name!</p>";
      exit ();
    }

    require '../dbh.inc.php';
  }
?>



<div class="graphContainer">

</div>

<script src="/assets/js/apexcharts.js"></script>

<?php

//First half of graph lift
$sql2 = "SELECT * FROM ft_users_tracker_logs WHERE usersId='$usersId' AND exerciseName='$exerciseName';";
$result2 = $conn->query($sql2);
$row2 = $result2->fetch_assoc();

if ($row2['exerciseType'] == 'lift') {
  $exerciseType = 'lift';
} elseif ($row2['exerciseType'] == 'cardio') {
  echo '<div class="graphContentExplainerContainer">
          <p style="margin: 0; padding: 0;">At the moment this graph only displays data for lifts and not cardio.</p>
        </div>';
  exit ();
}


$sql = "SELECT * FROM ft_users_tracker_logs WHERE usersId='$usersId' AND exerciseName='$exerciseName' ORDER BY exerciseDate LIMIT 10;";
$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql)) {
  echo "SQL statement failed!";
} else {
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $showGraph = mysqli_num_rows($result);
    if ($showGraph <= 1) {
      echo '<div class="graphContentExplainerContainer">
              <p style="margin: 0; padding: 0;">This graph displays your estimated 1 rep max which is based on the stats provided in your log.<br><br>
              You must have at least 2 logs recorded for you graph to be displayed.</p>
            </div>';
      $showGraph = 'hide';
    } else {
      $showGraph = 'show';
    }

    if ($showGraph == 'show') {
      if ($exerciseType == 'lift') {
      echo '<div class="graphContentExplainerContainer">
              <p style="margin: 0; padding: 0;">This graph displays your estimated 1 rep max which is based on the stats provided in your log.</p>
            </div>';
      echo "<div class='graphWrapper'>
              <div id='chart'>";
      echo '<script>
              var options = {
                chart: {
                  width: "100%",
                  height: "100%",
                  type: "line"
                },
                series: [{
                  name: "One Rep Max",
                  data: [';
      }
    }

   function getPercentOfNumber($number, $percent){
      return ($percent / 100) * $number;
   }

    while ($row = mysqli_fetch_assoc($result)) {

      $weight = $row['exerciseWeight'];
      $reps = $row['exerciseReps'];

      if ($reps == NULL) {
        $reps = '1';
      }

      if ($reps == 1) {
        $weightOutput = $weight;
        $weightOutput = ceil($weightOutput);
      } elseif ($reps == 2) {
        $weightOutput = getPercentOfNumber($weight, 5) + $weight;
        $weightOutput = ceil($weightOutput);
      } elseif ($reps == 3) {
        $weightOutput = getPercentOfNumber($weight, 7) + $weight;
        $weightOutput = ceil($weightOutput);
      } elseif ($reps == 4) {
        $weightOutput = getPercentOfNumber($weight, 9) + $weight;
        $weightOutput = ceil($weightOutput);
      } elseif ($reps == 5) {
        $weightOutput = getPercentOfNumber($weight, 12) + $weight;
        $weightOutput = ceil($weightOutput);
      } elseif ($reps == 6) {
        $weightOutput = getPercentOfNumber($weight, 16) + $weight;
        $weightOutput = ceil($weightOutput);
      } elseif ($reps == 7) {
        $weightOutput = getPercentOfNumber($weight, 20) + $weight;
        $weightOutput = ceil($weightOutput);
      } elseif ($reps == 8) {
        $weightOutput = getPercentOfNumber($weight, 24) + $weight;
        $weightOutput = ceil($weightOutput);
      } elseif ($reps == 9) {
        $weightOutput = getPercentOfNumber($weight, 29) + $weight;
        $weightOutput = ceil($weightOutput);
      } elseif ($reps == 10) {
        $weightOutput = getPercentOfNumber($weight, 33.5) + $weight;
        $weightOutput = ceil($weightOutput);
      } elseif ($reps == 11) {
        $weightOutput = getPercentOfNumber($weight, 36) + $weight;
        $weightOutput = ceil($weightOutput);
      } elseif ($reps == 12) {
        $weightOutput = getPercentOfNumber($weight, 39) + $weight;
        $weightOutput = ceil($weightOutput);
      } elseif ($reps == 13) {
        $weightOutput = getPercentOfNumber($weight, 43) + $weight;
        $weightOutput = ceil($weightOutput);
      } elseif ($reps == 14) {
        $weightOutput = getPercentOfNumber($weight, 47) + $weight;
        $weightOutput = ceil($weightOutput);
      } elseif ($reps == 15) {
        $weightOutput = getPercentOfNumber($weight, 50) + $weight;
        $weightOutput = ceil($weightOutput);
      } elseif ($reps == 16) {
        $weightOutput = getPercentOfNumber($weight, 53) + $weight;
        $weightOutput = ceil($weightOutput);
      } elseif ($reps == 17) {
        $weightOutput = getPercentOfNumber($weight, 56.5) + $weight;
        $weightOutput = ceil($weightOutput);
      } elseif ($reps == 18) {
        $weightOutput = getPercentOfNumber($weight, 60) + $weight;
        $weightOutput = ceil($weightOutput);
      } elseif ($reps == 19) {
        $weightOutput = getPercentOfNumber($weight, 65) + $weight;
        $weightOutput = ceil($weightOutput);
      } elseif ($reps == 20) {
        $weightOutput = getPercentOfNumber($weight, 66) + $weight;
        $weightOutput = ceil($weightOutput);
      } elseif ($rep > 20) {
        $weightOutput = getPercentOfNumber($weight, 66) + $weight;
        $weightOutput = ceil($weightOutput);
      }

      $exerciseLift = "".$weightOutput.",";

        if ($showGraph == 'show') {
          if ($exerciseType == 'lift') {

                   echo $exerciseLift;

          }
        }
    }
  }

  //Second half of graph For date

  $sql = "SELECT * FROM ft_users_tracker_logs WHERE usersId='$usersId' AND exerciseName='$exerciseName' ORDER BY exerciseDate LIMIT 10;";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo "SQL statement failed!";
  } else {
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);


      $showGraph = mysqli_num_rows($result);
      if ($showGraph <= 1) {
        $showGraph = 'hide';
      } else {
        $showGraph = 'show';
      }

      if ($showGraph == 'show') {
        echo ']
              }],
              xaxis: {
                categories: [';
      }

      while ($row = mysqli_fetch_assoc($result)) {

        $exerciseDate = "'".$row['exerciseDate']."',";

          if ($showGraph == 'show') {
            if ($exerciseType == 'lift') {

                     echo $exerciseDate;

            }
          }
      }

      if ($showGraph == 'show') {
        if ($exerciseType == 'lift') {
        echo '],
              labels: {
                show: true,
                rotate: -90,
                rotateAlways: false,
                hideOverlappingLabels: true,
                showDuplicates: true,
                trim: true,
                minHeight: undefined,
                maxHeight: 120,
              },
                axisBorder: {
                  show: true,
                  color: "#78909C",
                  height: 1,
                  width: "100%",
                  offsetX: 0,
                  offsetY: 0
                },
                }
              }

              var chart = new ApexCharts(document.querySelector("#chart"), options);

              chart.render();
            </script>';

        echo "</div>
            </div>";

      }
    }

    }
?>
