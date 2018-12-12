<?php

	include_once ('..\connection.php'); 

	// date_default_timezone_set("Singapore");
 //    $delivery_datetime = date('y-m-d h:i:sa');
	
	$product_code = $_GET['PDGProductCode'];
	$delivery_quantity = $_GET['PDGQuantity'];
	$supplier_id = $_GET['supplier'];
	$batch = $_GET['batch'];
	$dateDelivered = $_GET['dateDelivered'];
	$expiry_date = $_GET['expiryDate'];
	$employee_id = $_GET['receivedBy'];

	$conn = getConnection();

	$query = "INSERT INTO `delivery` (`delivery_id`, `dateDelivered`, `product_id`,`product_code`, `delivery_quantity`,`stock_id`, `supplier_id`, `batch`, `employee_id`,`expiry_date`)
		VALUES ('', '".$dateDelivered."' , (SELECT `product_id` FROM `product` WHERE product.product_code = '".$product_code."' LIMIT 1),'".$product_code."', '".$delivery_quantity."', (SELECT `stock_id` FROM `stock` WHERE stock.product_code = '".$product_code."' LIMIT 1) , (SELECT `supplier_id` FROM `supplier` WHERE supplier.supplier_name = '".$supplier_id."' LIMIT 1), '".$batch."', (SELECT `employee_id` FROM `employee` WHERE employee.employee_id = '".$employee_id."' LIMIT 1),'".$expiry_date."')";

	echo $query;
		$result = mysqli_query($conn, $query) or die ("ERROR" .mysqli_error($conn));
    echo $result; 

?>