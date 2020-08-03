  <div class="modal">
    <div class="displayFlex">
      <button><div class="modalGif"></div></button>
    </div>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="/assets/js/nav.js"></script>

  <script>
    $body = $("body");
    $(document).on({
        ajaxStart: function() { $body.addClass("loading"); },
         ajaxStop: function() { $body.removeClass("loading"); }
    });
  </script>

  <script>
  // Service worker for Progressive Web App
      if ('serviceWorker' in navigator) {
          navigator.serviceWorker.register('/service-worker.js', {
              scope: '.' // THIS IS REQUIRED FOR RUNNING A PROGRESSIVE WEB APP FROM A NON_ROOT PATH
          }).then(function(registration) {
              // Registration was successful
              console.log('ServiceWorker registration successful with scope: ', registration.scope);
          }, function(err) {
              // registration failed :(
              console.log('ServiceWorker registration failed: ', err);
          });
      }

      //If the page is loaded with nightmode set the theme to black
      function changeThemeColor() {
        var metaThemeColor = document.querySelector("meta[name=theme-color]");
        metaThemeColor.setAttribute("content", "#151515");
      }
      $(document).ready(function() {
        if ($("body").hasClass("darkmode--activated")) {
          changeThemeColor();
        }
      });

      //Toggle the theme colour when night mode btn is clicked
      function toggleThemeColour() {
        var metaThemeColourToggle = $('meta[name=theme-color]').attr("content");
        if (metaThemeColourToggle == "#FFF") {
          $('meta[name=theme-color]').remove();
          $('head').append( '<meta name="theme-color" content="#151515">' );
        }
        if (metaThemeColourToggle == "#151515") {
          $('meta[name=theme-color]').remove();
          $('head').append( '<meta name="theme-color" content="#FFF">' );
        }
      }

      var options = {
        saveInCookies: true, // default: true,
        autoMatchOsTheme: true  // default: true
      }

      const darkmode = new Darkmode(options);
      $("#darkmodeBtn").click(function() {
        darkmode.toggle();
        toggleThemeColour();
      });
  </script>

  </body>
</html>
