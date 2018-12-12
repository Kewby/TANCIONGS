<?php

	include_once ('..\connection.php'); 
	
	$product_code = $_GET['productCode'];
	$delivery_quantity = $_GET['quantity'];
	$supplier_id = $_GET['supplier'];
	$dateDelivered = $_GET['dateDelivered'];
	$expiry_date = $_GET['expiryDate'];

	$conn = getConnection();

	$query = "INSERT INTO `batch` (`batch_id`, `product_code`, `stock_id`, `delivery_id`, `dateDelivered`, `delivery_quantity`, `expiry_date`, `supplier_id` )
		VALUES ('', '".$product_code."',(SELECT stock_id FROM `stock` WHERE stock.product_code = '".$product_code."' LIMIT 1), (SELECT delivery_id FROM `delivery` WHERE delivery.product_code = '".$product_code."' AND delivery.dateDelivered = '".$dateDelivered."' AND delivery.supplier_id = (SELECT `supplier_id` FROM `supplier` WHERE supplier.supplier_name = '".$supplier_id."' LIMIT 1) AND delivery.expiry_date = '".$expiry_date."'LIMIT 1), '".$dateDelivered."','".$delivery_quantity."','".$expiry_date."',(SELECT `supplier_id` FROM `supplier` WHERE supplier.supplier_name = '".$supplier_id."' LIMIT 1))";

	echo $query;
		$result = mysqli_query($conn, $query) or die ("ERROR" .mysqli_error($conn));
    echo $result; 

?>