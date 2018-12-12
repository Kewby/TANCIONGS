<?php
    //session start();
    include_once ('..\connection.php');
    
    date_default_timezone_set("Singapore");
    $delivery_datetime = date('y-m-d h:i:sa');

    $conn = getConnection();

        $query = "SELECT `delivery_datetime` AS 'Date Delivered' , (SELECT product.product_name FROM `product` WHERE delivery.product_id = product.product_id) AS 'Product Name' , delivery_unitprice AS 'Unit Price' ,delivery_numberofunits AS 'Number of Units' ,delivery_unitofmeasure AS 'Unit of Measure' ,delivery_totalcostamount AS 'Total Purchase' , (SELECT supplier.supplier_name FROM `supplier` WHERE delivery.supplier_id = supplier.supplier_id) AS 'Supplier' , (SELECT branch.branch_name FROM `branch` WHERE delivery.branch_id = branch.branch_id) AS 'Branch Delivered' , (SELECT employee.username FROM `employee` WHERE delivery.employee_id = employee.employee_id) AS 'Received By' FROM `delivery` WHERE DATE_FORMAT(delivery_datetime, '%y-%m-%d') = DATE_FORMAT(CURRENT_TIMESTAMP, '%y-%m-%d')";


    if($result=mysqli_query($conn, $query)){

        $fp =  fopen('currentDelivery.json', 'w'); 
        fwrite($fp, '{"data":[');

        while ($r = mysqli_fetch_assoc($result)) {
            $rows['delivery_datetime'] = $r['Date Delivered'];
            $rows['product_id'] = $r['Product Name'];
            $rows['delivery_unitprice'] = $r['Unit Price'];
            $rows['delivery_numberofunits'] = $r['Number of Units'];
            $rows['delivery_unitofmeasure'] = $r['Unit of Measure'];
            $rows['delivery_totalcostamount'] = $r['Total Purchase'];
            $rows['supplier_id'] = $r['Supplier'];
            $rows['branch_id'] = $r['Branch Delivered'];
            $rows['employee_id'] = $r['Received By'];


            fwrite($fp, json_encode($rows));
        }

        fwrite($fp, "]}");
        fclose($fp);
    }


    ?>