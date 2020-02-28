



<DOCTYPE html>

<?php
require_once('class/connectdb.php');
require_once('class/functions.php'); 
require_once('server.php');
session_start();


?>


<html>

 <head>

   <title>Scheduled Patients</title>
   <meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
      </head>  
<style>
html,body,h1,h2,h3,h4,h5,h6 {font-family: "Roboto", sans-serif;}
.w3-sidebar {
  z-index: 3;
  width: 250px;
  top: 43px;
  bottom: 0;
  height: inherit;
  
}

</style>

 </head>

 <body>

<!-- Navbar -->
<div class="w3-top">
  <div class="w3-bar w3-theme w3-top w3-left-align w3-large">
    <a class="w3-bar-item w3-button w3-right w3-hide-large w3-hover-white w3-large w3-theme-l1" href="javascript:void(0)" onclick="w3_open()"><i class="fa fa-bars"></i></a>
    <a href="#" class="w3-bar-item w3-button w3-theme-l1">Logo</a>
    <a href="#" class="w3-bar-item w3-button w3-hide-small w3-hover-white">About</a>
    <a href="#" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Values</a>
    <a href="#" class="w3-bar-item w3-button w3-hide-small w3-hover-white">News</a>
    <a href="#" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Contact</a>
    <a href="#" class="w3-bar-item w3-button w3-hide-small w3-hide-medium w3-hover-white">Clients</a>
    <a href="#" class="w3-bar-item w3-button w3-hide-small w3-hide-medium w3-hover-white">Partners</a>
  </div>
</div>

<!-- Sidebar -->
<nav class="w3-sidebar w3-bar-block w3-collapse w3-large w3-theme-l5 w3-animate-left" id="mySidebar">
  <a href="javascript:void(0)" onclick="w3_close()" class="w3-right w3-xlarge w3-padding-large w3-hover-black w3-hide-large" title="Close Menu">
    <i class="fa fa-remove"></i>
  </a>
  <h4 class="w3-bar-item"><b>Menu</b></h4>
  <a class="w3-bar-item w3-button w3-hover-black" href="login.php">login</a>
  <a class="w3-bar-item w3-button w3-hover-black" href="register.php">register</a>
  <a class="w3-bar-item w3-button w3-hover-black" href="booking.php">booking</a>
  <a class="w3-bar-item w3-button w3-hover-black" href="schedules.php">schedules</a>
  <a class="w3-bar-item w3-button w3-hover-black" href="patientlist.php">patient list</a>
  <a class="w3-bar-item w3-button w3-hover-black" href="scheduletable.php">Scheduled patients list</a>
  <a class="w3-bar-item w3-button w3-hover-black" href="FinancialRecord.php">Financials</a>
</nav>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- Main content: shift it to the right by 250 pixels when the sidebar is visible -->
<div class="w3-main" style="margin-left:250px">

  <div class="w3-row w3-padding-64">
    <div class="w3-twothird w3-container">
    <div class="container">
   
           
  <h2 align= center>Scheduled Patient List</h2>
              
  <table class="table table-hover">
                <tr>
                   
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Last Name</th>
                    <th>Scheduled Date</th>
                    <th>Time</th>
                    <th>Payment</th>
                    <th>Assigned Therapist</th>
                </tr>
                <form action="scheduletable.php" method="post">
            <input type="text" name="valueToSearch" placeholder="Value To Search"><br><br>
            <input type="submit" name="search" value="Filter"><br><br>
            <input type="submit" name="reset" value="reset"><br><br>
      <!-- populate table from mysql database -->
                <?php 

                if(isset($_POST['search']))
                {
                  $valueToSearch = $_POST['valueToSearch'];
                  // search in all table columns
                  // using concat mysql function
                  $query = "SELECT * FROM `patientsscheduled` WHERE
                   CONCAT(`Schedpatient_First_name`, `Schedpatient_Middle_name`, `Schedpatient_Last_name`,
                    `set_Schedule`,`schedule_time`,`patient_Payment`,`assigned_Therapist`) 
                  LIKE '%".$valueToSearch."%'";
                  $search_result = filterTable($query);
                  
                }
                 else if (isset($_POST['reset'])) {
                  $query = "SELECT * FROM `patientsscheduled`";
                  $search_result = filterTable($query);
                }
                else {
                    $query = "SELECT * FROM `patientsscheduled`";
                    $search_result = filterTable($query);
                  }
                // function to connect and execute the query
                function filterTable($query)
                {
                  $connect = mysqli_connect("localhost", "root", "", "account");
                  $filter_Result = mysqli_query($connect, $query);
                  return $filter_Result;
                }
                
                //separate modals for each row

                while($row = mysqli_fetch_array($search_result)):?>
                <tr>
                    <td><?php echo $row['Schedpatient_First_name'];?></td>
                    <td><?php echo $row['Schedpatient_Middle_name'];?></td>
                    <td><?php echo $row['Schedpatient_Last_name'];?></td>
                    <td><?php echo $row['set_Schedule'];?></td>
                    <td><?php echo $row['schedule_time'];?></td>
                    <td><?php echo $row['patient_Payment'];?></td>
                    <td><?php echo $row['assigned_Therapist'];?></td>
                </tr>
                <?php endwhile;?>
                </table>
</div>
      </form>
        
   <div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">EDIT</h4>
      </div>
      <div class="modal-body">
        <p><input type="text" class="input-sm" id="txtfname"/></p>
        <p><input type="text" class="input-sm" id="txtmname"/></p>
        <p><input type="text" class="input-sm" id="txtlname"/></p>
        <p><input type="text" class="input-sm" id="txtage"/></p>
        <textarea id="w3mission" rows="4" cols="50">
        </textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


    </div>
   
  </div>

  </body>
<!-- END MAIN -->

<script>
//modal

$('table tbody tr  td').on('click',function(){
    $("#myModal").modal("show");
    $("#txtfname").val($(this).closest('tr').children()[0].textContent);
    $("#txtlname").val($(this).closest('tr').children()[1].textContent);
});


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
</script>

</body>
</html>