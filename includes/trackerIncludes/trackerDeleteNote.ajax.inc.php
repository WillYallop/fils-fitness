<?php
if (isset($_POST['noteId'])) {

  $noteId = $_POST['noteId'];
  $noteExercise = $_POST['noteExercise'];

  session_start();
  if (isset($_SESSION['usersId'])) {
    $usersId = $_SESSION['usersId'];
  } elseif (isset($_SESSION['cookieId'])) {
    $usersId = $_SESSION['cookieId'];
  }

  //Security checks
  if (empty($noteId) || empty($noteExercise)) {
    echo "<p class='noCurrentLogMessage'>Error</p>";
    exit ();
  }
  if (!preg_match("/^[0-9]*$/", $noteId)) {
    echo "<p class='noCurrentLogMessage'>Error</p>";
    exit ();
  }
  if (!preg_match("/^[0-9a-zA-Z ]*$/", $noteExercise)) {
    echo "<p class='noCurrentLogMessage'>Error</p>";
    exit ();
  }

  //Script

  require '../dbh.inc.php';

  $sql = "DELETE FROM ft_users_tracker_notes WHERE id='$noteId' AND usersId='$usersId' AND exerciseName='$noteExercise'";
  mysqli_query($conn, $sql);

  //Echo results

  $sql = "SELECT * FROM ft_users_tracker_notes WHERE usersId='$usersId' AND exerciseName='$noteExercise' ORDER BY id";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo "SQL statement failed!";
  } else {
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);

      while ($row = mysqli_fetch_assoc($result)) {

        echo '<div class="noteRow">
                <div class="noteHeader">
                  <p>'.$row["noteTitle"].'</p>
                  <input id="id'.$row['id'].'" value="'.$row['id'].'" style="display:none;">
                  <input id="name'.$row['id'],$row['id'].'" value="'.$row['exerciseName'].'" style="display:none;">
                  <button id="deleteNote'.$row['id'].'"><i class="material-icons">delete</i></button>
                </div>
                <p>'.$row["noteText"].'</p>
              </div>';

              echo '<script>
                      $(document).ready(function() {
                        $("#deleteNote'.$row['id'].'").click(function() {
                          var noteId = $("#id'.$row['id'].'").val();
                          var noteExercise = $("#name'.$row['id'],$row['id'].'").val();
                          $("#noteContentArea").load("/includes/trackerIncludes/trackerDeleteNote.ajax.inc.php", {
                            noteId: noteId,
                            noteExercise: noteExercise
                          });
                        });
                      });
                    </script>';
      }
      
    }


} else {
    header("Location: index");
    exit ();
  }
