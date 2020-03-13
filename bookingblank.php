



<DOCTYPE html>

<?php 
require_once('class/connectdb.php');
require_once('class/functions.php'); 
require_once('server.php');
?>


 <head>

   <title>Booking</title>

   <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 
<style>
html,body,h1,h2,h3,h4,h5,h6 {font-family: "Roboto", sans-serif;}
.w3-sidebar {
  z-index: 3;
  width: 250px;
  top: 43px;
  bottom: 0;
  height: inherit;
}
label {
    display: block;
    font: 1rem 'Fira Sans', sans-serif;
}

input,
label {
    margin: .4rem 0;
}

</style>

 
 
 </head>

   <body>
   <!-- Navbar -->


   <!-- Sidebar -->
<nav class="w3-sidebar w3-bar-block w3-collapse w3-large w3-theme-l5 w3-animate-left" id="mySidebar">
  <a href="javascript:vid(0)" onclick="w3_close()" class="w3-right w3-xlarge w3-padding-large w3-hover-black w3-hide-large" title="Close Menu">
    <i class="fa fa-remove"></i>
  </a>
  <h4 class="w3-bar-item"><b>Menu</b></h4>

  <a class="w3-bar-item w3-button w3-hover-black" href="login.php">login</a>
  <a class="w3-bar-item w3-button w3-hover-black" href="register.php">register</a>
  <a class="w3-bar-item w3-button w3-theme-l1" href="bookingblank.php">booking</a>

  <a class="w3-bar-item w3-button w3-hover-black" href="patientlist.php">patient list</a>
    <a class="w3-bar-item w3-button w3-hover-black" href="newpatient.php">Add Patients</a>
  <a class="w3-bar-item w3-button w3-hover-black" href="scheduletable.php">Scheduled patients list</a>
  
</nav>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>
  
  
  
   <div class="w3-main" style="margin-left:800px">

<div class="w3-row w3-padding-64">
  <div class="w3-twothird w3-container">
    <h1 class="w3-text-teal">BOOKING</h1>
   
  </div>
 
</div>
   

   <form action = "server.php" method = "post">

   <?php
      if(isset($_SESSION['failcheck']))
      {
        echo '<h1>Time is occupied</h1>';
        unset($_SESSION['failcheck']);
        if(isset($_SESSION['failcheck2']))
        {
          echo '<h1>Date is invalid</h1>';
          unset($_SESSION['failcheck']);
         
        }
      }

      ?>


      


<h1>Appointment Schedules</h1>

<label for = "Schedpatient_First_name"> Patient First Name:  </label>
<input type ="text" name= "Schedpatient_First_name"  required><br>

<label for = "Schedpatient_Middle_name"> Patient Middle Name:  </label>
<input type ="text" name= "Schedpatient_Middle_name"  ><br>

<label for = "Schedpatient_Last_name"> Patient Last Name:  </label>
<input type ="text" name= "Schedpatient_Last_name" required ><br>

<label for = "assigned_Therapist"> Assigned Therapist:  </label>
<input type ="list" name= "assigned_Therapist" required><br>


<label for="set_Schedule"> Set Date: </label>
<input type ="date" name= "set_Schedule"   required>
<br>


<label for="schedule_time">Choose a time for your meeting:</label>

<input type="time" id="schedule_time" name="schedule_time"
       min="09:00" max="16:00" required>

       <label for="patient_Payment"> Set Payment: </label>
<input type ="text" name= "patient_Payment" required><br>

       <button type = "submit" name = "schedule_appointment"> Book Appointment</button>


<small>Office hours are 9am to 5pm</small>




<!-- <?php
   // $idofpatient;
   // if (isset($_GET['id'])) 
  //  {
    //   $idofpatient = $_GET['id'];
//
   // }

 //  $values= $connect ->getIdlang( "SELECT patient_First_name, patient_Middle_name,
 //  patient_Last_name
   
  //  FROM schedule_table WHERE id = $idofpatient");
    
?>

<form action = "server.php?id=<?php// echo  $_GET['id']; ?>" method = "post">
      <label for = "newSchedpatient_First_name"> Patient First Name:  </label>
   
<input type ="text" name= "Schedpatient_First_name"  value="<?php //echo $values['Schedpatient_First_name'] ?>" ><br>

<label for = "newSchedpatient_Middle_name"> Patient Middle Name:  </label>
<input type ="text" name= "Schedpatient_Middle_name"  value="<?php //echo $values['Schedpatient_Middle_name'] ?>"><br>
<input type="hidden" name="idofacc" value="<?php //echo $idofpatient; ?>">

<label for = "newSchedpatient_Last_name"> Patient Last Name:  </label>
<input type ="text" name= "Schedpatient_Last_name"  value="<?php //echo $values['Schedpatient_Last_name'] ?>"  ><br>

<label for = "newassigned_Therapist"> Assigned Therapist:  </label>
<input type ="text" name= "assigned_Therapist" value="<?php //echo $values['assigned_Therapist'] ?>"><br>

<label for="newset_Schedule"> Set Date: </label>
<input type ="date" name= "set_Schedule" value="<?php //echo $values['set_Schedule'] ?>"><br>


<label for="newschedule_time">Choose a time for your meeting:</label>

<input type="time" id="schedule_time" name="schedule_time"
       min="09:00" max="16:00"  value="<?php //echo $values['schedule_time'] ?>">

       <label for="newpatient_Payment"> Set Payment: </label>
<input type ="text" name= "patient_Payment" value="<?php //echo $values['patient_Payment'] ?>"><br>

      
 <button type="submit" class="btn btn-primary" name = "schedule_appointment" data-dismiss>Save changes</button> -->

          <script> 

// Get the Sidebar
var mySidebar = document.getElementById("mySidebar");

// Get the DIV with overlay effect
var overlayBg = document.getElementById("myOverlay");

// Toggle between showing and hiding the sidebar, and add overlay effect
function w3_open() {
  if (mySidebar.style.display === 'block') {
    mySidebar.style.display = 'none';
    overlayBg.style.display = "none";
  } else {
    mySidebar.style.display = 'block';
    overlayBg.style.display = "block";
  }
}

// Close the sidebar with the close button
function w3_close() {
  mySidebar.style.display = "none";
  overlayBg.style.display = "none";
}

//var dateToday = new Date(2018, 11, 24);
</script>

     </body>

     </html>
