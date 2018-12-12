<?php
	
	include_once ('..\connection.php');   

	$conn = getConnection();

	$query = "SELECT employee_id AS 'ID', employee_firstname AS 'FIRST NAME',  employee_lastname AS 'LAST NAME', employee_username AS 'USERNAME',
		employee_email AS 'EMAIL',  employee_contactnumber AS 'CONTACT NO', 
		employee_address AS 'ADDRESS', employee_tinNumber as 'TIN NO',
		employee_philHealth AS 'PHILHEALTH', employee_sssNumber AS 'SSS', 
		(CASE WHEN branch_id = '1' THEN 'Cebu Branch' ELSE 'Leyte Branch' END) AS 'BRANCH ASSIGNED' FROM `employee` WHERE role_id=2 AND deleteStatus=0";

	if($result=mysqli_query($conn, $query)){

		$fp = fopen('viewEmployee.json', 'w'); 
		fwrite($fp, '{"data":[');

		while ($r = mysqli_fetch_assoc($result)) {
			$rows['employee_id'] = $r['ID'];
			$rows['employee_firstname'] = $r['FIRST NAME'];
			$rows['employee_lastname'] = $r['LAST NAME'];
			$rows['employee_username'] = $r['USERNAME'];
			$rows['employee_email'] = $r['EMAIL'];
			$rows['employee_contactnumber'] = $r['CONTACT NO'];
			$rows['employee_address'] = $r['ADDRESS'];
			$rows['employee_tinNumber'] = $r['TIN NO'];
			$rows['employee_philHealth'] = $r['PHILHEALTH'];
			$rows['employee_sssNumber'] = $r['SSS'];		
			$rows['branch_id'] = $r['BRANCH ASSIGNED'];

			
			fwrite($fp, json_encode($rows));
		}

		fwrite($fp, "]}");
		fclose($fp);
	}

	?>