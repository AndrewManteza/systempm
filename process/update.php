<?php

	require_once('../class/connectdb.php');
	require_once('../class/functions.php');
	$try1= new connectdb('root','','account');
	$try1->updatedataID('schedule_table',
		array(
			"patient_eval"=>$_POST['update']),$_POST['id']);

?>