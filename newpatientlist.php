<?php
include 'class/connectdb.php';
require 'save.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>User Data</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="ajax/ajax.js"></script>
</head>
<body>
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
  <a class="w3-bar-item w3-button w3-hover-black" href="chart.php">chart</a>
</nav>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>
    <div class="container">
	<p id="success"></p>
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
						<h2>Manage <b>Users</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons"></i> <span>Add New User</span></a>
						<a href="JavaScript:void(0);" class="btn btn-danger" id="delete_multiple"><i class="material-icons"></i> <span>Delete</span></a>						
					</div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
						<th>
							<span class="custom-checkbox">
								<input type="checkbox" id="selectAll">
								<label for="selectAll"></label>
							</span>
						</th>
                        <th>ID</th>
						<th>First Name</th>
                        <th>Middle Name</th>
                        <th>Last Name</th>
						<th>Age</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <form action="save.php" method="post">
           
                    </tr>
                </thead>
				<tbody>
				
<?php

				$try= new connectdb('root','','account');
				$result = mysqli_query($try->db,"SELECT * FROM schedule_table");
					$i=1;
					while($row = mysqli_fetch_array($result)) {
				?>
				<tr id="<?php echo $row["id"]; ?>">
				<td>
							<span class="custom-checkbox">
								<input type="checkbox" class="user_checkbox" data-user-id="<?php echo $row["id"]; ?>">
								<label for="checkbox2"></label>
							</span>


                            
						</td>




					<td><?php echo $i; ?></td>
                    <td><?php echo $row["id"]; ?></td>
					<td><?php echo $row["patient_First_name"]; ?></td>
					<td><?php echo $row["patient_Middle_name"]; ?></td>
					<td><?php echo $row["patient_Last_name"]; ?></td>
					<td><?php echo $row["patient_Age"]; ?></td>
                    <td><?php echo $row["patient_Contact"]; ?></td>
                    <td><?php echo $row["patient_Email"]; ?></td>

                
					<td>
						<a href="#editEmployeeModal" class="edit" data-toggle="modal">
							<i class="material-icons update" data-toggle="tooltip" 
							data-id="<?php echo $row["id"]; ?>"
							patient_First_name="<?php echo $row["patient_First_name"]; ?>"
							patient_Middle_name="<?php echo $row["patient_Middle_name"]; ?>"
							patient_Last_name="<?php echo $row["patient_Last_name"]; ?>"
							patient_Age="<?php echo $row["patient_Age"]; ?>"
                            patient_Contact="<?php echo $row["patient_Contact"]; ?>"
                            patient_Email="<?php echo $row["patient_Email"]; ?>"
							title="Edit"></i>
						</a>
						<a href="?id=<?php echo $row["id"]; ?>" class="delete" data-id="<?php echo $row["id"]; ?>" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" 
						 title="Delete"></i></a>
                    </td>
				</tr>
				<?php
				$i++;
				}
				?>
				</tbody>
			</table>
			
        </div>
    </div>
	<!-- Add Modal HTML -->
	<div id="addEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="user_form" action="save.php">">
					<div class="modal-header">						
						<h4 class="modal-title">Add User</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">	
                   				
						<div class="form-group">
							<label>First Name</label>
							<input type="text" id="patientFirstname" name="patient_First_name" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Middle Name</label>
							<input type="text" id="patientMiddlename" name="patient_Middle_name" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Last Name</label>
							<input type="text" id="patientLastname" name="patient_Last_name" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Age</label>
							<input type="text" id="patientAge" name="patient_Age" class="form-control" required>
						</div>		
                        <div class="form-group">
							<label>Contact</label>
							<input type="text" id="patientContact" name="patient_Contact" class="form-control" required>
						</div>	
                        <div class="form-group">
							<label>	Email</label>
							<input type="email" id="patientEmail" name="patient_Email" class="form-control" required>
						</div>	

					</div>
					<div class="modal-footer">
					    <input type="hidden" value="1" name="type">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        
						<button type="submit" class="btn btn-success" id="add_Patient">Add</button>
					</div>

				</form>
			</div>
		</div>
	</div>
	<!-- Edit Modal HTML -->
	<div id="editEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="update_form" action="server.php">
					<div class="modal-header">						
						<h4 class="modal-title">Edit Patient</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">
						<input type="hidden" id="id_u" name="id" class="form-control" required>					
						<div class="form-group">
							<label>First Name</label>
							<input type="text" id="fname_u" name="patient_First_name" class="form-control" required>
						</div>
                        <div class="form-group">
							<label>Middle Name</label>
							<input type="text" id="mname_u" name="patient_Middle_name" class="form-control" required>
						</div>
                        <div class="form-group">
							<label>Last Name</label>
							<input type="text" id="lname_u" name="patient_Last_name" class="form-control" required>
						</div>
                        <div class="form-group">
							<label>Age</label>
							<input type="text" id="age_u" name="patient_Age" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Contact</label>
							<input type="text" id="contact_u" name="patient_Contact" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Email</label>
							<input type="email" id="Email_u" name="patient_Email" class="form-control" required>
						</div>
								
					</div>
					<div class="modal-footer">
					<input type="hidden" value="2" name="type">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<button type="button" class="btn btn-info" id="update">Update</button>
					</div>
				</form>
			</div>
		</div>
	</div>

    <div id="deleteEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
						
					<div class="modal-header">						
						<h4 class="modal-title">Delete User</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">
						<input type="hidden" id="id_d" name="id" class="form-control">					
						<p>Are you sure you want to delete these Records?</p>
						<p class="text-warning"><small>This action cannot be undone.</small></p>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<button type="button" class="btn btn-danger" id="delete">Delete</button>
					</div>
				</form>
			</div>
		</div>
	</div>

</body>



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
</script>
</html>    


    
</script> -->