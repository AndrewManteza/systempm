<?php

	

	require_once('../class/connectdb.php');
	require_once('../class/functions.php');


	$try1= new connectdb('root','','account');
	
	if (isset($_GET['delid'])) 
	{
		$try1->deleteData('schedule_table',$_GET['delid']);
		header('location: http://localhost/andrew/newpatientlist.php');
		
	}







?>