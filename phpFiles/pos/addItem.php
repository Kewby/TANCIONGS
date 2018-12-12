<!-- 
addItem: adds the data from the cart to the transactionItem table

TRANSACTION ITEM TABLE
-->

<?php

	include_once ('..\connection.php');   

	//$transactionItem_id = $_GET['transactionItemId']
	$transaction_id = $_GET['transID'];
	$product_id = $_GET['prodID'];
	//$product_code = $_GET['productCode'];
	$transactionItem_qty = $_GET['transQty'];
	$transactionItem_unitprice = $_GET['unitprice'];
	$transactionItem_subtotal = $_GET['subtotal'];
	var_dump($transactionItem_qty);


	$conn = getConnection();


	$query = "INSERT INTO `transactionitem` (`transactionItem_id`, `transaction_id`, `product_id`, `transactionItem_qty`, `transactionItem_unitprice`, `transactionItem_subtotal`)
		VALUES (' ', (SELECT transaction.transaction_id FROM `transaction` WHERE transaction.transaction_id = '".$transaction_id."'), (SELECT product.product_id FROM `product` WHERE product.product_id = '".$product_id."'), '".$transactionItem_qty."', '".$transactionItem_unitprice."', '".$transactionItem_subtotal."')";
			

	echo $query;

	$result = mysqli_query($conn, $query) or die ("ERROR" .mysqli_error($conn));
    echo $result;
	var_dump($result);

	$query2 = "UPDATE `stock` SET stock_onhand = stock_onhand - $transactionItem_qty WHERE product_code = (select product_code FROM `product` WHERE product_id = $product_id LIMIT 1)";

	echo $query2;

	$result = mysqli_query($conn, $query2) or die ("ERROR" .mysqli_error($conn));
	var_dump($result);
    echo $result;
?>