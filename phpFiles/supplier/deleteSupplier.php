<?php

  include_once ('..\connection.php');   

  $supplier_id = $_GET['suppID'];

  $conn = getConnection();


  $query = "UPDATE `supplier` SET deleteStatus = 1 WHERE supplier_id = '".$supplier_id."'";
      

  echo $query;

  $result = mysqli_query($conn, $query) or die ("ERROR" .mysqli_error($conn));
    echo $result;

  ?>