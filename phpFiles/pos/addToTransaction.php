<!--
addToTransaction: adds the data from the receive payment form to the transaction table. Includes: total, change and tender

TRANSACTION TABLE
-->


<?php

	include_once ('..\connection.php');

	//$transaction_id = $_GET['transaction_id'];
	date_default_timezone_set("Singapore");
	$transaction_datetime = date('y-m-d h:ia');
	$employee_id = $_GET['empID'];
	$transaction_grandtotal = $_GET['totalPurchase'];
	$transaction_tender = $_GET['totalTender'];
	$transaction_change = $_GET['totalChange'];


	$conn = getConnection();


	$query = "INSERT INTO `transaction` (`transaction_id`, `transaction_datetime`, `transaction_tender`,`transaction_change`, `employee_id`, `transaction_grandtotal`) 
	VALUES (' ', '".$transaction_datetime."' , '".$transaction_tender."', '".$transaction_change."', (SELECT employee.employee_id FROM `employee` WHERE employee.employee_id = '".$employee_id."'), '".$transaction_grandtotal."')";

			
	echo $query;
	$result = mysqli_query($conn, $query) or die ("ERROR" .mysqli_error($conn));
    echo $result;

	?>