<?php
session_start();

require_once('class/connectdb.php');
require_once('class/functions.php');


	$connect = new connectdb('root', '','account');

	//register

	if (isset($_POST['register_User'])) 
	{
		$username=$_POST['username'];
		$password=$_POST['password_1'];
		$confirmPassword=$_POST['confirmPassword'];

		if ($confirmPassword == $password){

			$check=$connect->checkAccountIfExist('account',$username);
				if ($check>0)
				{
					//echo "already exist";
					//this doesnt work correctly still has dupes
					$_SESSION['fail']='set';
					header('location: register.php');
				}
				else
				{
					
					echo 'inserted';
					$connect->insertData('account',array("username"=>$username,"password"=>$password));
					header('location: login.php');
					
				}
			}
		else 
		{
			$_SESSION['fail2']='set';
			header('location: register.php');
		
		}
	}
//login
/**function alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
} **/

	if (isset($_POST['login_User'])) 
	{
		$usernameLogin=$_POST['username'];
		$passwordLogin=$_POST['password_1'];

		$check=$connect->loginAccount('account',$usernameLogin, $passwordLogin);

		if ($check==1) 
		{
			header('location: scheduletable.php');
		}
		else
		{

			// I cant seem to get this to work fucking hell
			$_SESSION['fail']='set';
			header('location: login.php');
			
		}
	}


//booking

//I HAVE DUPLICATES!!!!!! FUUUUCCCKK



	if (isset($_POST['schedule_appointment'])) 
	{

		
		$Schedpatient_First_name=$_POST['Schedpatient_First_name'];
		$Schedpatient_Middle_name=$_POST['Schedpatient_Middle_name'];
		$Schedpatient_Last_name=$_POST['Schedpatient_Last_name'];
		$setSchedule=$_POST['set_Schedule'];
		$setSchedule_time=$_POST['schedule_time'];
		$patient_Payment=$_POST['patient_Payment'];
		$assigned_Therapist=$_POST['assigned_Therapist'];
	

		$check=$connect->checkSchedIfExist('patientsscheduled',$_POST['set_Schedule'],
		 $_POST['schedule_time']);

		 if ($check==1) {
		
		 
			
			 $_SESSION['failcheck']='set';
			 header('location: booking.php');
		 }
			//  else if ( $setSchedule < $d ){

			// 	$_SESSION['failcheck2']='set';
			// 	header('location: booking.php');
			//  }
		 

		 	else 
			{
				
				
				$connect->insertData('patientsscheduled',
				array("Schedpatient_First_name"=>$Schedpatient_First_name,
				"Schedpatient_Middle_name"=>$Schedpatient_Middle_name,
				"Schedpatient_Last_name"=>$Schedpatient_Last_name,
				"set_Schedule"=>$setSchedule, 
				"schedule_time"=>$setSchedule_time,
				"assigned_Therapist"=>$assigned_Therapist,
				"patient_Payment"=>$patient_Payment
			));
	
			
			header('location: booking.php');


			}
	}


	
		if (isset($_POST['add_Patient'])) {

			$patient_First_name=$_POST['patient_First_name'];
			$patient_Middle_name=$_POST['patient_Middle_name'];
			$patient_Last_name=$_POST['patient_Last_name'];
			$patient_Age=$_POST['patient_Age'];
			$patient_Contact=$_POST['patient_Contact'];
			$patient_Landcontact=$_POST['patient_Landcontact'];
			$patient_Email=$_POST['patient_Email'];
			$patient_Address=$_POST['patient_Address'];
			
	
			$connect->insertData('schedule_table',
			array("patient_First_name"=>$patient_First_name,
			"patient_Middle_name"=>$patient_Middle_name,
			"patient_Last_name"=>$patient_Last_name,
			"patient_Age"=>$patient_Age, 
			"patient_Contact"=>$patient_Contact,
			"patient_Landcontact"=>$patient_Landcontact,
			"patient_Email"=>$patient_Email,
			"patient_Address"=>$patient_Address,
			

			
		));
		header('location: patientlist.php');

	}



//update patient

$db = mysqli_connect('localhost', 'root', '', 'account');
if (isset($_POST['updatebutton'])) {
	$id = $_POST['id'];
	$Schedpatient_First_name=$_POST['Schedpatient_First_name'];
	$Schedpatient_Middle_name=$_POST['Schedpatient_Middle_name'];
	$Schedpatient_Last_name=$_POST['Schedpatient_Last_name'];
	$setSchedule=$_POST['set_Schedule'];
	$setSchedule_time=$_POST['schedule_time'];
	$patient_Payment=$_POST['patient_Payment'];
	$assigned_Therapist=$_POST['assigned_Therapist'];
	

	mysqli_query($db, "UPDATE patientsscheduled SET Schedpatient_First_name='$Schedpatient_First_name',
	Schedpatient_Middle_name='$Schedpatient_Middle_name',Schedpatient_Last_name='$Schedpatient_Last_name',set_Schedule='$set_Schedule',
	
	,schedule_time='$schedule_time',patient_Payment='$patient_Payment', assigned_Therapist='$assigned_Therapist',WHERE id=$id");
}


//  if (isset($_POST['Add_Session'])) {
// 	$id = $_POST['id'];
// 		$setSchedule2=$_POST['set_Schedule'];
//  	$setSchedule_time2=$_POST['schedule_time'];
// 	$patient_Payment2=$_POST['patient_Payment'];
// $assigned_Therapist2=$_POST['assigned_Therapist'];
	

// mysqli_query($db," INSERT INTO 'patientscheduled' set_Schedule"=>$setSchedule,
// 	"schedule_time"=>$schedule_time,"patient_Payment"=>$patient_Payment,"assigned_Therapist"=>$assigned_Therapist"));



// }


if (isset($_POST['Add_Session'])) 
{
	$Schedpatient_First_name=$_POST['Schedpatient_First_name'];
	$Schedpatient_Middle_name=$_POST['Schedpatient_Middle_name'];
	$Schedpatient_Last_name=$_POST['Schedpatient_Last_name'];
	$setSchedule=$_POST['set_Schedule'];
	$setSchedule_time=$_POST['schedule_time'];
	$patient_Payment=$_POST['patient_Payment'];
	$assigned_Therapist=$_POST['assigned_Therapist'];


	
			
			$connect->insertData('patientsscheduled',
			array("Schedpatient_First_name"=>$Schedpatient_First_name,
			"Schedpatient_Middle_name"=>$Schedpatient_Middle_name,
			"Schedpatient_Last_name"=>$Schedpatient_Last_name,
			"set_Schedule"=>$setSchedule, 
			"schedule_time"=>$setSchedule_time,
			"assigned_Therapist"=>$assigned_Therapist,
			"patient_Payment"=>$patient_Payment
		));

		
		header('location: patientlist.php');


		}


	?>





	




