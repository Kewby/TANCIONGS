<!--shows sales report by branch-->
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
  <a class="button" href="salesReportPrint.php"  target="_blank"><span class="glyphicon glyphicon-print"> Print</span>
    
  </a>
  
  </ul>
</div>
</div>

   
  </ul>
</div>

<div class="btn-group">
  <a class="btn dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-search"> Filter By Branch:</span>
    <span class="caret"></span>
  </a>
  <ul class="dropdown-menu">
   <li><a href="salesByBranchCebu.php">Cebu Branch</a></li>
   <li><a href="salesByBranchLeyte.php">Leyte Branch</a></li>
  
  
   
  </ul>
</div>


<div class="container">
    
<?php

                    //Include config file

                    require_once 'connection.php'; ?>
                    <br><br><br>

                    <?php
                    //$sum_sales = 0;


                    // Attempt select query execution

                     $sql = "SELECT sales.sales_id, sales.sales_datetime, employee.employee_id, branch.branch_id, branch.branch_name, sales.changefund, sales.total_sales, employee.employee_firstname

                     FROM sales,employee, branch

                      WHERE sales.employee_id = employee.employee_id AND employee.branch_id = branch.branch_id
                  
                    ORDER BY sales_id ASC";


                    if($result = mysqli_query($conn, $sql)){

                        if(mysqli_num_rows($result) > 0){


                            echo "<center><table class='table'></center>"; 

                                echo "<thead>";
                                echo "<caption><h1>Sales By Branch Report</h1></caption>";

                                    echo "<tr style='width: 100px;'>";


                                        echo "<th style='width: 150px;'>Sales ID</th>";

                                        echo "<th>Sales Date/Time</th>";

                                        echo "<th>Day</th>";

                                        echo "<th>Employee Name</th>";

                                         echo "<th>Branch</th>";

                                        echo "<th>Sales for the Day</th>";

                                         echo "<th>Beginning Fund</th>";

                                        

                                       // echo "<th>Profit</th>";
                                        

                                       

                         


                                    echo "</tr>";

                                echo "</thead>";

                                echo "<tbody>";

                                while($row = mysqli_fetch_assoc($result)){

                                    //print_r($row); 

                                    echo "<tr>";

                                    

                                    $total_payment  = $row['total_sales'];



                                        echo "<td> ", "<center>". $row['sales_id'] . "</center>", "</td>";

                                        echo "<td> ","<center>". $row['sales_datetime'] . "</center>","</td>";

                                        $date= $row['sales_datetime'];
                                        $day= date('l', strtotime($date));

                                        echo "<td> ", "<center>". $day . "</center>", "</td>";

                                        echo "<td> ", "<center>". $row['employee_firstname'] . "</center>","</td>";

                                        echo "<td> ", "<center>". $row['branch_name'] . "</center>","</td>";

                                         echo "<td> ", "<center>". $row['total_sales'] . "</center>", "</td>";

                                        echo "<td> ", "<center>". $row['changefund'] . "</center>","</td>";

                                        
    
                                       
                                    

                                        //$sum_sales += $total_payment;
                            
 //$profit= 0;
                                          
//$change= $row['changefund'];
//$tenderAmount= $row['total_sales'];

                                //$profit=$tenderAmount- $change;
        
                                

                      //echo "<td> ", "<center>". $profit . "</center>", "</td>";

                      

                      
                                                  
                                   

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

                  <!-- <h4>Total Sales: P <?php echo number_format($sum_sales, 2);  ?> </h4><br>-->


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