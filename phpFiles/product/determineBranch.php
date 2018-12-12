<?php 

  include_once ('..\connection.php'); 

  $query = "SELECT branch_id FROM `employee` WHERE username = '".$username."' LIMIT 1";


    if($result=mysqli_query($conn,$query)){

      $fp = fopen('viewEmployee.json', 'w');
      fwrite($fp, '{"data":[');

    while ($r=mysqli_fetch_assoc($result)) {
      $rows['branch_id'] = $r['branch_id'];
      $rows['username'] = $r['username']; 
      
      fwrite($fp, json_encode($rows));
    }

    fwrite($fp, "]}");
    fclose($fp);

  }
?>