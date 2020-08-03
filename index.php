<!DOCTYPE html>
<html>
  <head>
    <title>Fitness Tracker | Calculator</title>
    <link rel='stylesheet' href='/assets/css/index.style.css'>

  <?php include("header.php") ?>

  <!-- Above the fold Inlined CSS -->

  <div id="togglePage" class="universalPageContainer">

    <div class="strengthCalculatorContainer">
      <div class="strengthCalculatorWrapper darkmodeBackgroundColour">
        <h3>Calculate your 1 rep max:</h3>
        <div class="inputForm">
          <div class="liftUnitInputWrapper">
            <input id="strengthCalculatorWeight" class="strengthCalculatorInput" type="number" name="liftWeight" value="" placeholder="Weight Lifted">
            <select id="strengthCalculatorUnit" class="strengthCalculatorSelect">
              <option value="kg">KG</option>
              <option value="lbs">LBS</option>
            </select>
          </div>
          <input id="strengthCalculatorReps" class="strengthCalculatorInput inputFullWidth" type="number" min="1" max="20" name="liftReps" value="" placeholder="Reps"><br>
          <button id="stregthCalculatorButton" class="inputButtonStyle">Calculate</button>
        </div>

        <div class="dropdownContainer">
          <div class="dropdownButtonWrapper">
            <button id="stregnthCalculatorDropdownBtn" onclick="calcToggle()"><i id="calcToggle" class="material-icons">arrow_drop_up</i></button>
          </div>
          <div id="stregnthCalculatorDropdown" class="dropdownContent">



          </div>
        </div>
      </div>
    </div>

    <div class="strengthCalculatorContainer">
      <div class="strengthCalculatorWrapper darkmodeBackgroundColour">
        <h3>Bench strength ratio & strength standards:</h3>
        <p>This works out your strength ratio for the bench press and also gives you data on the strength standards for this lift</p>
        <div class="inputForm">
          <div class="liftUnitInputWrapper">
            <input id="benchWeight" class="strengthCalculatorInput compareStrengthStyle" type="number" name="benchWeight" value="" placeholder="1 Rep Max">
            <input id="benchBodyweight" class="strengthCalculatorInput compareStrengthStyle  strenghtInputMargin" type="number" name="bodyweight" value="" placeholder="Bodyweight">
            <select id="benchGender" name="benchGender" class="compareStrengthSelect">
              <option value="male">Male</option>
              <option value="female">Female</option>
            </select>
            <select id="benchAge" name="benchAge" class="compareStrengthSelect strenghtSelectMargin">
              <option value="14-17">14-17</option>
              <option selected value="18-23">18-23</option>
              <option value="24-39">24-39</option>
              <option value="40-49">40-49</option>
              <option value="50-59">50-59</option>
              <option value="60-69">60-69</option>
              <option value="70-79">70-79</option>
              <option value="80-89">80-89</option>
            </select>
            <select id="benchUnit" class="compareStrengthSelect  strenghtSelectMargin">
              <option value="kg">KG</option>
              <option value="lbs">LBS</option>
            </select>
          </div>
          <button id="benchCalculatorButton" class="inputButtonStyle">Calculate</button>
        </div>
        <div class="dropdownContainer">
          <div class="dropdownButtonWrapper">
            <button id="benchCalculatorDropdownBtn" onclick="benchToggle()"><i id="benchToggle" class="material-icons">arrow_drop_up</i></button>
          </div>
          <div id="benchCalculatorDropdown" class="dropdownContent">



          </div>
        </div>
      </div>
    </div>

    <div class="strengthCalculatorContainer">
      <div class="strengthCalculatorWrapper darkmodeBackgroundColour">
        <h3>Deadlift strength ratio & strength standards:</h3>
        <p>This works out your strength ratio for the deadlift and also gives you data on the strength standards for this lift</p>
        <div class="inputForm">
          <div class="liftUnitInputWrapper">
            <input id="deadliftWeight" class="strengthCalculatorInput compareStrengthStyle" type="number" name="deadliftWeight" value="" placeholder="1 Rep Max">
            <input id="deadliftBodyweight" class="strengthCalculatorInput compareStrengthStyle  strenghtInputMargin" type="number" name="bodyweight" value="" placeholder="Bodyweight">
            <select id="deadliftGender" name="deadliftGender" class="compareStrengthSelect">
              <option value="male">Male</option>
              <option value="female">Female</option>
            </select>
            <select id="deadliftAge" name="deadliftAge" class="compareStrengthSelect strenghtSelectMargin">
              <option value="14-17">14-17</option>
              <option selected value="18-23">18-23</option>
              <option value="24-39">24-39</option>
              <option value="40-49">40-49</option>
              <option value="50-59">50-59</option>
              <option value="60-69">60-69</option>
              <option value="70-79">70-79</option>
              <option value="80-89">80-89</option>
            </select>
            <select id="deadliftUnit" class="compareStrengthSelect  strenghtSelectMargin">
              <option value="kg">KG</option>
              <option value="lbs">LBS</option>
            </select>
          </div>
          <button id="deadliftCalculatorButton" class="inputButtonStyle">Calculate</button>
        </div>
        <div class="dropdownContainer">
          <div class="dropdownButtonWrapper">
            <button id="deadliftCalculatorDropdownBtn" onclick="deadliftToggle()"><i id="deadliftToggle" class="material-icons">arrow_drop_up</i></button>
          </div>
          <div id="deadliftCalculatorDropdown" class="dropdownContent">



          </div>
        </div>
      </div>
    </div>

    <div class="strengthCalculatorContainer">
      <div class="strengthCalculatorWrapper darkmodeBackgroundColour">
        <h3>Squat strength ratio & strength standards:</h3>
        <p>This works out your strength ratio for the squat and also gives you data on the strength standards for this lift</p>
        <div class="inputForm">
          <div class="liftUnitInputWrapper">
            <input id="squatWeight" class="strengthCalculatorInput compareStrengthStyle" type="number" name="squatWeight" value="" placeholder="1 Rep Max">
            <input id="squatBodyweight" class="strengthCalculatorInput compareStrengthStyle  strenghtInputMargin" type="number" name="bodyweight" value="" placeholder="Bodyweight">
            <select id="squatGender" name="squatGender" class="compareStrengthSelect">
              <option value="male">Male</option>
              <option value="female">Female</option>
            </select>
            <select id="squatAge" name="squatAge" class="compareStrengthSelect strenghtSelectMargin">
              <option value="14-17">14-17</option>
              <option selected value="18-23">18-23</option>
              <option value="24-39">24-39</option>
              <option value="40-49">40-49</option>
              <option value="50-59">50-59</option>
              <option value="60-69">60-69</option>
              <option value="70-79">70-79</option>
              <option value="80-89">80-89</option>
            </select>
            <select id="squatUnit" class="compareStrengthSelect  strenghtSelectMargin">
              <option value="kg">KG</option>
              <option value="lbs">LBS</option>
            </select>
          </div>
          <button id="squatCalculatorButton" class="inputButtonStyle">Calculate</button>
        </div>
        <div class="dropdownContainer">
          <div class="dropdownButtonWrapper">
            <button id="squatCalculatorDropdownBtn" onclick="squatToggle()"><i id="squatToggle" class="material-icons">arrow_drop_up</i></button>
          </div>
          <div id="squatCalculatorDropdown" class="dropdownContent">



          </div>
        </div>
      </div>
    </div>


    <div class="strengthCalculatorContainer">
      <div class="strengthCalculatorWrapper darkmodeBackgroundColour">
        <h3>Military Press ratio & strength standards:</h3>
        <p>This works out your strength ratio for the military press and also gives you data on the strength standards for this lift</p>
        <div class="inputForm">
          <div class="liftUnitInputWrapper">
            <input id="militarypressWeight" class="strengthCalculatorInput compareStrengthStyle" type="number" name="militarypressWeight" value="" placeholder="1 Rep Max">
            <input id="militarypressBodyweight" class="strengthCalculatorInput compareStrengthStyle  strenghtInputMargin" type="number" name="bodyweight" value="" placeholder="Bodyweight">
            <select id="militarypressGender" name="militarypressGender" class="compareStrengthSelect">
              <option value="male">Male</option>
              <option value="female">Female</option>
            </select>
            <select id="militarypressAge" name="militarypressAge" class="compareStrengthSelect strenghtSelectMargin">
              <option value="14-17">14-17</option>
              <option selected value="18-23">18-23</option>
              <option value="24-39">24-39</option>
              <option value="40-49">40-49</option>
              <option value="50-59">50-59</option>
              <option value="60-69">60-69</option>
              <option value="70-79">70-79</option>
              <option value="80-89">80-89</option>
            </select>
            <select id="militarypressUnit" class="compareStrengthSelect  strenghtSelectMargin">
              <option value="kg">KG</option>
              <option value="lbs">LBS</option>
            </select>
          </div>
          <button id="militarypressCalculatorButton" class="inputButtonStyle">Calculate</button>
        </div>
        <div class="dropdownContainer">
          <div class="dropdownButtonWrapper">
            <button id="militarypressCalculatorDropdownBtn" onclick="militarypressToggle()"><i id="militarypressToggle" class="material-icons">arrow_drop_up</i></button>
          </div>
          <div id="militarypressCalculatorDropdown" class="dropdownContent">



          </div>
        </div>
      </div>
    </div>

  </div>

  <?php include("footer.php") ?>

  <script>

    //Strength Calculator Dropdown
    $( "#stregnthCalculatorDropdownBtn" ).click(function() {
      $( "#stregnthCalculatorDropdown" ).slideToggle( "fast", function() {
        // Animation complete.
      });
    });
    //Ajax script for strength calculator
    $(document).ready(function() {
      $("#stregthCalculatorButton").click(function() {
        var strengthCalculatorWeight = $("#strengthCalculatorWeight").val();
        var strengthCalculatorUnit = $("select#strengthCalculatorUnit option:checked").val();
        var strengthCalculatorReps = $("#strengthCalculatorReps").val();
        $("#stregnthCalculatorDropdown").load("/includes/indexIncludes/strengthCalculator.ajax.inc.php", {
          weight: strengthCalculatorWeight,
          unit: strengthCalculatorUnit,
          reps: strengthCalculatorReps
        });
      });
    });

    function calcToggle() {
       var x = document.getElementById("calcToggle");
       if (x.innerHTML === "arrow_drop_down") {
         x.innerHTML = "arrow_drop_up";
       } else {
         x.innerHTML = "arrow_drop_down";
       }
     }

    //Rep input max number for strength calculator
    $(function () {
      $( "#strengthCalculatorReps" ).change(function() {
         var max = parseInt($(this).attr('max'));
         var min = parseInt($(this).attr('min'));
         if ($(this).val() > max)
         {
             $(this).val(max);
         }
         else if ($(this).val() < min)
         {
             $(this).val(min);
         }
       });
   });

   //Bench Calculator Area
   //Toggle Dropdown Area
   $( "#benchCalculatorDropdownBtn" ).click(function() {
     $( "#benchCalculatorDropdown" ).slideToggle( "fast", function() {
       // Animation complete.
     });
   });

   function benchToggle() {
      var x = document.getElementById("benchToggle");
      if (x.innerHTML === "arrow_drop_down") {
        x.innerHTML = "arrow_drop_up";
      } else {
        x.innerHTML = "arrow_drop_down";
      }
    }

   //Ajax Area
   $(document).ready(function() {
     $("#benchCalculatorButton").click(function() {
       var benchWeight = $("#benchWeight").val();
       var benchBodyweight = $("#benchBodyweight").val();
       var benchGender = $("select#benchGender option:checked").val();
       var benchUnit = $("select#benchUnit option:checked").val();
       var benchAge = $("select#benchAge option:checked").val();
       $("#benchCalculatorDropdown").load("/includes/indexIncludes/benchCalculator.ajax.inc.php", {
         weight: benchWeight,
         userBodyweight: benchBodyweight,
         gender: benchGender,
         unit: benchUnit,
         age: benchAge
       });
     });
   });

   //Deadlift Calculator Area
   //Toggle Dropdown Area
   $( "#deadliftCalculatorDropdownBtn" ).click(function() {
     $( "#deadliftCalculatorDropdown" ).slideToggle( "fast", function() {
       // Animation complete.
     });
   });

   function deadliftToggle() {
      var x = document.getElementById("deadliftToggle");
      if (x.innerHTML === "arrow_drop_down") {
        x.innerHTML = "arrow_drop_up";
      } else {
        x.innerHTML = "arrow_drop_down";
      }
    }

   //Ajax Area
   $(document).ready(function() {
     $("#deadliftCalculatorButton").click(function() {
       var deadliftWeight = $("#deadliftWeight").val();
       var deadliftBodyweight = $("#deadliftBodyweight").val();
       var deadliftGender = $("select#deadliftGender option:checked").val();
       var deadliftUnit = $("select#deadliftUnit option:checked").val();
       var deadliftAge = $("select#deadliftAge option:checked").val();
       $("#deadliftCalculatorDropdown").load("/includes/indexIncludes/deadliftCalculator.ajax.inc.php", {
         weight: deadliftWeight,
         userBodyweight: deadliftBodyweight,
         gender: deadliftGender,
         unit: deadliftUnit,
         age: deadliftAge
       });
     });
   });

   //Squat Calculator Area
   //Toggle Dropdown Area
   $( "#squatCalculatorDropdownBtn" ).click(function() {
     $( "#squatCalculatorDropdown" ).slideToggle( "fast", function() {
       // Animation complete.
     });
   });

   function squatToggle() {
      var x = document.getElementById("squatToggle");
      if (x.innerHTML === "arrow_drop_down") {
        x.innerHTML = "arrow_drop_up";
      } else {
        x.innerHTML = "arrow_drop_down";
      }
    }

   //Ajax Area
   $(document).ready(function() {
     $("#squatCalculatorButton").click(function() {
       var squatWeight = $("#squatWeight").val();
       var squatBodyweight = $("#squatBodyweight").val();
       var squatGender = $("select#squatGender option:checked").val();
       var squatUnit = $("select#squatUnit option:checked").val();
       var squatAge = $("select#squatAge option:checked").val();
       $("#squatCalculatorDropdown").load("/includes/indexIncludes/squatCalculator.ajax.inc.php", {
         weight: squatWeight,
         userBodyweight: squatBodyweight,
         gender: squatGender,
         unit: squatUnit,
         age: squatAge
       });
     });
   });

   //Military Press Calculator Area
   //Toggle Dropdown Area
   $( "#militarypressCalculatorDropdownBtn" ).click(function() {
     $( "#militarypressCalculatorDropdown" ).slideToggle( "fast", function() {
       // Animation complete.
     });
   });

   function militarypressToggle() {
      var x = document.getElementById("militarypressToggle");
      if (x.innerHTML === "arrow_drop_down") {
        x.innerHTML = "arrow_drop_up";
      } else {
        x.innerHTML = "arrow_drop_down";
      }
    }

   //Ajax Area
   $(document).ready(function() {
     $("#militarypressCalculatorButton").click(function() {
       var militarypressWeight = $("#militarypressWeight").val();
       var militarypressBodyweight = $("#militarypressBodyweight").val();
       var militarypressGender = $("select#militarypressGender option:checked").val();
       var militarypressUnit = $("select#militarypressUnit option:checked").val();
       var militarypressAge = $("select#militarypressAge option:checked").val();
       $("#militarypressCalculatorDropdown").load("/includes/indexIncludes/militarypressCalculator.ajax.inc.php", {
         weight: militarypressWeight,
         userBodyweight: militarypressBodyweight,
         gender: militarypressGender,
         unit: militarypressUnit,
         age: militarypressAge
       });
     });
   });
  </script>
