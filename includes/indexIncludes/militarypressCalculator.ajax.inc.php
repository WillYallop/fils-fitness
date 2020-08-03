<?php
  if (isset($_POST['weight'])) {

    if (!preg_match("/^[0-9.]*$/", $_POST['weight'])) {
      echo "<p>Weight has to be a number!</p>";
      exit ();
    }
    if (!preg_match("/^[a-z]*$/", $_POST['gender'])) {
      echo "<p>Woops thats not a gender!</p>";
      exit ();
    }
    if (!preg_match("/^[a-z]*$/", $_POST['unit'])) {
      echo "<p>Wrong unit!</p>";
      exit ();
    }
    if (!preg_match("/^[0-9 -]*$/", $_POST['age'])) {
      echo "<p>Wrong age!</p>";
      exit ();
    }
    if (!preg_match("/^[0-9.]*$/", $_POST['userBodyweight'])) {
      echo "<p>Wrong bodyweight!</p>";
      exit ();
    }
    if ($_POST['unit'] != "kg") {
      if ($_POST['unit'] !="lbs") {
        echo "<p>Wrong unit!</p>";
        exit ();
      }
    }
    if ($_POST['gender'] != "male") {
      if ($_POST['gender'] !="female") {
        echo "<p>Wrong gender!</p>";
        exit ();
      }
    }
    if ($_POST['age'] != "14-17") {
      if ($_POST['age'] !="18-23") {
        if ($_POST['age'] !="24-39") {
          if ($_POST['age'] !="40-49") {
            if ($_POST['age'] !="50-59") {
              if ($_POST['age'] !="60-69") {
                if ($_POST['age'] !="70-79") {
                  if ($_POST['age'] !="80-89") {
                    echo "<p>Wrong age!</p>";
                    exit ();
                  }
                }
              }
            }
          }
        }
      }
    }

    include_once "../dbh.inc.php";

    $weight = $_POST['weight'];
    $gender = $_POST['gender'];
    $unit = $_POST['unit'];
    $age = $_POST['age'];
    $userBodyweight = $_POST['userBodyweight'];

    $userBodyweight = ceil($userBodyweight);
    $weight = ceil($weight);

    if (empty($weight) || empty($userBodyweight)) {
      echo "<p>Make sure to enter your stats so we can calculate your ratio and show strength standards</p>";
    } else {

      //Sets the age bonus multiplyer
      if ($age == "14-17") {
        $ageMultiplyer = 0.87;
      } elseif ($age == "18-23") {
        $ageMultiplyer = 0.98;
      } elseif ($age == "24-39") {
        $ageMultiplyer = 1;
      } elseif ($age == "40-49") {
        $ageMultiplyer = 0.95;
      } elseif ($age == "50-59") {
        $ageMultiplyer = 0.83;
      } elseif ($age == "60-69") {
        $ageMultiplyer = 0.69;
      } elseif ($age == "70-79") {
        $ageMultiplyer = 0.55;
      } elseif ($age == "80-89") {
        $ageMultiplyer = 0.44;
      }
      //Sets the unit multiplyer if the unit is lbs
      if ($unit == "lbs") {
        $unitMultiplyer = 2.205;
      } elseif ($unit == "kg") {
        $unitMultiplyer = 1;
      }

      $usersStrengthRatio =  $weight / $userBodyweight;
      $usersStrengthRatio = round($usersStrengthRatio, 3);

      echo "<p>You can military press <b>".$usersStrengthRatio."</b> times your bodyweight!</p>";
      echo "<h4>Here are the strength standards for the military press:</h4>";
      //Start of Table
      echo "<div class='compareChartTableContainer'>";
      echo "<div class='compareChartTable'>";
      echo "<table cellpadding='5'>
              <tr class='tableHeader'>
                <th>Bodyweight</th>
                <th>Beginner</th>
                <th>Novice</th>
                <th>Intermediate</th>
                <th>Advanced</th>
                <th>Elite</th>
              </tr>";

      $userBodyweightMinus5 = $userBodyweight - 5;
      $userBodyweightPlus5 = $userBodyweight + 5;

      $sql = "SELECT * FROM ft_militarypress_comparison WHERE gender='$gender'AND (bodyweight='$userBodyweightMinus5' OR bodyweight='$userBodyweight' OR bodyweight='$userBodyweightPlus5')";
      $stmt = mysqli_stmt_init($conn);

      if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "SQL statement failed!";
      } else {
          mysqli_stmt_execute($stmt);
          $result = mysqli_stmt_get_result($stmt);
          while ($row = mysqli_fetch_assoc($result)) {
            //For Bodyweight
            $bodyWeightOutput = $row['bodyweight'] * $unitMultiplyer;
            $bodyWeightOutput = ceil($bodyWeightOutput);
            //For beginner Row
            $beginnerOutput = $row['bodyweight'] * $row['beginnerRatio'];
            $beginnerOutput = $beginnerOutput * $ageMultiplyer;
            $beginnerOutput = $beginnerOutput * $unitMultiplyer;
            $beginnerOutput = ceil($beginnerOutput);
            //For novice row
            $noviceOutput = $row['bodyweight'] * $row['noviceRatio'];
            $noviceOutput = $noviceOutput * $ageMultiplyer;
            $noviceOutput = $noviceOutput * $unitMultiplyer;
            $noviceOutput = ceil($noviceOutput);
            //For intermediate row
            $intermediateOutput = $row['bodyweight'] * $row['intermediateRatio'];
            $intermediateOutput = $intermediateOutput * $ageMultiplyer;
            $intermediateOutput = $intermediateOutput * $unitMultiplyer;
            $intermediateOutput = ceil($intermediateOutput);
            //For advanced row
            $advancedOutput = $row['bodyweight'] * $row['advancedRatio'];
            $advancedOutput = $advancedOutput * $ageMultiplyer;
            $advancedOutput = $advancedOutput * $unitMultiplyer;
            $advancedOutput = ceil($advancedOutput);
            //For elite row
            $eliteOutput = $row['bodyweight'] * $row['eliteRatio'];
            $eliteOutput = $eliteOutput * $ageMultiplyer;
            $eliteOutput = $eliteOutput * $unitMultiplyer;
            $elitedOutput = ceil($eliteOutput);

            if ($row['bodyweight'] == $userBodyweight) {
              $addClass = "class='highlightRow'";
            } else {
              $addClass = null;
            }

            echo "<tr ".$addClass.">
                    <td>".$bodyWeightOutput,$unit."</td>
                    <td>".$beginnerOutput,$unit."</td>
                    <td>".$noviceOutput,$unit."</td>
                    <td>".$intermediateOutput,$unit."</td>
                    <td>".$advancedOutput,$unit."</td>
                    <td>".$elitedOutput,$unit."</td>
                  </tr>";
          }
        }
        //End of table
        echo "</table>";
        echo "</div>";
        echo "</div>";
    }
  } else {
    header("Location: ../../index");
    exit ();
  }


?>
