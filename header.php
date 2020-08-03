<?php session_start(); ?>
<?php include("functions/persistentCookie.fn.php") ?>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
    <meta name="theme-color" content="#FFF">
    <link rel="manifest" href="manifest.webmanifest">
    <link rel="icon" sizes="192x192" href="/assets/images/manifest-icons/homescreen512.png">
    <link rel="apple-touch-icon" href="/assets/images/manifest-icons/homescreen512.png">
    <link rel="stylesheet" href="/assets/css/hamburgers.css">
    <link rel="stylesheet" href="style.css">
    <link href='https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp' rel='stylesheet'>
    <script defer src="https://unpkg.com/simplebar@latest/dist/simplebar.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/darkmode-js@1.5.1/lib/darkmode-js.min.js"></script>
    <link rel="preload" href="/assets/css/simplebar.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
  </head>

  <body>
    <header class="headerContainer darkmodeBackgroundColour">
      <div id="headerWrapper" class="headerWrapper headerAdjustHeight">
        <!--<img src="" alt="Logo">-->
        <a class="logoLink" href="/"><p class="tempLogo">FILS</p></a>
        <nav class="desktopNav">
          <ul>
            <li><a href="/">Calculator</a></li>
            <li><a href="exercises">Tracker</a></li>
            <li><a href="plan">Plan</a></li>
          </ul>
        </nav>
        <div id="desktopHeaderButtonContainer" class="desktopHeaderButtonContainer headerAdjustHeight">
          <div id="accountDropdownBtn">
            <button ><i class="material-icons">person</i></button>
            <div class="accountDropdownContainer">
              <?php
                if (isset($_SESSION['usersId'])) {
                  echo "<form action='includes/logout.inc.php' method='post'>
                          <button type='submit'>Sign Out</button>
                        </form>";
                } elseif (isset($_SESSION['cookieId'])) {
                    echo "<a href='login'><button>Verify Login</button></a>
                          <form action='includes/logout.inc.php' method='post'>
                            <button type='submit'>Sign Out</button>
                          </form>";
                } else {
                  echo '<a href="login"><button>Sign In</button></a>
                        <a href="signup"><button>Sign up</button></a>';
                }
               ?>
            </div>
          </div>
        </div>
        <div id="mobileHeaderButtonContainer" class="mobileHeaderButtonContainer headerAdjustHeight">
          <button id="toggleNavButton" class="hamburger hamburger--squeeze" type="button" aria-label="Open navigation">
            <span class="hamburger-box">
              <span class="hamburger-inner"></span>
            </span>
          </button>
        </div>
        <div class="headerAdjustHeight">
          <button id="darkmodeBtn" class="darkmodeBtnGlobal">
            <i class="material-icons">wb_sunny</i>
          </button>
        </div>
      </div>
      <div id="headerSlantContainer" class="headerSlantContainer headerAdjustHeight">
      </div>
    </header>

    <div id="toggleNavSlider" class="mobileNavSlider darkmodeBackgroundColour">
      <div class="siteMobileNavWrapper"  data-simplebar>
        <nav class="mobileNav">
          <ul>
            <li class="topLi"><a href="/"><i class="material-icons">keyboard_arrow_left</i>Calculator</a></li>
            <li><a href="exercises"><i class="material-icons">keyboard_arrow_left</i>Tracker</a></li>
            <li><a href="plan"><i class="material-icons">keyboard_arrow_left</i>Plan</a></li>
          </ul>
        </nav>

        <div class="mobileNavSliderFooter">
          <div class="footeButtonWrapper">
            <?php
              if (isset($_SESSION['usersId'])) {
                  echo "<form action='includes/logout.inc.php' method='post'>
                          <button class='logInBtn' type='submit'>Sign Out</button>
                        </form>";
              } elseif (isset($_SESSION['cookieId'])) {
                    echo "<a href='login'><button class='logInBtn'>Verify Login</button></a>
                          <form action='includes/logout.inc.php' method='post'>
                            <button class='logInBtn' type='submit'>Sign Out</button>
                          </form>";
              } else {
                echo '<a href="login"><button class="logInBtn">Sign In</button></a>
                      <a href="signup"><button class="logInBtn">Sign up</button></a>';
              }
             ?>
          </div>
        </div>
      </div>
    </div>
