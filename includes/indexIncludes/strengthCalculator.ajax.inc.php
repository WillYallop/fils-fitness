<?php
if (isset($_POST['weight'])) {

  if (!preg_match("/^[0-9]*$/", $_POST['weight'])) {
    echo "<p>Weight has to be a number!</p>";
    exit ();
  }
  if (!preg_match("/^[0-9]*$/", $_POST['reps'])) {
    echo "<p>Reps has to be a number!</p>";
    exit ();
  }
  if (!preg_match("/^[a-z]*$/", $_POST['unit'])) {
    echo "<p>Wrong unit!</p>";
    exit ();
  }
  if ($_POST['unit'] != "kg") {
    if ($_POST['unit'] !="lbs") {
      echo "<p>Wrong unit!</p>";
      exit ();
    }
  }

  $weight = $_POST['weight'];
  $unit = $_POST['unit'];
  $reps = $_POST['reps'];

  if (empty($weight) || empty($unit) || empty($reps)) {
    echo "<p>Make sure to enter your stats so we can calculate your 1 rep max.</p>";
  } else {

    function getPercentOfNumber($number, $percent){
      return ($percent / 100) * $number;
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
    }

    echo "<p>Your one rep max is: <b>".$weightOutput, $unit."<b></p>";

    echo "<table cellpadding='5'>";
    echo "<tr class='tableHeader'>
            <th>Percentage of 1RM</th>
            <th>Weight</th>
            <th>Repetitions</th>
          </tr>";
    //100% of the 1RM
    echo "<tr>
            <td>100%</td>
            <td>".$weightOutput, $unit."</td>
            <td>1</td>
          </tr>";

    //95% of the 1RM
    echo "<tr>
            <td>95%</td>
            <td>";
    echo getPercentOfNumber($weightOutput, 95), $unit;
    echo "  </td>
            <td>2</td>
          </tr>";
    //90% of the 1RM
    echo "<tr>
            <td>90%</td>
            <td>";
    echo getPercentOfNumber($weightOutput, 90), $unit;
    echo "  </td>
            <td>4</td>
          </tr>";
    //85% of the 1RM
    echo "<tr>
            <td>85%</td>
            <td>";
    echo getPercentOfNumber($weightOutput, 85), $unit;
    echo "  </td>
            <td>6</td>
          </tr>";
    //80% of the 1RM
    echo "<tr>
            <td>80%</td>
            <td>";
    echo getPercentOfNumber($weightOutput, 80), $unit;
    echo "  </td>
            <td>8</td>
          </tr>";
    //75% of the 1RM
    echo "<tr>
            <td>75%</td>
            <td>";
    echo getPercentOfNumber($weightOutput, 75), $unit;
    echo "  </td>
            <td>10</td>
          </tr>";
    //70% of the 1RM
    echo "<tr>
            <td>70%</td>
            <td>";
    echo getPercentOfNumber($weightOutput, 70), $unit;
    echo "  </td>
            <td>13</td>
          </tr>";
    //65% of the 1RM
    echo "<tr>
            <td>65%</td>
            <td>";
    echo getPercentOfNumber($weightOutput, 65), $unit;
    echo "  </td>
            <td>16</td>
          </tr>";
    //60% of the 1RM
    echo "<tr>
            <td>60%</td>
            <td>";
    echo getPercentOfNumber($weightOutput, 60), $unit;
    echo "  </td>
            <td>20</td>
          </tr>";
    echo "</table>";

  }
} else {
  header("Location: ../../index");
  exit ();
}

?>
