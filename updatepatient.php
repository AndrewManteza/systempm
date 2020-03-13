



<DOCTYPE html>

<?php 
require_once('class/connectdb.php');
require_once('class/functions.php'); 
require_once('scheduletable.php');
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

</div>


   <!-- Sidebar -->
<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>
  

   <div class="w3-main" style="margin-left:800px">

<div class="w3-row w3-padding-64">
  <div class="w3-twothird w3-container">
  
   
  </div>
 
</div>
   

   

<h1>Update Patient</h1>
<?php
    $idofpatient;
    if (isset($_GET['id'])) 
    {
       $idofpatient = $_GET['id'];

    }

   $values= $connect ->getIdlang( "SELECT * FROM patientsscheduled WHERE id = $idofpatient");
    
?>

<form action = "updatepatient.php?id=<?php echo  $_GET['id']; ?>" method = "post">
      <label for = "newSchedpatient_First_name"> Patient First Name:  </label>
   
<input type ="text" name= "newSchedpatient_First_name"  value="<?php echo $values['Schedpatient_First_name'] ?>" ><br>

<label for = "newSchedpatient_Middle_name"> Patient Middle Name:  </label>
<input type ="text" name= "newSchedpatient_Middle_name"  value="<?php echo $values['Schedpatient_Middle_name'] ?>"><br>
<input type="hidden" name="idofacc" value="<?php echo $idofpatient; ?>">

<label for = "newSchedpatient_Last_name"> Patient Last Name:  </label>
<input type ="text" name= "newSchedpatient_Last_name"  value="<?php echo $values['Schedpatient_Last_name'] ?>"  ><br>

<label for = "newassigned_Therapist"> Assigned Therapist:  </label>
<input type ="text" name= "newassigned_Therapist" value="<?php echo $values['assigned_Therapist'] ?>"><br>

<label for="newset_Schedule"> Set Date: </label>
<input type ="date" name= "newset_Schedule" value="<?php echo $values['set_Schedule'] ?>"><br>


<label for="newschedule_time">Choose a time for your meeting:</label>

<input type="time" id="schedule_time" name="newschedule_time"
       min="09:00" max="16:00"  value="<?php echo $values['schedule_time'] ?>">

       <label for="newpatient_Payment"> Set Payment: </label>
<input type ="text" name= "newpatient_Payment" value="<?php echo $values['patient_Payment'] ?>"><br>

      
 <button type="submit" class="btn btn-primary" name = "updatebutton" data-dismiss>Save changes</button>

<?php

if (isset($_POST['updatebutton'])) 
{
      $newSchedpatient_First_name=$_POST['newSchedpatient_First_name'];
      $newSchedpatient_Middle_name=$_POST['newSchedpatient_Middle_name'];
      $newSchedpatient_Last_name=$_POST['newSchedpatient_Last_name'];
      $newset_Schedule=$_POST['newset_Schedule'];
      $newschedule_time=$_POST['newschedule_time'];
      $newpatient_Payment=$_POST['newpatient_Payment'];
      $newassigned_Therapist=$_POST['newassigned_Therapist'];
      
      $connect->updatedataID( 'patientsscheduled', 
      array("Schedpatient_First_name"=>$newSchedpatient_First_name,
        "Schedpatient_Middle_name"=>$newSchedpatient_Middle_name,"Schedpatient_Last_name" =>$newSchedpatient_Last_name,"set_Schedule"=>$newset_Schedule
      ,"schedule_time"=>$newschedule_time,"patient_Payment"=>$newpatient_Payment, "assigned_Therapist"=>$newassigned_Therapist), $_POST['idofacc']);
    
        
    }
?>
          <script> 

// Get the Sidebar
//var mySidebar = document.getElementById("mySidebar");

// Get the DIV with overlay effect
//var overlayBg = document.getElementById("myOverlay");

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
</script>

     </body>

     </html>
