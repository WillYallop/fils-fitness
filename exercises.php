<!DOCTYPE html>
<html>
  <head>
    <title>Fitness Tracker | Exercises</title>
    <link rel='stylesheet' href='/assets/css/exercise.style.css'>


  <?php include("header.php") ?>

  <!-- Above the fold Inlined CSS -->

  <div id="togglePage" class="universalPageContainer">

    <div class="browseExerciseContainer">
      <div class="browseExerciseWrapper">
        <div class="browseExerciseWrapperOverlay">
          <h1>Search your exercises</h1>
          <p class="titleP">Log your sets and reps, take notes, and track your progression with an easy to read graph</p>
          <div class="ajaxFormWrapper">
            <input id="searchExercise" autocomplete="my-field-name1" type="text" name="searchExerciseName" placeholder="Exercise name">
            <div id="resultsBox">

            </div>
          </div>

        </div>
      </div>
    </div>

    <div class="exerciseContainer">
      <div class="exerciseWrapper">
        <?php
          if (isset($_SESSION['usersId'])) {
            $usersId = $_SESSION['usersId'];
          } elseif (isset($_SESSION['cookieId'])) {
            $usersId = $_SESSION['cookieId'];
          } else {
            $usersId = null;
          }

          require 'includes/dbh.inc.php';

          $sql = "SELECT DISTINCT exerciseName FROM ft_users_exercise_plan WHERE usersId='$usersId' LIMIT 30;";
          $stmt = mysqli_stmt_init($conn);

          if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo "SQL statement failed!";
          } else {
              mysqli_stmt_execute($stmt);
              $result = mysqli_stmt_get_result($stmt);

              $searchResults= mysqli_num_rows($result);
              if ($searchResults == 0) {
                echo "<p style='text-align: center; width: 100%;'>Add exercises to your workout plan to be able to track your progress</p>";
              }

              while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='exerciseLinkContainer'>
                        <a href='tracker?exercise=".$row['exerciseName']."'>
                          <div class='exerciseLinkWrapper'>
                            <button class='exerciseLinkButton'><i class='material-icons'>keyboard_arrow_right</i></button>
                            <div class='exerciseNameWrapper'>
                              <p>".$row['exerciseName']."</p>
                            </div>
                          </div>
                        </a>
                      </div>";

              }

            }
        ?>
      </div>
    </div>

  </div>

  <?php include("footer.php") ?>

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
                    $("#errorPopup").load("/includes/loginExercise.ajax.inc.php", {
                      emailAddress: emailAddress,
                      pword: passwordInput
                    });
                  });
                });
              </script>';
      }
    }
   ?>

<script>

$(document).ready(function() {
  $("#searchExercise").keyup(function() {
    var searchExercise = $("#searchExercise").val();
    $("#resultsBox").load("/includes/searchExercise.ajax.inc.php", {
      searchExercise: searchExercise
    });
  });
});

 </script>
