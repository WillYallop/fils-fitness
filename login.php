<html>
  <head>
    <title>Fitness Tracker | Sign in</title>
    <link rel='stylesheet' href='/assets/css/signupLogin.style.css'>

  <?php include("header.php") ?>

  <!-- Above the fold Inlined CSS -->

  <div id="togglePage" class="universalPageContainer">

    <div class="signupContainer">
      <div class="signupWrapper">
        <div class="signupWrapperHeader">
          <h1>Sign in</h1>
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
        <div class="textAreaWrapper footerArea">
          <p>If you dont have an account yet you can set one up <a href="/signup">here</a>.</p>
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
    };

    //Ajax Area
    $(document).ready(function() {
      $("#loginAjax").click(function() {
        var emailAddress = $("#emailAddress").val();
        var passwordInput = $("#passwordInput").val();
        $("#errorPopup").load("/includes/login.ajax.inc.php", {
          emailAddress: emailAddress,
          pword: passwordInput
        });
      });
    });
  </script>
