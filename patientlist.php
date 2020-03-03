



<DOCTYPE html>

<?php
require_once('class/connectdb.php');
require_once('class/functions.php'); 
require_once('server.php');

$db = mysqli_connect('localhost', 'root', '', 'account');

?>


<html>

 <head>

   <title>Patient List</title>
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
  <a class="w3-bar-item w3-button w3-hover-black" href="home.php">Home</a>
  <a class="w3-bar-item w3-button w3-hover-black" href="login.php">login</a>
  <a class="w3-bar-item w3-button w3-hover-black" href="register.php">register</a>
  <a class="w3-bar-item w3-button w3-hover-black" href="booking.php">booking</a>
  <a class="w3-bar-item w3-button w3-hover-black" href="schedules.php">schedules</a>
  <a class="w3-bar-item w3-button w3-hover-black" href="patientlist.php">patient list</a>
    <a class="w3-bar-item w3-button w3-theme-l1" href="newpatient.php">Add Patients</a>
  <a class="w3-bar-item w3-button w3-hover-black" href="scheduletable.php">Scheduled patients list</a>
  <a class="w3-bar-item w3-button w3-hover-black" href="FinancialRecord.php">Financial</a>
</nav>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- Main content: shift it to the right by 250 pixels when the sidebar is visible -->
<div class="w3-main" style="margin-left:250px">

  <div class="w3-row w3-padding-64">
    <div class="w3-twothird w3-container">
    <div class="container">
   
           
  <h2 align= center>Patient List</h2>
  <div class="col-sm-6">
					<!---	<a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons"></i> <span>Add Patients</span></a>-->
								
					</div>
  <table class="table table-hover">
                <tr>
                   
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Last Name</th>
                    <th>Age</th>
                    <th>Contact</th>
                    <th>Email</th>
                </tr>
                <form action="patientlist.php" method="post">
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
                  $query = "SELECT * FROM `schedule_table` WHERE
                   CONCAT(`patient_First_name`, `patient_Middle_name`, `patient_Last_name`, `patient_Age`,`patient_Contact`,`patient_Email`) 
                  LIKE '%".$valueToSearch."%'";
                  $search_result = filterTable($query);
                  
                }
                else if (isset($_POST['reset'])){
                  $query = "SELECT * FROM `schedule_table`";
                  $search_result = filterTable($query);
                }
                 else {
                  $query = "SELECT * FROM `schedule_table`";
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
                    <td><?php echo $row['patient_First_name'];?></td>
                    <td><?php echo $row['patient_Middle_name'];?></td>
                    <td><?php echo $row['patient_Last_name'];?></td>
                    <td><?php echo $row['patient_Age'];?></td>
                    <td><?php echo $row['patient_Contact'];?></td>
                    <td><?php echo $row['patient_Email'];?></td>
                    <td>
				<a href="patientlist.php?delpatient=<?php echo $row['id']; ?>" class="del_btn">Delete</a>
     <a href="#editEmployeeModal=<?php echo $row['id']; ?>" class="editpatient"  id = "editpatient" data-toggle="#editEmployeeModal">Add Session</a>
 
			</td>
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
        <h4 class="modal-title">Add Session</h4>
      </div>
      <div class="modal-body">
      <form action = "patientlist.php" method = "post">
      <label for = "Schedpatient_First_name"> Patient First Name:  </label>
<input type ="text" name= "Schedpatient_First_name" required><br>

<label for = "Schedpatient_Middle_name"> Patient Middle Name:  </label>
<input type ="text" name= "Schedpatient_Middle_name"><br>

<label for = "Schedpatient_Last_name"> Patient Last Name:  </label>
<input type ="text" name= "Schedpatient_Last_name" required><br>

      <label for = "assigned_Therapist2"> Assigned Therapist:  </label>
<input type ="text" name= "assigned_Therapist" ><br>

<label for = "patient_Payment2"> Payment:  </label>
<input type ="text" name= "patient_Payment" ><br>

<label for="set_Schedule"> Set Date: </label>
<input type ="date" name= "set_Schedule" ><br>


<label for="schedule_time">Choose a time for your meeting:</label>

<input type="time" id="schedule_time" name="schedule_time"
       min="09:00" max="16:00">


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-default" name ="Add_Session"data-dismiss="modal">Add Session</button>
      
      
      
      </div>
      <!-- <div class="modal-body">
      <form action = "patientlist.php" method = "post">
      		<input type="hidden" id="id_u" name="id" class="form-control" required>					
						<div class="form-group">
							<label>First Name</label>
							<input type="text" id="fname_u" name="newpatient_First_name" class="form-control" required>
						</div>
                        <div class="form-group">
							<label>Middle Name</label>
							<input type="text" id="mname_u" name="pnewatient_Middle_name" class="form-control" required>
						</div>
                        <div class="form-group">
							<label>Last Name</label>
							<input type="text" id="lname_u" name="newpatient_Last_name" class="form-control" required>
						</div>
                        <div class="form-group">
							<label>Age</label>
							<input type="text" id="age_u" name="newpatient_Age" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Contact</label>
							<input type="text" id="contact_u" name="newpatient_Contact" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Email</label>
							<input type="email" id="Email_u" name="newpatient_Email" class="form-control" required>
						</div>
            <div class="modal-footer">
            <button type="submit" class="btn btn-default" name = "editpatient"data-dismiss="modal">Edit Patient</button>
      </div>
							</div>	       -->
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->






    </div>
   
  </div>

  </body>

  

 

<!-- END MAIN -->
<?php 
$id = 0;
if (isset($_GET['delpatient'])) {
    $id = $_GET['delpatient'];
    mysqli_query($db, "DELETE FROM schedule_table WHERE id=$id");

   
}



if (isset($_GET['editpatient'])) {
  $id = $_GET['id'];
  mysqli_query('$db', "DELETE FROM schedule_table WHERE id='$id'");

  $Newpatient_First_name =$_POST['patient_newFirst_name'];
  $Newpatient_Middle_name = $_POST['patient_newMiddle_name'];
  $Newpatient_Last_name = $_POST['patient_newLast_name'];
  $Newpatient_Age = $_POST['patient_newAge'];
  $Newpatient_Contact = $_POST['patient_newContact'];
  $Newpatient_Email = $_POST['patient_newEmail'];

  mysqli_query($db, "UPDATE schedule_table SET patient_First_name='$newpatient_First_name',
patient_Middle_name='$newpatient_Middle_name',patient_Last_name='$newpatient_Last_name',patient_Age='$newpatient_Age',

,patient_Contact='$newpatient_Contact',patient_Email='$newpatient_Email', WHERE id=$id");




  $_SESSION['message'] = "Address updated!"; 
  header('location: patientlist.php');


}





?>

<script>
//modal

$('table tbody tr  td').on('click',function(){
    $("#myModal").modal("show");
  
    $("#txtfname").val($(this).closest('tr').children()[0].textContent);
    $("#txtlname").val($(this).closest('tr').children()[1].textContent);
});


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