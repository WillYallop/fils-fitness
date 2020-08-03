<!DOCTYPE html>
<html>
  <head>
    <title>Fitness Tracker | Signup</title>
    <link rel='stylesheet' href='/assets/css/signupLogin.style.css'>

  <?php include("header.php") ?>

  <div id="togglePage" class="universalPageContainer">

    <div class="signupContainer">
      <div class="signupWrapper">
        <div class="signupWrapperHeader">
          <h1>Signup</h1>
        </div>
        <div class="textAreaWrapper">
          <p>Our tracker and store share the same login details, so if you already have an account you can log in <a href="login.php">here</a></p>
        </div>
        <div class="formSignup">
          <input id="fullName" name="fullName" type="text" placeholder="Full Name">
          <input id="emailAddress" name="emailAddress" type="email" placeholder="Email Address">
          <input id="confirmEmailAddress" name="confirmEmailAddress" type="email" placeholder="Confirm Email">
          <p class="passwordRequirements">Your password should be a minimum of 8 characters long and contain at least 1 number.</p>
          <input id="passwordInput" name="pword" type="password" placeholder="Password">
          <input id="passwordInput2" name="confirmPword" type="password" placeholder="Confirm Password">
          <div class="showPasswordCheckboxWrapper">
            <label class="myCheckbox">
              <input type="checkbox" class="showPasswordCheckbox" name="showPasswordCheckbox" onclick="showPassword()">
              <span></span>
            </label>
            <label class="showPasswordText" for="showPasswordCheckbox"><p>Show Password</p></label>
          </div>
          <button id="signupAjax" class="globalBtnStyle">Continue</button>
        </div>
        <div class="textAreaWrapper footerArea">
          <p>By proceeding, you are confirming that you agree to our <a href="terms-conditions">Terms and Conditions</a> and <a href="privacy-policy">Privacy Policy</a>.</p>
        </div>
      </div>
    </div>

    <div id="errorPopup">

    </div>

  </div>

  <?php include("footer.php") ?>

  <script>
    function showPassword() {
      var x = document.getElementById("passwordInput");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
      var x = document.getElementById("passwordInput2");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    }

    //Ajax Area
    $(document).ready(function() {
      $("#signupAjax").click(function() {
        var fullName = $("#fullName").val();
        var emailAddress = $("#emailAddress").val();
        var confirmEmailAddress = $("#confirmEmailAddress").val();
        var passwordInput = $("#passwordInput").val();
        var passwordInput2 = $("#passwordInput2").val();
        $("#errorPopup").load("/includes/signup.ajax.inc.php", {
          fullName: fullName,
          emailAddress: emailAddress,
          confirmEmailAddress: confirmEmailAddress,
          pword: passwordInput,
          confirmPword: passwordInput2
        });
      });
    });

  </script>
