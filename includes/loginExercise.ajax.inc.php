<?php
if (isset($_POST['emailAddress'])) {

  require 'dbh.inc.php';

  $email = $_POST['emailAddress'];
  $password = $_POST['pword'];

  if (empty($email) || empty($password)) {
    header("Location: ../exercise?error=emptyfields");
    exit ();
  }
  else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "<p>You need to enter a valid email address!</p>";
    exit ();
  }
  else {
    $sql = "SELECT * FROM ft_users WHERE usersEmail=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../exercise?error=sqlerror");
      exit ();
    }
    else {

      mysqli_stmt_bind_param($stmt, "s", $email);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      if ($row = mysqli_fetch_assoc($result)) {
        $pwdCheck = password_verify($password, $row['usersPassword']);
        if ($pwdCheck == false) {
          echo "<p>Wrong Password!</p>";
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

          echo "<p>Success</p>";
          echo "<script> window.location.replace('/exercises');</script>";
          exit ();
        }
        else {
          echo "<p>Wrong Password!</p>";
          exit ();
        }
      }
      else {
        echo "<p>No user with those details!</p>";
        exit ();
      }
    }
  }

}
else {
  header("Location: tracker");
  exit ();
}
