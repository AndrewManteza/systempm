<!DOCTYPE html>
<?php
require_once('class/connectdb.php');
require_once('class/functions.php'); 
require_once('server.php');

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;
    $record = mysqli_query($db, "SELECT * FROM schedule_Table WHERE id=$id");

    if (count($record) == 1 ) {
        $n = mysqli_fetch_array($record);
        
        $patient_First_name =$n['patient_First_name'];
        $patient_Middle_name = $n['patient_Middle_name'];
        $patient_Last_name = $n['patient_Last_name'];
        $patient_Age = $n['patient_Age'];
        $patient_Contact = $n['patient_Contact'];
        $patient_Email = $n['patient_Email'];
    }
}

?>
<html>
<head>
	<title>CRUD: CReate, Update, Delete PHP MySQL</title>
</head>
<style>
body {
    font-size: 19px;
}
table{
    width: 50%;
    margin: 30px auto;
    border-collapse: collapse;
    text-align: left;
}
tr {
    border-bottom: 1px solid #cbcbcb;
}
th, td{
    border: none;
    height: 30px;
    padding: 2px;
}
tr:hover {
    background: #F5F5F5;
}

form {
    width: 45%;
    margin: 50px auto;
    text-align: left;
    padding: 20px; 
    border: 1px solid #bbbbbb; 
    border-radius: 5px;
}

.input-group {
    margin: 10px 0px 10px 0px;
}
.input-group label {
    display: block;
    text-align: left;
    margin: 3px;
}
.input-group input {
    height: 30px;
    width: 93%;
    padding: 5px 10px;
    font-size: 16px;
    border-radius: 5px;
    border: 1px solid gray;
}
.btn {
    padding: 10px;
    font-size: 15px;
    color: white;
    background: #5F9EA0;
    border: none;
    border-radius: 5px;
}
.edit_btn {
    text-decoration: none;
    padding: 2px 5px;
    background: #2E8B57;
    color: white;
    border-radius: 3px;
}

.del_btn {
    text-decoration: none;
    padding: 2px 5px;
    color: white;
    border-radius: 3px;
    background: #800000;
}
.msg {
    margin: 30px auto; 
    padding: 10px; 
    border-radius: 5px; 
    color: #3c763d; 
    background: #dff0d8; 
    border: 1px solid #3c763d;
    width: 50%;
    text-align: center;
}
</style>
<?php 
	
	$db = mysqli_connect('localhost', 'root', '', 'account');

	
	$id = 0;
	$update = false;

	if (isset($_POST['save'])) {
	
        $patient_First_name=$_POST['patient_First_name'];
        $patient_Middle_name=$_POST['patient_Middle_name'];
        $patient_Last_name=$_POST['patient_Last_name'];
        $patient_Age=$_POST['patient_Age'];
        $patient_Contact=$_POST['patient_Contact'];
        $patient_Email=$_POST['patient_Email'];
        
        $connect->insertData('schedule_table',
        array("patient_First_name"=>$patient_First_name,
        "patient_Middle_name"=>$patient_Middle_name,
        "patient_Last_name"=>$patient_Last_name,
        "patient_Age"=>$patient_Age, 
        "patient_Contact"=>$patient_Contact,
        "patient_Email"=>$patient_Email	));
        
		$_SESSION['message'] = "Address saved"; 
		header('location: extranewpatientlist.php');
    }
    ?>
<body>
<?php if (isset($_SESSION['message'])): ?>
	<div class="msg">
		<?php 
			echo $_SESSION['message']; 
			unset($_SESSION['message']);
		?>
	</div>
<?php endif ?>

<?php $results = mysqli_query($db, "SELECT * FROM schedule_Table"); ?>

<table>
	<thead>
		<tr>
			<th>First Name</th>
            <th>Middle Name</th>
            <th>Last Name</th>
            <th>Age</th>
            <th>Contact No.</th>
            <th>Email</th>
			
			<th colspan="2">Action</th>

		</tr>

	</thead>
    <form action="extranewpatientlist.php" method="post">
            <input type="text" name="valueToSearch" placeholder="Value To Search"><br><br>
            <input type="submit" name="search" value="Filter"><br><br>
            <input type="submit" name="reset" value="Reset"><br><br>
           
            <?php 

if(isset($_POST['search']))
{
  $valueToSearch = $_POST['valueToSearch'];
  // search in all table columns
  // using concat mysql function
  $query = "SELECT * FROM `schedule_table` WHERE
   CONCAT(`patient_First_name`, `patient_Middle_name`, `patient_Last_name`,
    `patient_Age`,`patient_Contact`,`patient_Email`) 
  LIKE '%".$valueToSearch."%'";
  $search_result = filterTable($query);
  
}
 else if (isset($_POST['reset'])) {
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

?>


	
	<?php while ($row = mysqli_fetch_array($results)) { ?>
		<tr>
			<td><?php echo $row['patient_First_name']; ?></td>
			<td><?php echo $row['patient_Middle_name']; ?></td>
            <td><?php echo $row['patient_Last_name']; ?></td>
            <td><?php echo $row['patient_Age']; ?></td>
            <td><?php echo $row['patient_Contact']; ?></td>
            <td><?php echo $row['patient_Email']; ?></td>

			<td>
				<a href="extranewpatientlist.php?edit=<?php echo $row['id']; ?>" class="edit_btn" >Edit</a>
			</td>
			<td>
				<a href="extranewpatientlist.php?del=<?php echo $row['id']; ?>" class="del_btn">Delete</a>
			</td>
		</tr>
	<?php } ?>
</table>

<form>

<?php



?>

	<form method="post" action="extranewpatientlist.php" >
    <div class="input-group">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
		<div class="input-group">
			<label>First Name</label>
			<input type="text" name="patient_First_name" value="<?php echo $patient_First_name;?>">
		</div>
		<div class="input-group">
			<label>Middle Name</label>
			<input type="text" name="patient_Middle_name" value="<?php echo $patient_Middle_name;?>">
		</div>
	
        <div class="input-group">
			<label>Last Name</label>
			<input type="text" name="patient_Last_name" value="<?php echo $patient_Last_name; ?>">
		</div>
        <div class="input-group">
			<label>Age</label>
			<input type="text" name="patient_Age" value="<?php echo $patient_Age; ?>">
		</div>
        <div class="input-group">
			<label>Contact no.</label>
			<input type="text" name="patient_Contact" value="<?php echo $patient_Contact; ?>">
		</div>
        <div class="input-group">
			<label>Email</label>
			<input type="text" name="patient_Email" value="<?php echo $patient_Email; ?>">
		</div>

      
       
    
		<?php if ($update == true): ?>
	<button class="btn" type="submit" name="update" style="background: #556B2F;" >update</button>
<?php else: ?>
	<button class="btn" type="submit" name="save" >Save</button>
<?php endif ?>
		</div>
	</form>
</body>
<?php 
    
  

    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $patient_First_name =['patient_First_name'];
        $patient_Middle_name = ['patient_Middle_name'];
        $patient_Last_name = ['patient_Last_name'];
        $patient_Age = ['patient_Age'];
        $patient_Contact = ['patient_Contact'];
        $patient_Email = ['patient_Email'];
    
        mysqli_query($db, "UPDATE schedule_table SET patient_First_name='$patient_First_name',
     patient_Middle_name='$patient_Middle_name',patient_Last_name='$patient_Last_name',patient_Age='$patient_Age',
     
     ,patient_Contact='$patient_Contact',patient_Email='$patient_Email', WHERE id=$id");




        $_SESSION['message'] = "Address updated!"; 
        header('location: extranewpatientlist.php');
    }
    if (isset($_GET['del'])) {
        $id = $_GET['del'];
        mysqli_query($db, "DELETE FROM schedule_table WHERE id=$id");
        $_SESSION['message'] = "patient deleted!"; 
       
    }
?>
</html>