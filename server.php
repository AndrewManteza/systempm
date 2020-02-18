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

		

		if ($check==1) 
		{
			//echo "already exist";
			//this doesnt work correctly still has dupes
			$_SESSION['fail']='set';
			header('location: register.php');
		}
		else
		{
			;
			
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
			header('location: home.php');
		}
		else
		{

			// I cant seem to get this to work fucking hell
			$_SESSION['fail']='set';
			header('location: login.php');
			
		}
	}


//booking


	if (isset($_POST['schedule_appointment'])) 
	{
		$patient_First_name=$_POST['patient_First_name'];
		$patient_Last_name=$_POST['patient_Last_name'];
		$setSchedule=$_POST['set_Schedule'];
		$setSchedule_time=$_POST['schedule_time'];


		$check=$connect->checkPatientIfExist('schedule_table',$patient_First_name,$patient_Last_name,$setSchedule_time);

		if ($check==1) {

			$_SESSION['success']='set';

		$connect->insertData('schedule_table',array("patient_First_name"=>$patient_First_name,
		"patient_Last_name"=>$patient_Last_name,"set_Schedule"=>$setSchedule, 
		"schedule_time"=>$setSchedule_time));
		}
	    else {

			$_SESSION['fail3']='set';
			header('location: booking.php');
		}


	}


	









?>