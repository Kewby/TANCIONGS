<?php

	include_once ('..\connection.php');   


	$query = "SELECT supplier_name FROM `supplier`";

	$conn = getConnection();


	if($result=mysqli_query($conn, $query)){

		$fp =  fopen('getSupplier.json', 'w'); 
		fwrite($fp, '{"data":[');

		while ($r = mysqli_fetch_assoc($result)) {

			$rows['supplier_name'] = $r['supplier_name'];

			fwrite($fp, json_encode($rows));
		}

		fwrite($fp, "]}");
		fclose($fp);
	}


	?>