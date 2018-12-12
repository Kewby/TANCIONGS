<?php 

  include_once ('..\connection.php'); 

  $employee_id = $_GET['empID'];
  $transaction_grandtotal = $_GET['grandTotal'];
  date_default_timezone_set("Singapore");
  $transaction_datetime = date('y-m-d h:i:sa');


  $query = "SELECT transaction_grandtotal FROM `transaction` WHERE employee_id = '".$employee_id."' AND transaction_datetime = '".$transaction_datetime."'";  


    if($result=mysqli_query($conn,$query)){

      $fp = fopen('computeTotalSales.json', 'w');
      fwrite($fp, '{"data":[');

    while ($r=mysqli_fetch_assoc($result)) {
      //$rows['transaction_id'] = $r['transaction_id'];
      $rows['transaction_datetime'] = $r['transaction_datetime']; 
      //$rows['transaction_tender'] = $r['transaction_tender']; 
      //$rows['transaction_change'] = $r['transaction_change']; 
      $rows['employee_id'] = $r['employee_id']; 
      $rows['transaction_grandtotal'] = $r['transaction_grandtotal']; 
      
      fwrite($fp, json_encode($rows));
    }

    fwrite($fp, "]}");
    fclose($fp);

  }
  
?>