var days = [
    'sunday', //Sunday starts at 0
    'monday',
    'tuesday',
    'wednesday',
    'thursday',
    'friday',
    'saturday'
];

d = new Date(); //This returns Wed Apr 02 2014 17:28:55 GMT+0800 (Malay Peninsula Standard Time)
x = d.getDay(); //This returns a number, starting with 0 for Sunday

 if (days[x] === 'monday') {
   $(".mondayDropdown").slideToggle("slow") ;
   $('.mondayDropdownBtn').html('arrow_drop_up');
 }
 if (days[x] === 'tuesday') {
   $(".tuesdayDropdown").slideToggle( "slow") ;
   $('.tuesdayDropdownBtn').html('arrow_drop_up');
   $('html,body').animate({
       scrollTop: $("#tuesdayScrollTop").offset().top},
       'slow');
 }
 if (days[x] === 'wednesday') {
   $(".wednesdayDropdown").slideToggle( "slow") ;
   $('.wednesdayDropdownBtn').html('arrow_drop_up');
   $('html,body').animate({
       scrollTop: $("#wednesdayScrollTop").offset().top},
       'slow');
 }
 if (days[x] === 'thursday') {
   $(".thursdayDropdown").slideToggle( "slow") ;
   $('.thursdayDropdownBtn').html('arrow_drop_up');
   $('html,body').animate({
       scrollTop: $("#thursdayScrollTop").offset().top},
       'slow');
 }
 if (days[x] === 'friday') {
   $(".fridayDropdown").slideToggle( "slow") ;
   $('.fridayDropdownBtn').html('arrow_drop_up');
   $('html,body').animate({
       scrollTop: $("#fridayScrollTop").offset().top},
       'slow');
 }
 if (days[x] === 'saturday') {
   $(".saturdayDropdown").slideToggle( "slow") ;
   $('.saturdayDropdownBtn').html('arrow_drop_up');
   $('html,body').animate({
       scrollTop: $("#saturdayScrollTop").offset().top},
       'slow');
 }
 if (days[x] === 'sunday') {
   $(".sundayDropdown").slideToggle( "slow") ;
   $('.sundayDropdownBtn').html('arrow_drop_up');
   $('html,body').animate({
       scrollTop: $("#sundayScrollTop").offset().top},
       'slow');
 }

 //Monday
 $( "#mondayDropdownBtn" ).click(function() {
   $( "#mondayDropdown" ).slideToggle( "fast", function() {
     // Animation complete.
   });
 });
 //Ajax Area
 $(document).ready(function() {
   $("#mondayAjax").click(function() {
     var mondayPlan = $("#mondayPlan").val();
     var mondayExercise = $("#mondayExercise").val();
     var mondayReps = $("#mondayReps").val();
     var mondaySets = $("#mondaySets").val();
     $("#mondayDropdown").load("/includes/planExercises.ajax.inc.php", {
       exerciseday: mondayPlan,
       exerciseName: mondayExercise,
       exerciseReps: mondayReps,
       exerciseSets: mondaySets
     });
   });
 });
 function mondayToggle() {
    var x = document.getElementById("mondayToggle");
    if (x.innerHTML === "arrow_drop_down") {
      x.innerHTML = "arrow_drop_up";
    } else {
      x.innerHTML = "arrow_drop_down";
    }
  }


 //Tuesday
 $( "#tuesdayDropdownBtn" ).click(function() {
   $( "#tuesdayDropdown" ).slideToggle( "fast", function() {
     // Animation complete.
   });
 });
 //Ajax Area
 $(document).ready(function() {
   $("#tuesdayAjax").click(function() {
     var tuesdayPlan = $("#tuesdayPlan").val();
     var tuesdayExercise = $("#tuesdayExercise").val();
     var tuesdayReps = $("#tuesdayReps").val();
     var tuesdaySets = $("#tuesdaySets").val();
     $("#tuesdayDropdown").load("/includes/planExercises.ajax.inc.php", {
       exerciseday: tuesdayPlan,
       exerciseName: tuesdayExercise,
       exerciseReps: tuesdayReps,
       exerciseSets: tuesdaySets
     });
   });
 });
 function tuesdayToggle() {
    var x = document.getElementById("tuesdayToggle");
    if (x.innerHTML === "arrow_drop_down") {
      x.innerHTML = "arrow_drop_up";
    } else {
      x.innerHTML = "arrow_drop_down";
    }
  }


 //Wednesday
 $( "#wednesdayDropdownBtn" ).click(function() {
   $( "#wednesdayDropdown" ).slideToggle( "fast", function() {
     // Animation complete.
   });
 });
 //Ajax Area
 $(document).ready(function() {
   $("#wednesdayAjax").click(function() {
     var wednesdayPlan = $("#wednesdayPlan").val();
     var wednesdayExercise = $("#wednesdayExercise").val();
     var wednesdayReps = $("#wednesdayReps").val();
     var wednesdaySets = $("#wednesdaySets").val();
     $("#wednesdayDropdown").load("/includes/planExercises.ajax.inc.php", {
       exerciseday: wednesdayPlan,
       exerciseName: wednesdayExercise,
       exerciseReps: wednesdayReps,
       exerciseSets: wednesdaySets
     });
   });
 });
 function wednesdayToggle() {
    var x = document.getElementById("wednesdayToggle");
    if (x.innerHTML === "arrow_drop_down") {
      x.innerHTML = "arrow_drop_up";
    } else {
      x.innerHTML = "arrow_drop_down";
    }
  }


 //Thursday
 $( "#thursdayDropdownBtn" ).click(function() {
   $( "#thursdayDropdown" ).slideToggle( "fast", function() {
     // Animation complete.
   });
 });
 //Ajax Area
 $(document).ready(function() {
   $("#thursdayAjax").click(function() {
     var thursdayPlan = $("#thursdayPlan").val();
     var thursdayExercise = $("#thursdayExercise").val();
     var thursdayReps = $("#thursdayReps").val();
     var thursdaySets = $("#thursdaySets").val();
     $("#thursdayDropdown").load("/includes/planExercises.ajax.inc.php", {
       exerciseday: thursdayPlan,
       exerciseName: thursdayExercise,
       exerciseReps: thursdayReps,
       exerciseSets: thursdaySets
     });
   });
 });
 function thursdayToggle() {
    var x = document.getElementById("thursdayToggle");
    if (x.innerHTML === "arrow_drop_down") {
      x.innerHTML = "arrow_drop_up";
    } else {
      x.innerHTML = "arrow_drop_down";
    }
  }


 //Friday
 $( "#fridayDropdownBtn" ).click(function() {
   $( "#fridayDropdown" ).slideToggle( "fast", function() {
     // Animation complete.
   });
 });
 //Ajax Area
 $(document).ready(function() {
   $("#fridayAjax").click(function() {
     var fridayPlan = $("#fridayPlan").val();
     var fridayExercise = $("#fridayExercise").val();
     var fridayReps = $("#fridayReps").val();
     var fridaySets = $("#fridaySets").val();
     $("#fridayDropdown").load("/includes/planExercises.ajax.inc.php", {
       exerciseday: fridayPlan,
       exerciseName: fridayExercise,
       exerciseReps: fridayReps,
       exerciseSets: fridaySets
     });
   });
 });
 function fridayToggle() {
    var x = document.getElementById("fridayToggle");
    if (x.innerHTML === "arrow_drop_down") {
      x.innerHTML = "arrow_drop_up";
    } else {
      x.innerHTML = "arrow_drop_down";
    }
  }


 //Saturday
 $( "#saturdayDropdownBtn" ).click(function() {
   $( "#saturdayDropdown" ).slideToggle( "fast", function() {
     // Animation complete.
   });
 });
 //Ajax Area
 $(document).ready(function() {
   $("#saturdayAjax").click(function() {
     var saturdayPlan = $("#saturdayPlan").val();
     var saturdayExercise = $("#saturdayExercise").val();
     var saturdayReps = $("#saturdayReps").val();
     var saturdaySets = $("#saturdaySets").val();
     $("#saturdayDropdown").load("/includes/planExercises.ajax.inc.php", {
       exerciseday: saturdayPlan,
       exerciseName: saturdayExercise,
       exerciseReps: saturdayReps,
       exerciseSets: saturdaySets
     });
   });
 });
 function saturdayToggle() {
    var x = document.getElementById("saturdayToggle");
    if (x.innerHTML === "arrow_drop_down") {
      x.innerHTML = "arrow_drop_up";
    } else {
      x.innerHTML = "arrow_drop_down";
    }
  }


 //Sunday
 $( "#sundayDropdownBtn" ).click(function() {
   $( "#sundayDropdown" ).slideToggle( "fast", function() {
     // Animation complete.
   });
 });
 //Ajax Area
 $(document).ready(function() {
   $("#sundayAjax").click(function() {
     var sundayPlan = $("#sundayPlan").val();
     var sundayExercise = $("#sundayExercise").val();
     var sundayReps = $("#sundayReps").val();
     var sundaySets = $("#sundaySets").val();
     $("#sundayDropdown").load("/includes/planExercises.ajax.inc.php", {
       exerciseday: sundayPlan,
       exerciseName: sundayExercise,
       exerciseReps: sundayReps,
       exerciseSets: sundaySets
     });
   });
 });
 function sundayToggle() {
    var x = document.getElementById("sundayToggle");
    if (x.innerHTML === "arrow_drop_down") {
      x.innerHTML = "arrow_drop_up";
    } else {
      x.innerHTML = "arrow_drop_down";
    }
  }
