<?php

	require_once('connectdb.php');





	function queryArranger($data)
	{	

		$assignColumn="";
		$assignRow="";
		$counterValue=0;

		foreach ($data as $column => $value) 
		{
			$assignColumn.="`".$column."`";
			$assignRow.="'".$value."'";
			if ($counterValue+1!=count($data))
			{
				$assignColumn.=",";
				$assignRow.=",";
				$counterValue++;
			}
		
		}
		
		return $assignRow.'/'.$assignColumn;
	}

	function queryArrangerForUpdate($data)
	{	

		$assignLeft="";
		$counterValue=0;

		foreach ($data as $column => $value) 
		{	
			$assignLeft.="`".$column."`";
			$assignLeft.=" = '".$value."'";	
			if ($counterValue+1!=count($data)) {
				$assignLeft.=",";
				$counterValue++;
			}
		
		}
		
		return $assignLeft;
	}
	

	function maxDate($arr)
	{	

		$withDBConnection= new connectdb();
		$dates=[];

		for ($i=0; $i <count($arr) ; $i++) 
		{ 
			$check[$i]="SELECT product_bakeTime FROM product WHERE id=$arr[$i]";
			$result[$i]= mysqli_query($withDBConnection->db,$check[$i]);
			$row = mysqli_fetch_assoc($result[$i]);
			$dates[$i]= $row['product_bakeTime'];
		}
		return max($dates);
	}

	function dateAnalyzer($book,$maxDate)
	{
		$dateValidate= new validate();
		$time=$book;
		$timeOfBaked=$maxDate;
		$explodeDateBook=explode('-', $time);
		$toSaveInDB=dateValidatorAndEstimator(
			$explodeDateBook[0],
			$explodeDateBook[1],
			$explodeDateBook[2],
			$timeOfBaked
		);
		
		$explodeRecieveDate=explode('-', $toSaveInDB);
		$updatedYear=$explodeRecieveDate[0];
		$updateMonth=$explodeRecieveDate[1];
		$updateDay=$explodeRecieveDate[2];

		switch ($updateMonth) 
		{
				case '12':
					echo 'Your order will be recieve in December '.$updateDay.', '.$updatedYear.' Thank you For Ordering. ';
					break;
				case '11':
					echo 'Your order will be recieve in November '.$updateDay.', '.$updatedYear.' Thank you For Ordering. ';
					break;	
				case '10':
					echo 'Your order will be recieve in October '.$updateDay.', '.$updatedYear.' Thank you For Ordering. ';
					break;
				case '09':
					echo 'Your order will be recieve in September '.$updateDay.', '.$updatedYear.' Thank you For Ordering. ';
					break;
				case '08':
					echo 'Your order will be recieve in August '.$updateDay.', '.$updatedYear.' Thank you For Ordering. ';
					# code...
					break;	
				case '07':
					echo 'Your order will be recieve in July '.$updateDay.', '.$updatedYear.' Thank you For Ordering. ';
					break;
				case '06':
					echo 'Your order will be recieve in June '.$updateDay.', '.$updatedYear.' Thank you For Ordering. ';
					break;
				case '05':
					echo 'Your order will be recieve in May '.$updateDay.', '.$updatedYear.' Thank you For Ordering. ';
					break;	
				case '04':
					echo 'Your order will be recieve in April '.$updateDay.', '.$updatedYear.' Thank you For Ordering. ';
					break;
				case '03':
					echo 'Your order will be recieve in March '.$updateDay.', '.$updatedYear.' Thank you For Ordering. ';
					break;
				case '02':
					echo 'Your order will be recieve in Febuary '.$updateDay.', '.$updatedYear.' Thank you For Ordering. ';
					break;	
				case '01':
					echo 'Your order will be recieve in January '.$updateDay.', '.$updatedYear.' Thank you For Ordering. ';
					break;
				default:
					echo 'Unknown Error';
					break;
		};
		return $toSaveInDB;
			
	}

	function dateValidatorAndEstimator($updatedYear,$updateMonth,$updateDay,$timeOfBaked)
	{
  		$toSaveInDB;
  		if ($updateMonth=='01' || $updateMonth=='03' || 
  			$updateMonth=='05' || $updateMonth=='07' ||
  			$updateMonth=='08' || $updateMonth=='10' || 
  			$updateMonth=='12') 
			{
				if (($updateDay+$timeOfBaked)>31) 
				{
					if ($updateMonth==12 ) {
						$updateMonth=1;
						$updatedYear=1+$updatedYear;
					}
					else{
						$updatedYear=$updatedYear;
						$updateMonth=$updateMonth+1;
					}
					$toSaveInDB=$updatedYear.'-'.$updateMonth.'-'.(($updateDay+$timeOfBaked)-31);
					return $toSaveInDB;
			

				}
				else 
				{				
					$toSaveInDB=$updatedYear.'-'.$updateMonth.'-'.($updateDay+$timeOfBaked);
					return $toSaveInDB;
				}
			
			
	}
	else if ($updateMonth=='04' || $updateMonth=='06' || 
			 $updateMonth=='09' || $updateMonth=='11' ) 
	{
		if (($updateDay+$timeOfBaked)>30) 
		{
			$updatedYear=$updatedYear;
			$updateMonth=$updateMonth+1;
			$toSaveInDB=$updatedYear.'-'.$updateMonth.'-'.(($updateDay+$timeOfBaked)-30);
			return $toSaveInDB;
		}	
		else 
		{
		
		$toSaveInDB=$updatedYear.'-'.$updateMonth.'-'.($updateDay+$timeOfBaked);
		return $toSaveInDB;
			
		}	
	
	}
	else if ($updateMonth=='2' ) 
	{
	
		$actualDay;
		if ($updatedYear%4==0 || $updatedYear%100==0 && $updatedYear%400==0)
		{
			if (($updateDay+$timeOfBaked)>29) 
			{
				$updatedYear=$updatedYear;
				$updateMonth=$updateMonth+1;
				$actualDay=(($updateDay+$timeOfBaked)-29);
				$toSaveInDB=$updatedYear.'-'.$updateMonth.'-'.$actualDay;
				return $toSaveInDB;

				
			}
			else
			{	$updatedYear=$updatedYear;
				$updateMonth=$updateMonth;
				$actualDay=(($updateDay+$timeOfBaked));
				$toSaveInDB=$updatedYear.'-'.$updateMonth.'-'.$actualDay;
				return $toSaveInDB;
				
			}
				
		}
		else if ($updatedYear%4!=0 || $updatedYear%100!=0 && $updatedYear%400!=0) 
		{
			if ( ($updateDay+$timeOfBaked)>28) 
			{
				$updatedYear=$updatedYear;
				$updateMonth=$updateMonth+1;
				$actualDay=(($updateDay+$timeOfBaked)-28);
				$toSaveInDB=$updatedYear.'-'.$updateMonth.'-'.$actualDay;
				return $toSaveInDB;
	
			}
			else
			{	
				$updatedYear=$updatedYear;
				$updateMonth=$updateMonth;
				$actualDay=(($updateDay+$timeOfBaked));
				$toSaveInDB=$updatedYear.'-'.$updateMonth.'-'.$actualDay;
				return $toSaveInDB;
	
			}
		}
		
		
	}

  	}

		

?>