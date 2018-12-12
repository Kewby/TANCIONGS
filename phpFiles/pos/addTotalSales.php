<?php

include_once ('..\connection.php');
include_once ('checkDateAndFund.php');

count = checkDateAndFund(empID);

if(count == 0){
    $query = "INSERT INTO `sales`(`sales_id`, `sales_datetime`, `employee_id`, `total_sales`)
    VALUES ('', '".$sales_datetime.'", '".$employee_id."', '".$total_sales.')"; 

    echo $query;
    $result = mysqli_query($conn, $query) or die ("ERROR" .mysqli_error($conn));
    echo $result;
} else {
    $query =  "UPDATE `sales` SET `total_sales` = '"+totalSales+"' WHERE employee_id='"+id+"'AND "
                    + "DATE_FORMAT(sales_datetime, '%y-%m-%d') = DATE_FORMAT(CURRENT_TIMESTAMP, '%y-%m-%d')";
}




?>