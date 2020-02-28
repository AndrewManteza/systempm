<!-- VERSION 1.2 DB CONNECTION -->

<?php

	require_once('functions.php');

	class connectdb
	{	
		public $currentuser;
		public $db;
		function __construct($username,$password,$database)
		{
			$user=$username;
			$pass=$password;
			$this->db=$database;
$this->currentuser='';

			$this->db = new mysqli('localhost',$user,$pass,$this->db) or die("unable to connect");
			if ($this->db->connect_error) 
			{
				die("connection failed; ".$db-> connect_error);
			}
		}
		function setUsername($username){
			$this->currentuser=$username;
		}
		function loginAccount($dbname,$username,$password)
		{
			$s= "SELECT id FROM $dbname WHERE username='$username' AND password='$password'";
			$result=mysqli_query($this->db,$s);
			$num=mysqli_num_rows($result);
			
		//	$id=mysqli_fetch_assoc($result);
			return $num;
		}
		
		function checkAllPregnancies($dbname)
		{
			$s= "SELECT patient_caseno FROM $dbname";
			$result=mysqli_query($this->db,$s);
			$num=mysqli_num_rows($result);
			

			
		//	$id=mysqli_fetch_assoc($result);
			return $num;
		}
		function checkAccountIfExist($dbname,$username)
		{
			$s= "SELECT id FROM $dbname WHERE username='$username'";
			$result=mysqli_query($this->db,$s);
			$num=mysqli_num_rows($result);
			return $num;
		}
		function checkSchedIfExist($dbname,$set_Schedule,$setSchedule_time)
		{
			$s= "SELECT id FROM $dbname WHERE 
				
               
				
				schedule_time='$setSchedule_time'
				AND
				set_Schedule='$setSchedule'


			";
			$result=mysqli_query($this->db,$s);
			$num=mysqli_num_rows($result);
			return $num;
		}
		function checkAccounttoLogin()
		{

		}
		function checkAccountIfExistAdd($dbname,$first_name,$middle_name,$last_name)
		{
			$s= "SELECT schedule_table FROM $dbname WHERE username='$first_name' AND patient_mname='$middle_name'AND patient_lname='$last_name'";
			$result=mysqli_query($this->db,$s);
			$num=mysqli_num_rows($result);
			return $num;
		}
		function insertAddPatient($dbname,$patient_First_name,$patient_Last_name,$set_Schedule,$setSchedule_time)
		{
			$s= "INSERT INTO $dbname (`patient_First_name`, `patient_Last_name`,`set_Schedule`, `schedule_time`) VALUES ('$patient_First_name','$patient_Last_name','$set_Schedule','$setSchedule_time',')";
			
			
if (mysqli_query($this->db, $s)) {
    return "New record created successfully";
} else {
    return "Error: " . $s . "<br>" . mysqli_error($this->db);
}


		}


		function resultRowAsArray($dbname,$id){


			$value=[];

			$sql="SELECT * FROM $dbname WHERE account_id=$id";
			$result=mysqli_query($this->db,$sql);
			$counter=0;
			while ($row = mysqli_fetch_row($result))
			{	
				for ($i=0; $i <count($row); $i++) { 
					$value[$counter][$i]=$row[$i];
				}
				$counter++;
			}
			
			return $value;
			
		}
 
		function insertData($dbname,$arrayInfo)
		{
			$colRow=explode("/",queryArranger($arrayInfo));
			$this->db->query(
			"INSERT INTO `$dbname` ($colRow[1]) VALUES 
			($colRow[0])");

		}

		function updatedataID($dbname,$data,$id)
		{	
			$values=queryArrangerForUpdate($data);

			 mysqli_query($this->db,("UPDATE `$dbname` SET
			 $values 
			 WHERE id=$id"));

		}
		function updatedataUSERNAME($dbname,$data,$username)
		{	
			$values=queryArrangerForUpdate($data);
			echo $values;
			 mysqli_query($this->db,("UPDATE `$dbname` SET
			 $values 
			 WHERE username='$username'"));

		}
		function deleteData($dbname,$id)
		{	
			 mysqli_query($this->db,("DELETE FROM `$dbname` WHERE id=$id"));
				
		}

    }
         
		
?>