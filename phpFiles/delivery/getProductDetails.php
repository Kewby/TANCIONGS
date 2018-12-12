<?php

	include_once ('..\connection.php');   


	$conn = getConnection();

	$product_code = $_GET['productCode'];

	$query = "SELECT product_name FROM `product` WHERE product.product_code = '".$product_code."'";


	if($result=mysqli_query($conn, $query)){

		$fp =  fopen('getProductDetails.json', 'w'); 
		fwrite($fp, '{"data":[');

		while ($r = mysqli_fetch_assoc($result)) {

			$rows['product_name'] = $r['product_name'];
			// $rows['product_type'] = $r['Product Type'];
			// $rows['category'] = $r['Category'];
			// $rows['standard_cost'] = $r['Standard Cost'];
			// $rows['markup'] = $r['Markup'];
			// $rows['restockCount'] = $r['Restock Count'];

			fwrite($fp, json_encode($rows));
		}

		fwrite($fp, "]}");
		fclose($fp);
	}


	?>