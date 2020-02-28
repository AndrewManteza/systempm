<?php

	require_once('../class/connectdb.php');
	require_once('../class/functions.php');


	$try1= new connectdb('root','','account');


	$try1->insertData('schedule_table',array(
			"patient_First_name"=>$_POST['data1'],
			"patient_Middle_name"=>$_POST['data2'],
			"patient_Last_name"=>$_POST['data3'],
			"patient_Age"=>$_POST['data4'],
			"patient_Contact"=>$_POST['data5'],
			"patient_Email"=>$_POST['data6']
			));



?>