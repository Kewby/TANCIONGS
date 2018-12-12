	<?php

	include_once ('..\connection.php');

	$product_code = $_GET['productCode'];
	$delivery_quantity = $_GET['quantity'];
	
	$conn = getConnection();

	
	$prodquery = "SELECT * FROM `product` WHERE product_code = $product_code";
	$prodresult = mysqli_query($conn,$prodquery);
	$product = mysqli_fetch_array($prodresult);
	
	$stockquery = "SELECT * FROM `stock` WHERE stock.product_code = '".$product_code."'";
	$stockresult = mysqli_query($conn,$stockquery);

	if(mysqli_num_rows($stockresult)>0){
		$query = "UPDATE `stock` SET stock_onhand = stock_onhand + $delivery_quantity WHERE stock.product_code = '".$product_code."'";
	}else{
		$query = "INSERT INTO `stock` (`stock_id`, `product_code`, `stock_onhand`, `branch_id`) 
		VALUES ('', '".$product_code."', $delivery_quantity, 1)";
	}



	// function determineProduct($product_id,$conn){
	// 	$query = "SELECT product.product_id FROM `product` WHERE product.product_code = '".$product_id."'";
	// 	$product = mysqli_query($conn,$query);
	// 	return $product;
	// }

	// function determineProdStock($product_id,$conn){
	// 	$query = "SELECT * FROM `stock` WHERE stock.product_id = (SELECT product.product_id FROM `product` WHERE product.product_code = '".$product_id."' LIMIT 1)";
	// 	$prodstock = mysqli_query($conn,$query);
	// 	return $prodstock;
	// }



	// if($product['product_id'] == $stock['product_id']){

	// 	$query = "UPDATE `stock` SET stock_onhand = stock_onhand + '".$numberOfUnits."' WHERE (SELECT `stock_id` WHERE stock.product_id = (SELECT `product_id` FROM `product` WHERE product.product_code = '".$product_id."' LIMIT 1) LIMIT 1)";
	// } else{

	// 	$query = "INSERT INTO `stock` (`stock_id`, `product_id`, `stock_onhand`, `branch_id`, `deleteStatus`) 
	// 	VALUES (' ', (SELECT `product_id` FROM `product` WHERE product.product_code = '".$product_id."' LIMIT 1), '".$numberOfUnits."', '1', '0')";
	// }
	
	
	echo $query;
	$result = mysqli_query($conn, $query) or die ("ERROR" .mysqli_error($conn));
    echo $result; 
?>