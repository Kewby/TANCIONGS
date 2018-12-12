<?php
	
	include_once ('..\connection.php');   

	$conn = getConnection();
	
	$query = " SELECT product_code AS 'Product Code', 
product_name AS 'Product Name', 
(CASE WHEN product_type = 'true' THEN 'Non-Agricultural' ELSE 'Agricultural' END) AS'Product Type', 
standard_cost AS 'Standard Cost',
markup AS 'Markup',
list_price AS 'List Price',
(SELECT stock.stock_onhand FROM `stock` WHERE product.product_code = stock.product_code) AS 'Stock Onhand', 
restockCount AS 'Restock Count' ,
(SELECT category.category_name FROM `category` WHERE product.category_id = category.category_id) AS 'Category' ,
(SELECT branch.branch_name FROM branch WHERE product.branch_id = branch.branch_id) AS 'Branch' FROM `product` WHERE deleteStatus = 0";


	if($result=mysqli_query($conn, $query)){

		$fp = fopen('viewProduct.json', 'w'); 
		fwrite($fp, '{"data":[');

		while ($r = mysqli_fetch_assoc($result)){
			$rows['product_code'] = $r['Product Code'];
			$rows['product_name'] = $r['Product Name'];
			$rows['product_type'] = $r['Product Type'];
			$rows['standard_cost'] = $r['Standard Cost'];
			$rows['markup'] = $r['Markup'];
			$rows['list_price'] = $r['List Price'];
			$rows['stock_onhand'] = $r['Stock Onhand'];
			$rows['restockCount'] = $r['Restock Count'];
			$rows['category_id'] = $r['Category'];
			$rows['branch_id'] = $r['Branch'];

			fwrite($fp, json_encode($rows));
		}

		fwrite($fp, "]}");
		fclose($fp);
	}


?>