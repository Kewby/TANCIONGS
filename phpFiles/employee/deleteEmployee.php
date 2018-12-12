<?php

	include_once ('..\connection.php');   

	$employee_id = $_GET['empID'];

	$conn = getConnection();
	

	$query = "UPDATE `employee` SET deleteStatus = 1 WHERE employee_id = '".$employee_id."'";

			
			
		echo $query;
		$result = mysqli_query($conn, $query) or die ("ERROR" .mysqli_error($conn));
    	echo $result;

	?>