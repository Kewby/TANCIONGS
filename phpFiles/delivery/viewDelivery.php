<?php 

  include_once ('..\connection.php'); 

  $conn = getConnection(); 

  $query = "SELECT delivery_id AS 'Delivery ID', 
            dateDelivered AS 'Date Delivered', 
            product_code AS 'Product Code' , 
            (SELECT `product_name` FROM `product` WHERE product.product_id = delivery.product_id) AS 'Product Name', 
            delivery_quantity AS 'Delivery Quantity',
           
            expiry_date AS 'Expiry Date',
            (SELECT `supplier_name` FROM `supplier` WHERE supplier.supplier_id = delivery.supplier_id) AS 'Supplier', 
            (SELECT employee.employee_username FROM `employee` 
            WHERE delivery.employee_id = employee.employee_id) AS 'Received By' FROM `delivery`";

    if($result=mysqli_query($conn,$query)){

      $fp = fopen('viewDelivery.json', 'w');
      fwrite($fp, '{"data":[');

    while ($r=mysqli_fetch_assoc($result)) {
      $rows['delivery_id'] = $r['Delivery ID'];
      $rows['dateDelivered'] = $r['Date Delivered'];
      $rows['product_code'] = $r['Product Code'];
      $rows['product_name'] = $r['Product Name'];
      $rows['delivery_quantity'] = $r['Delivery Quantity'];
      // $rows['batch_id'] = $r['Batch'];
      $rows['expiry_date'] = $r['Expiry Date'];
      $rows['supplier_name'] = $r['Supplier'];
      $rows['employee_username'] = $r['Received By'];
      
            
      
      fwrite($fp, json_encode($rows));
    }

    fwrite($fp, "]}");
    fclose($fp);

  }
?>