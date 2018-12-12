<!-- 
checkDateAndFund: checks if the changefund was already inputted for the day by employee ID  

SALES TABLE
-->

<?php

	include_once ('..\connection.php');

	$sales_id = $_GET['sales_id'];
	date_default_timezone_set("Singapore");
	$sales_datetime = date('y-m-d h:i:sa');
	$employee_id = $_GET['empID'];
	$changefund = $_GET['changefund'];
	$total_sales = $_GET['total_sales'];


	$conn = getConnection();


	$query = "SELECT COUNT(*) AS 'TOTAL' FROM `sales` WHERE DATE_FORMAT(sales_datetime, '%y-%m-%d') = DATE_FORMAT('".$sales_datetime."', '%y-%m-%d')"
               + "AND changefund=0 AND employee_id='".$employee_id."')";
			
	echo $query;
	$result = mysqli_query($conn, $query) or die ("ERROR" .mysqli_error($conn));
    echo $result;

	?>