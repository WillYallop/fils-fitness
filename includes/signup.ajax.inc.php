<?php
if (isset($_POST['pword'])) {

  require 'dbh.inc.php';

  $fullname = $_POST['fullName'];
  $email = $_POST['emailAddress'];
  $emailConfirm = $_POST['confirmEmailAddress'];
  $password = $_POST['pword'];
  $passwordConfirm = $_POST['confirmPword'];
  $usersRole = "user";

  $cookieHash = bin2hex(random_bytes(16));
  $cookieHashValidate = password_hash($cookieHash, PASSWORD_DEFAULT);

  if (empty($fullname) || empty($email) || empty($emailConfirm) || empty($password) || empty($passwordConfirm)) {
    echo "<div class='successErrorContainer'>
          <div class='successErrorWrapper'>";
    echo "<p>Make sure to fill all of the fields!</p>";
    echo "</div>
          </div>";
    exit();
  }
  else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "<div class='successErrorContainer'>
          <div class='successErrorWrapper'>";
    echo "<p>You need to enter a valid email address!</p>";
    echo "</div>
          </div>";
    exit ();
  }
  else if (!filter_var($emailConfirm, FILTER_VALIDATE_EMAIL)) {
    echo "<div class='successErrorContainer'>
          <div class='successErrorWrapper'>";
    echo "<p>You need to enter a valid email address!</p>";
    echo "</div>
          </div>";
    exit ();
  }
  else if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,30}$/', $password)) {
    echo "<div class='successErrorContainer'>
          <div class='successErrorWrapper'>";
    echo '<p>The password does not meet the requirements!</p>';
    echo "</div>
          </div>";
    exit ();
  }
  else if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,30}$/', $passwordConfirm)) {
    echo "<div class='successErrorContainer'>
          <div class='successErrorWrapper'>";
    echo '<p>The password does not meet the requirements!</p>';
    echo "</div>
          </div>";
    exit ();
  }
  else if (!preg_match("/^[a-zA-Z ]*$/", $fullname)) {
    echo "<div class='successErrorContainer'>
          <div class='successErrorWrapper'>";
    echo "<p>Your name must only contain letters!</p>";
    echo "</div>
          </div>";
    exit ();
  }
  else if ($email != $emailConfirm) {
    echo "<div class='successErrorContainer'>
          <div class='successErrorWrapper'>";
    echo "<p>Make sure your emails match!</p>";
    echo "</div>
          </div>";
    exit ();
  }
  else if ($password != $passwordConfirm) {
    echo "<div class='successErrorContainer'>
          <div class='successErrorWrapper'>";
    echo "<p>Make sure your passwords are the same!</p>";
    echo "</div>
          </div>";
    exit ();
  }

  else {
    $sql = "SELECT usersEmail FROM ft_users WHERE usersEmail=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../signup?error=sqlerror");
      exit ();
    }
    else {
      mysqli_stmt_bind_param($stmt, "s", $email);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_store_result($stmt);
      $resultCheck = mysqli_stmt_num_rows($stmt);

      if ($resultCheck > 0) {
        echo "<div class='successErrorContainer'>
              <div class='successErrorWrapper'>";
        echo "<p>That email address already has an account registered!</p>";
        echo "</div>
              </div>";
        exit ();
      }

      else {
        $sql = "INSERT INTO ft_users (usersFullname, usersEmail, usersPassword, usersRole, usersCookieHash, usersCookieValidate) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
          header("Location: ../signup?error=sqlerror");
          exit ();
        }
        else {
          $hashedpwd = password_hash($password, PASSWORD_DEFAULT);

          mysqli_stmt_bind_param($stmt, "ssssss", $fullname, $email, $hashedpwd, $usersRole, $cookieHash, $cookieHashValidate);
          mysqli_stmt_execute($stmt);

          echo "<div class='successErrorContainer'>
                <div class='successErrorWrapper'>";
          echo  "<p>Your account has been created. You can log in <a href='../login'>here</a></p>";
          echo "</div>
                </div>";
          exit ();
          }
      }
    }
  }
  mysqli_stmt_close($stmt);
  mysqli_close($conn);


} else {
  header("Location: ../index");
  exit ();
}
