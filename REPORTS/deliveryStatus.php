<!--shows delivery Report available status)-->
<?php require_once('connection.php'); session_start();?>

<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="report.css">
  <link rel="icon" href="favicon.ico" type="image" sizes="16x16">
</head>
<body>

<center>


<div class="container-fluid1">
<div class= "choices">
<img class="img1" src="pic.png">


<div class="btn-group">
  <a class="btn dropdown-toggle" data-toggle="dropdown">
   Products
    <span class="caret"></span>
  </a>
  <ul class="dropdown-menu">
   <li><a href="productMasterList.php"> Product Master List</a></li>
   <li><a href="stockStatusReport.php">Stock Status Report</a></li>
   <li><a href="categoryList.php">Category List</a></li>
   <li><a href="priceList.php">Price List</a></li>
   
  </ul>
</div>

<div class="btn-group">
  <a class="btn dropdown-toggle" data-toggle="dropdown">
    Sales
    <span class="caret"></span>
  </a>
  <ul class="dropdown-menu">
    <li><a href="salesReport.php">Sales Report</a></li>
   <li><a href="salesByProduct.php">Sales By Product</a></li>
   <li><a href="tenderReport.php">Tender Report</a></li>
   
   
  </ul>
</div>

<div class="btn-group">
  <a class="btn dropdown-toggle" data-toggle="dropdown">
   Delivery
    <span class="caret"></span>
  </a>
  <ul class="dropdown-menu">
   <li><a href="deliveryReport1.php"> Delivery Report</a></li>
  
   
  </ul>
</div>

<div class="btn-group">
  <a class="btn dropdown-toggle" data-toggle="dropdown">
   Supplier
    <span class="caret"></span>
  </a>
  <ul class="dropdown-menu">
   <li><a href="supplierMasterList.php"> Supplier  Master List</a></li>
  
   
  </ul>
</div>


<div class="btn-group">
  <a class="btn dropdown-toggle" data-toggle="dropdown">
 Branch
    <span class="caret"></span>
  </a>
  <ul class="dropdown-menu">
   <li><a href="branchList.php"> Store Branch List</a></li>
  
   
  </ul>
</div>

<div class="btn-group">
  <a class="btn dropdown-toggle" data-toggle="dropdown">
   Employee
    <span class="caret"></span>
  </a>
  <ul class="dropdown-menu">
   <li><a href="employeeList.php"> Employee Master List</a></li>
  
   
  </ul>
</div>

<div class="btn-group">
  <a class="button" href="deliveryPrint1.php"  target="_blank" ><span class="glyphicon glyphicon-print"> Print</span>
 
  </a>
  
  </ul>
</div>
</div>

<div class="btn-group">
  <a class="btn dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-search"> Filter By Status:</span>
    <span class="caret"></span>
  </a>
  <ul class="dropdown-menu">
   <li><a href="deliveryAvailable.php">Available</a></li>
    <li><a href="deliveryPhaseout.php">Phaseout</a></li>

  
   
  </ul>
</div>


      
<div class="container">
<?php
$sum_sales = 0;

                    //Include config file

                    require_once 'connection.php'; ?>
                    <br><br><br>

                    <?php

                       $sql = "SELECT  delivery.delivery_id, delivery.delivery_datetime, product.product_id, product.product_name, product.product_type, delivery.delivery_unitprice, delivery.delivery_numberofunits, delivery.delivery_unitofmeasure, delivery.delivery_totalcostamount, supplier.supplier_id, supplier.supplier_name, branch.branch_id, branch.branch_name, employee.employee_id, employee.employee_firstname, delivery.deleteStatus,

                    CASE WHEN delivery.deleteStatus = 1 THEN 'Phaseout' ELSE 'Available' END AS deleteStatus, 

                     CASE WHEN product.product_type = 1 THEN 'Non-Agricultural' ELSE 'Agricultural' END AS product_type

                    FROM delivery, product,   supplier, branch, employee
                    WHERE delivery.supplier_id =supplier.supplier_id AND delivery.branch_id= branch.branch_id 
                    AND delivery.employee_id= employee.employee_id
                    AND delivery.product_id= product.product_id
                     
                    ORDER BY delivery_id ASC";


                       if($result = mysqli_query($conn, $sql)){

                        if(mysqli_num_rows($result) > 0){


                            echo "<center><table class='table'></center>";


                                echo "<thead>";
                                echo "<caption><h1>Delivery Report(Status)</h1></caption>";

                                    echo "<tr style='width: 100px;'>";

                                        echo "<th style='width: 150px;'>Delivery ID</th>";

                                        echo "<th>Date/Time</th>";

                                        echo "<th>Product Name</th>";

                                       
                                         echo "<th>Product Type</th>";

                                        echo "<th>Unit Price</th>";

                                        echo "<th>Number of Units</th>";

                                        echo "<th>Unit of Measure</th>";

                                        echo "<th>Supplier Name</th>";

                                         echo "<th>Branch Name</th>";

                                          echo "<th>Employee Name</th>";

                                           echo "<th>Total Cost Amount</th>";

                                        echo "<th>Status</th>";


                                       

                         


                                    echo "</tr>";

                                echo "</thead>";

                                echo "<tbody>";



                    
                               


                                while($row= mysqli_fetch_assoc($result)){

                                  

                                    //print_r($row); 
                                  $total_payment  = $row['delivery_totalcostamount'];

                                    echo "<tr>";

                                        echo "<td> ", "<center>". $row['delivery_id'] . "</center>", "</td>";

                                        echo "<td> ","<center>". $row['delivery_datetime'] . "</center>","</td>";

                                        echo "<td> ", "<center>". $row['product_name'] . "</center>","</td>";

                                        
                                        echo "<td>", "<center>". $row['product_type'] ."</center>", "</td>";

                                        echo "<td> ", "<center>". $row['delivery_unitprice'] . "</center>", "</td>";

                                        echo "<td> ", "<center>". $row['delivery_numberofunits'] . "</center>", "</td>";

                                        echo "<td> ", "<center>". $row['delivery_unitofmeasure'] . "</center>", "</td>";

                                        echo "<td> ", "<center>". $row['supplier_name'] . "</center>", "</td>";

                                        echo "<td> ", "<center>". $row['branch_name'] . "</center>", "</td>";


                                        echo "<td> ", "<center>". $row['employee_firstname'] . "</center>", "</td>";


                                         echo "<td> ", "<center>". $row['delivery_totalcostamount'] . "</center>", "</td>";

                                        echo "<td> ", "<center>". $row['deleteStatus'] . "</center>", "</td>";


                                  $sum_sales += $total_payment;

               
                                
                                
                    }

                                echo "</tbody>";                            

                            echo "</table>";

                            // Free result set

                            mysqli_free_result($result);

                        } else{

                            echo "<p class='lead'><em>No records were found.</em></p>";

                        }

                    } else{

                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);

                    }

 

                    // Close connection

                    mysqli_close($conn);

                    ?>
  
 <h4>Total Sales: P <?php echo number_format($sum_sales, 2);  ?> </h4><br>

                   
            <ul class=date1>
     <li><h3><b>Date/Time: </b><span id="date"></h3></li>
</ul>



                                
<script>
    document.getElementById("date1").innerHTML = formatAMPM();

        function formatAMPM() {
            var d = new Date(),
                minutes = d.getMinutes().toString().length == 1 ? '0'+d.getMinutes() : d.getMinutes(),
                hours = d.getHours().toString().length == 1 ? '0'+d.getHours() : d.getHours(),
                ampm = d.getHours() >= 12 ? 'pm' : 'am',
                months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
                days = ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'];
            return days[d.getDay()]+' '+months[d.getMonth()]+' '+d.getDate()+' '+d.getFullYear()+' '+hours+':'+minutes+ampm;
        }
    </script>


    <script>
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
    document.getElementById("main").style.marginLeft = "250px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("main").style.marginLeft= "0";
}
</script>

<script>
    document.getElementById("date").innerHTML = formatAMPM();

    function formatAMPM() {
      var d = new Date(),
          minutes = d.getMinutes().toString().length == 1 ? '0'+d.getMinutes() : d.getMinutes(),
          hours = d.getHours().toString().length == 1 ? '0'+d.getHours() : d.getHours(),
          ampm = d.getHours() >= 12 ? 'pm' : 'am',
          months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
          days = ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'];
      return days[d.getDay()]+' '+months[d.getMonth()]+' '+d.getDate()+' '+d.getFullYear()+' '+hours+':'+minutes+ampm;
    }
  </script>

  

</body>
</html>
