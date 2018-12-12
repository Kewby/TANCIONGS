<!--shows sales by product report-->
<?php require_once('connection.php'); ?>
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
   
   
   
  </ul>
</div>

<div class="btn-group">
  <a class="btn dropdown-toggle" data-toggle="dropdown">
   Purchased and Delivered Goods
    <span class="caret"></span>
  </a>
  <ul class="dropdown-menu">
   <li><a href="deliveryReport1.php"> Purchased and Delivered Goods Report</a></li>
  
   
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
   Employee
    <span class="caret"></span>
  </a>
  <ul class="dropdown-menu">
   <li><a href="employeeList.php"> Employee Master List</a></li>
  
   
  </ul>
</div>

<div class="btn-group">
  <a class="button" href="salesPrint.php"  target="_blank"><span class="glyphicon glyphicon-print"> Print</span>
    
  </a>
  
  </ul>
</div>
</div>
<br>

<div class="btn-group">
  <a class="btn dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-search"> Filter By:</span>
    <span class="caret"></span>
  </a>
  <ul class="dropdown-menu">
   <li><a href="agriculturalSales.php">Agricultural Products</a></li>
   <li><a href="nonAgriculturalSales.php">Non-Agricultural Products</a></li>
   

   
   
  </ul>
</div>


<div class="container">
    
<?php

                    //Include config file

                    require_once 'connection.php'; ?>
                    <br><br><br>

                    <?php
                    // Attempt select query execution

                     $sql = "SELECT  transactionitem.transactionitem_id,transaction.transaction_id,product.product_id,  transactionitem.transactionitem_qty,  transactionitem.transactionitem_unitprice,  transactionitem.transactionitem_subtotal, product.product_name, product.product_type,

                     CASE WHEN product.product_type = 1 THEN 'Non-Agricultural' ELSE 'Agricultural' END AS product_type

                     FROM transactionitem, transaction, product


                      WHERE transaction.transaction_id= transactionitem.transaction_id AND

                      transactionitem.product_id= product.product_id
                  
                    ORDER BY transactionItem_id ASC";


                    if($result = mysqli_query($conn, $sql)){

                        if(mysqli_num_rows($result) > 0){


                            echo "<center><table class='table'></center>"; 

                                echo "<thead>";
                                echo "<caption><h1>Sales By Product</h1></caption>";

                                    echo "<tr style='width: 100px;'>";


                                        echo "<th style='width: 150px;'>Transaction ID</th>";

                                        echo "<th>Product Name</th>";

                                        echo "<th>Product Type</th>";

                                        echo "<th>Quantity Sold</th>";

                                        echo "<th>Unit Price</th>";

                                        echo "<th>Sale</th>";

                                       

                         


                                    echo "</tr>";

                                echo "</thead>";

                                echo "<tbody>";


                                while($row = mysqli_fetch_assoc($result)){

                                    //print_r($row); 

                                    echo "<tr>";


                                        
                                        echo "<td> ","<center>". $row['transaction_id'] . "</center>","</td>";

                                        echo "<td> ", "<center>". $row['product_name'] . "</center>","</td>";

                                        echo "<td> ", "<center>". $row['product_type'] . "</center>","</td>";

    
                                        echo "<td> ", "<center>". $row['transactionitem_qty'] . "</center>", "</td>";

                                        echo "<td> ", "<center>". $row['transactionitem_unitprice'] . "</center>", "</td>";

                                        echo "<td> ","<center>". $row['transactionitem_subtotal'] ."</center>", "</td>";

                                        
                            

                                                  
                                    echo "</tr>";

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


<ul class=date>
     <li><h3><b>Date/Time: </b><span id="date"></h3></li>
</ul>

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
</div>
</body>
</html>