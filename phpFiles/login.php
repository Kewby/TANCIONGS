<?php

	include_once ('connection.php');   

	$username = $_GET['username'];
	$password = $_GET['password'];

	$conn = getConnection();

	$query = "SELECT employee_id ,employee_username, employee_password, role_id, deleteStatus FROM `employee` WHERE employee_username = '".$username."' AND employee_password = '".$password."' LIMIT 1";

	if($result=mysqli_query($conn, $query)){

		$fp = fopen('login.json', 'w'); 
		fwrite($fp, '{"data":[');

		while ($r = mysqli_fetch_assoc($result)) {

			$rows['employee_username'] = $r['employee_username'];
			$rows['employee_password'] = $r['employee_password'];
			$rows['employee_id'] = $r['employee_id'];
			$rows['role_id'] = $r['role_id'];
			$rows['deleteStatus'] = $r['deleteStatus'];
			

			fwrite($fp, json_encode($rows));
			fwrite($fp, "]}");
			fclose($fp);
		}

	}
echo $query;
?>