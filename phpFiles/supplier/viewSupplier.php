<?php
	
	include_once ('..\connection.php'); 

	$conn = getConnection(); 

	$query = "SELECT supplier_id AS 'ID', 
			supplier_name AS 'SUPPLIER NAME', 
			supplier_address AS 'ADDRESS', 
			supplier_email AS 'EMAIL', 
			supplier_contactnumber AS 'CONTACT NUMBER', 
			supplier_contactperson AS 'CONTACT PERSON' 
			FROM `supplier` WHERE deleteStatus=0";

	if($result=mysqli_query($conn, $query)){

		$fp = fopen('viewSupplier.json', 'w'); 
		fwrite($fp, '{"data":[');

		while ($r = mysqli_fetch_assoc($result)) {
			$rows['supplier_id'] = $r['ID'];
			$rows['supplier_name'] = $r['SUPPLIER NAME'];
			$rows['supplier_address'] = $r['ADDRESS'];
			$rows['supplier_email'] = $r['EMAIL'];
			$rows['supplier_contactnumber'] = $r['CONTACT NUMBER'];
			$rows['supplier_contactperson'] = $r['CONTACT PERSON'];

			fwrite($fp, json_encode($rows));
		}

		fwrite($fp, "]}");
		fclose($fp);
	}


	?>