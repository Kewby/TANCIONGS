<?php

	include_once ('..\connection.php');   
	
	$employee_id = $_GET['empID'];
	$employee_firstname = $_GET['employeeFirstname'];
	$employee_lastname = $_GET['employeeLastname'];
	$employee_username = $_GET['employeeUsername'];
	$employee_password = $_GET['employeePassword'];
	$employee_email = $_GET['employeeEmail'];
	$employee_contactnumber = $_GET['employeeNumber'];
	$employee_tinNumber = $_GET['employeeTin'];
	$employee_philHealth = $_GET['employeePhilhealth'];
	$employee_sssNumber = $_GET['employeeSSS'];
	$employee_address = $_GET['employeeAddress'];


	$conn = getConnection();
	

	$query = "UPDATE `employee` SET employee_firstname='".$employee_firstname."', 
			employee_lastname='".$employee_lastname."', 
			employee_username='".$employee_username."', 
			employee_password='".$employee_password."', 
			employee_username='".$employee_username."',
			employee_email='".$employee_email."', 
			employee_contactnumber='".$employee_contactnumber."', 
			employee_tinNumber='".$employee_tinNumber."', 
			employee_philHealth='".$employee_philHealth."', 
			employee_sssNumber='".$employee_sssNumber."', 
			employee_address='".$employee_address."'
			WHERE employee_id = '".$employee_id."'";
			
			
		echo $query;

		$result = mysqli_query($conn, $query) or die ("ERROR" .mysqli_error($conn));
    	echo $result;

	?>