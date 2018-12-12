<!-- 
addChangeFund: asks for the "CHANGE FUND" the start of the  day  

SALES TABLE
-->

<?php

	include_once ('..\connection.php');

	//$sales_id = $_GET['sales_id'];
	date_default_timezone_set("Singapore");
	$sales_datetime = date('y-m-d h:i:sa');
	$employee_id = $_GET['empID'];
	//$role_id = $_GET['roleID'];
	$changefund = $_GET['changefund'];
	//$total_sales = $_GET['total_sales'];


	$conn = getConnection();


	$query = "INSERT INTO `sales` (`sales_id`, `sales_datetime`, `employee_id`, `changefund`)
		VALUES (' ', '".$sales_datetime."', (SELECT employee.employee_id FROM `employee` WHERE employee.employee_id = '".$employee_id."'), '".$changefund."')";
			
	echo $query;
	$result = mysqli_query($conn, $query) or die ("ERROR" .mysqli_error($conn));
    echo $result;

	?>