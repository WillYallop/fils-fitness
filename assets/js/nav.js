var navToggle = function(x) {
  $(x).toggleClass('hideNavbar')
};

$(function() {
  $('#toggleNavButton').click(function() {
    navToggle('#toggleNavSlider');
  });
});


var navTogglePage = function(x) {
  $(x).toggleClass('hidePage')
};

$(function() {
  $('#toggleNavButton').click(function() {
    navTogglePage('#togglePage');
  });
});


var $hamburger = $(".hamburger");
$hamburger.on("click", function(e) {
  $hamburger.toggleClass("is-active");

});


// When the user scrolls down 50px from the top of the document, resize the header's size
window.onscroll = function() {scrollHeaderFunction()};

function scrollHeaderFunction() {
  if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
    document.getElementById("headerWrapper").style.height = "60px";
    document.getElementById("desktopHeaderButtonContainer").style.height = "60px";
    document.getElementById("mobileHeaderButtonContainer").style.height = "60px";
    document.getElementById("headerSlantContainer").style.height = "60px";
    document.getElementById("togglePage").classList.add('paddingResize');
    document.getElementById("darkmodeBtn").classList.add('topResize');
  } else {
    document.getElementById("headerWrapper").style.height = "80px";
    document.getElementById("desktopHeaderButtonContainer").style.height = "80px";
    document.getElementById("mobileHeaderButtonContainer").style.height = "80px";
    document.getElementById("headerSlantContainer").style.height = "80px";
    document.getElementById("togglePage").classList.remove('paddingResize');
    document.getElementById("darkmodeBtn").classList.remove('topResize');
  }
};
