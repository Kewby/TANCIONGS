<?php

  include_once ('..\connection.php');   

  $product_code = $_GET['productCode'];

  $conn = getConnection();


  $query = "UPDATE `product` SET deleteStatus = 1 WHERE product_code = '".$product_code."'";
      

  echo $query;

  $result = mysqli_query($conn, $query) or die ("ERROR" .mysqli_error($conn));
    echo $result;

  ?>