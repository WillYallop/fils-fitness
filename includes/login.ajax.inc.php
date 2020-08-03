<?php
if (isset($_POST['emailAddress'])) {

  require 'dbh.inc.php';

  $email = $_POST['emailAddress'];
  $password = $_POST['pword'];

  if (empty($email) || empty($password)) {
    header("Location: ../login?error=emptyfields");
    exit ();
  }
  else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "<div class='successErrorContainer'>
          <div class='successErrorWrapper'>";
    echo "<p>You need to enter a valid email address!</p>";
    echo "</div>
          </div>";
    exit ();
  }
  else {
    $sql = "SELECT * FROM ft_users WHERE usersEmail=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../login?error=sqlerror");
      exit ();
    }
    else {

      mysqli_stmt_bind_param($stmt, "s", $email);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      if ($row = mysqli_fetch_assoc($result)) {
        $pwdCheck = password_verify($password, $row['usersPassword']);
        if ($pwdCheck == false) {
          echo "<div class='successErrorContainer'>
                <div class='successErrorWrapper'>";
          echo "<p>Wrong Password!</p>";
          echo "</div>
                </div>";
          exit ();
        }
        else if ($pwdCheck == true) {

          if (empty($row['usersCookieHash']) || empty($row['usersCookieValidate'])) {

            $usersId = $row['id'];

            $cookieHash = bin2hex(random_bytes(16));
            $cookieHashValidate = password_hash($cookieHash, PASSWORD_DEFAULT);

            $sql = "UPDATE ft_users  SET usersCookieHash='$cookieHash', usersCookieValidate='$cookieHashValidate' WHERE id='$usersId'";
            mysqli_query($conn, $sql);
          }

          session_unset();
          session_destroy();
          session_start();
          $_SESSION['usersId'] = $row['id'];
          $_SESSION['fullname'] = $row['usersFullname'];

          echo "<script> window.location.replace('/plan');</script>";
          exit ();
        }
        else {
          echo "<div class='successErrorContainer'>
                <div class='successErrorWrapper'>";
          echo "<p>Wrong Password!</p>";
          echo "</div>
                </div>";
          exit ();
        }
      }
      else {
        echo "<div class='successErrorContainer'>
              <div class='successErrorWrapper'>";
        echo "<p>No user with those details!</p>";
        echo "</div>
              </div>";
        exit ();
      }
    }
  }

}
else {
  header("Location: login");
  exit ();
}
