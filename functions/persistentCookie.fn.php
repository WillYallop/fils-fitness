<?php
  if (isset($_SESSION['usersId'])) {

    $sessionid = $_SESSION['usersId'];

    require 'dbh.inc.php';

    $sql = "SELECT usersCookieHash, usersCookieValidate FROM ft_users WHERE id='$sessionid';";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();


    $cookie_name = "identity";
    $cookie_value = $row['usersCookieHash'];
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/",); //"jakegroves.co", TRUE, TRUE

    $cookie_name2 = "validate";
    $cookie_value2 = $row['usersCookieValidate'];
    setcookie($cookie_name2, $cookie_value2, time() + (86400 * 30), "/",); //"jakegroves.co", TRUE, TRUE


  } else {
      if (isset($_COOKIE["identity"]) || isset($_COOKIE["validate"])) {

        $usersCookieIdentity = $_COOKIE["identity"];
        $usersCookieValidate = $_COOKIE["validate"];

        $cookieCheck = password_verify($usersCookieIdentity, $usersCookieValidate);

        if ($cookieCheck == false) {

          exit ();
        } else if ($cookieCheck == true) {

          require 'dbh.inc.php';

          $sql = "SELECT id, usersCookieHash, usersCookieValidate FROM ft_users WHERE usersCookieValidate='$usersCookieValidate'";
          $result = $conn->query($sql);
          $row = $result->fetch_assoc();

          $usersId = $row['id'];

          $sql = "UPDATE ft_users SET usersCookieHash = NULL, usersCookieValidate = NULL WHERE id='$usersId'";
          mysqli_query($conn, $sql);

          $cookieHash = bin2hex(random_bytes(16));
          $cookieHashValidate = password_hash($cookieHash, PASSWORD_DEFAULT);

          $sql = "UPDATE ft_users  SET usersCookieHash='$cookieHash', usersCookieValidate='$cookieHashValidate' WHERE id='$usersId'";
          mysqli_query($conn, $sql);

          $cookie_name = "identity";
          $cookie_value = $cookieHash;
          setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/",); //"jakegroves.co", TRUE, TRUE

          $cookie_name2 = "validate";
          $cookie_value2 = $cookieHashValidate;
          setcookie($cookie_name2, $cookie_value2, time() + (86400 * 30), "/",); //"jakegroves.co", TRUE, TRUE

          $_SESSION['cookieId'] = $usersId;

        }
      }
  }
