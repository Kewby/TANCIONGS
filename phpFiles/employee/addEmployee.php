<?php

	include_once ('..\connection.php');   

	//$employee_id = $_GET['firstname'];
	$employee_firstname = $_GET['firstname'];
	$employee_lastname = $_GET['lastname'];
	$employee_username = $_GET['username'];
	$employee_password = $_GET['password'];
	$employee_email = $_GET['email'];
	$employee_contactnumber = $_GET['contactNumber'];
	$employee_tinNumber = $_GET['tinNumber'];
	$employee_philHealth = $_GET['philHealth'];
	$employee_sssNumber = $_GET['sssNumber'];
	$employee_address = $_GET['address'];

	$conn = getConnection();


$query = "INSERT INTO `employee` (`employee_id`, `employee_firstname`, `employee_lastname`, `employee_username`, `employee_password`, `employee_email`, `employee_contactnumber`, `employee_tinNumber`, `employee_philHealth`, `employee_sssNumber`, `employee_address`, `branch_id`, `role_id`, `deleteStatus`)

		VALUES ('', '".$employee_firstname."', '".$employee_lastname."', '".$employee_username."', '".$employee_password."', '".$employee_email."', '".$employee_contactnumber."', '".$employee_tinNumber."', '".$employee_philHealth."', '".$employee_sssNumber."', '".$employee_address."', '1', '2', '0')";
			

	echo $query;

	$result = mysqli_query($conn, $query) or die ("ERROR" .mysqli_error($conn));
    
    echo $result;

	?>