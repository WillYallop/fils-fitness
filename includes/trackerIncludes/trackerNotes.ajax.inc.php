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

<div class="textAreaWrapper">
  <input id="noteTitle" placeholder="Title">
  <textarea id="noteText" placeholder="Note"></textarea>
  <button id="addNoteAjax" class="saveLogBtn">Add Note</button>
</div>

<div id="noteContentArea" class="noteContentArea">
  <?php

  $sql = "SELECT * FROM ft_users_tracker_notes WHERE usersId='$usersId' AND exerciseName='$exerciseName' ORDER BY id";
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

  ?>
</div>

<script>
  $(document).ready(function() {
    $("#addNoteAjax").click(function() {
      var noteTitle = $("#noteTitle").val();
      var noteText = $("#noteText").val();
      var name = "<?php echo $exerciseName; ?>";
      $("#noteContentArea").load("/includes/trackerIncludes/trackerAddNote.ajax.inc.php", {
        title: noteTitle,
        text: noteText,
        name: name
      });
    });
  });
</script>
