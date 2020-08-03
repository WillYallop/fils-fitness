<!DOCTYPE html>
<html>
  <head>
    <title>Fitness Tracker</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
    <link rel="manifest" href="manifest.webmanifest">
    <link rel="icon" sizes="192x192" href="/assets/images/manifest-icons/homescreen512.png">
    <link rel="apple-touch-icon" href="/assets/images/manifest-icons/homescreen512.png">
    <meta name="theme-color" content="#FFF">
  </head>

  <style>
    html{-webkit-tap-highlight-color:transparent!important;-webkit-tap-highlight-color:transparent!important;height:100%;min-height:100%;}body{min-height:100%;height:100%;margin:0;padding:0;font-family:Arial,Helvetica,sans-serif}::selection{background-color:#07cfbc;color:#fff}button:focus{outline:0}.pwaIndexPageSecletorContainer{height:100%;min-height:100%;width:100%;background-color:red;display:flex;flex-wrap:wrap}.pwaIndexPageSecletorContainer .row{width:50%;height:100%}@media only screen and (max-width:1000px){.pwaIndexPageSecletorContainer .row{width:100%;height:50%}}.fitnessTracker{background-image:url(/assets/images/index/pwaindexbg1.jpg);background-position:center center;background-size:cover}.fitnessTrackerOverlay{background:rgba(7,207,188,.7);width:100%;height:100%;display:flex;justify-content:center;align-items:center}.fitnessStore{background-image:url(/assets/images/index/pwaindexbg2.jpg);background-position:center center;background-size:cover}.fitnessStorerOverlay{background:rgba(5,176,160,.7);width:100%;height:100%;display:flex;justify-content:center;align-items:center}.overlayContentWrapper{padding-left:20px;padding-right:20px;display:flex;justify-content:center;flex-wrap:wrap}.overlayContentBtnArea{width:100%;text-align:center}.overlayContentBtnArea button{width:250px;height:60px;background:0 0;border:4px solid #fff;color:#fff;font-size:20px;border-radius:30px;transition:.3s;cursor:pointer}.overlayContentBtnArea button:hover{background-color:#fff;color:#232323}.overlayContentTextArea{width:100%;text-align:center}.overlayContentTextArea p{color:#fff;font-size:18px}
  </style>

  <body>
    <div class="pwaIndexPageSecletorContainer">
      <div class="row fitnessTracker">
        <div class="fitnessTrackerOverlay">
          <div class="overlayContentWrapper">
            <div class="overlayContentBtnArea">
              <a href="index"><button>Workout Tracker</button></a>
            </div>
          </div>
        </div>
      </div>
      <div class="row fitnessStore">
        <div class="fitnessStorerOverlay">
          <div class="overlayContentWrapper">
            <div class="overlayContentBtnArea">
              <a href="https://jakegroves.co"><button>Store</button></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
<html>
