<?php

	require_once('../class/connectdb.php');
	require_once('../class/functions.php');
	$try1= new connectdb('root','','account');
	echo 'return$gfdbJSON$'.$try1->directCodeJSONFormat($_POST['sql']);
  
?>