<?php 

  include_once ('..\connection.php'); 

  $conn = getConnection(); 

  $query = "SELECT product_code AS 'Product Code' , 
            (SELECT `product_name` FROM `product` WHERE product.product_code = stock.product_code) AS 'Product Name', stock_onhand AS 'Stock Onhand', (SELECT branch.branch_name FROM `branch` WHERE stock.branch_id = branch.branch_id) AS 'Branch' FROM `stock`";

    if($result=mysqli_query($conn,$query)){

      $fp = fopen('viewStock.json', 'w');
      fwrite($fp, '{"data":[');

    while ($r=mysqli_fetch_assoc($result)) {
      $rows['product_code'] = $r['Product Code'];
      $rows['product_name'] = $r['Product Name'];
      $rows['stock_onhand'] = $r['Stock Onhand'];
      $rows['branch_id'] = $r['Branch'];
      
      fwrite($fp, json_encode($rows));
    }

    fwrite($fp, "]}");
    fclose($fp);

  }
?>