<?php

	include_once ('..\connection.php'); 
	
	$product_code = $_GET['productCode'];
	$delivery_quantity = $_GET['quantity'];
	$supplier_id = $_GET['supplier'];
	$dateDelivered = $_GET['dateDelivered'];
	$expiry_date = $_GET['expiryDate'];
	$employee_id = $_GET['receivedBy'];
	// $product_name = $_GET['productName'];

	$conn = getConnection();

	$query = "INSERT INTO `delivery` (`delivery_id`, `dateDelivered`, `product_id`, `product_code`,`product_name`, `delivery_quantity`,`supplier_id`, `expiry_date`, `employee_id`)
		VALUES ('', '".$dateDelivered."', (SELECT `product_id` FROM `product` WHERE product.product_code = '".$product_code."' LIMIT 1),'".$product_code."', (SELECT `product_name` FROM `product` WHERE product.product_code='".$product_code."' LIMIT 1), '".$delivery_quantity."', (SELECT `supplier_id` FROM `supplier` WHERE supplier.supplier_name = '".$supplier_id."' LIMIT 1),'".$expiry_date."', (SELECT `employee_id` FROM `employee` WHERE employee.employee_id = '".$employee_id."' LIMIT 1))";

	echo $query;
		$result = mysqli_query($conn, $query) or die ("ERROR" .mysqli_error($conn));
    echo $result; 

?>