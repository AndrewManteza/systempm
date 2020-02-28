<?php
require_once('class/connectdb.php');
require_once('class/functions.php');

if (isset($_POST['add_Patient'])) {
        $patient_First_name=$_POST['patient_First_name'];
		$patient_Middle_name=$_POST['patient_Middle_name'];
		$patient_Last_name=$_POST['patient_Last_name'];
		$patient_Age=$_POST['patient_Age'];
		$patient_Contact=$_POST['patient_Contact'];
		$patient_Email=$_POST['patient_Email'];
		
	
		$sql = "INSERT INTO `schedule_table`( `patient_First_name`, `patient_Middle_name`,`patient_Last_name`,`patient_Age`,`patient_Contact`,patient_Email``) 
		VALUES (' $patient_First_name','$patient_Middle_name','$patient_Last_name','$patient_Age','$patient_Contact','$patient_Email')";
		if (mysqli_query($db,$s)) {
            echo json_encode(array("statusCode"=>200));
            header('location: newpatientlist.php');
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		mysqli_close($conn);
	}

if(count($_POST)>0){
	if($_POST['type']==2){
        $patient_First_name=$_POST['patient_First_name'];
		$patient_Middle_name=$_POST['patient_Middle_name'];
		$patient_Last_name=$_POST['patient_Last_name'];
		$patient_Age=$_POST['patient_Age'];
		$patient_Contact=$_POST['patient_Contact'];
        $patient_Email=$_POST['patient_Email'];
        
		$sql = "UPDATE `schedule_table` SET `patient_First_name`='$patient_First_name',`patient_Middle_name`='$patient_Middle_name',
        `patient_Last_namee`='$patient_Last_name',`patient_Age`='$patient_Age',`patient_Contact`='$patient_Contact',`patient_Email`='$patient_Email' WHERE id=$id";

		if (mysqli_query($conn, $sql)) {
			echo json_encode(array("statusCode"=>200));
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		mysqli_close($conn);
	}
}
if(count($_POST)>0){
	if($_POST['type']==3){
		$id=$_POST['id'];
		$sql = "DELETE FROM `schedule_table` WHERE id=$id ";
		if (mysqli_query($conn, $sql)) {
			echo $id;
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		mysqli_close($conn);
	}
}
if(count($_POST)>0){
	if($_POST['type']==4){
		$id=$_POST['id'];
		$sql = "DELETE FROM schedule_table WHERE id in ($id)";
		if (mysqli_query($conn, $sql)) {
			echo $id;
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		mysqli_close($conn);
	}
}
?>