<?php

	include_once ('..\connection.php');   


	$query = "SELECT category_name FROM `category`";

	$conn = getConnection();


	if($result=mysqli_query($conn, $query)){

		$fp =  fopen('category.json', 'w'); 
		fwrite($fp, '{"data":[');

		while ($r = mysqli_fetch_assoc($result)) {
		//	$rows['category_id'] = $r['category_id'];
			$rows['category_name'] = $r['category_name'];
		//	$rows['description'] = $r['description'];

			fwrite($fp, json_encode($rows));
		}

		fwrite($fp, "]}");
		fclose($fp);
	}


	?>