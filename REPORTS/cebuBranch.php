<!--shows all employees in cebu branch in employee master list-->
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
  <a class="button" href="cebuBranchPrint.php"  target="_blank"><span class="glyphicon glyphicon-print"> Print</span>
    
  </a>
  
  </ul>
</div>
</div>

<div class="btn-group">
  <a class="btn dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-search"> Filter By:</span>
    <span class="caret"></span>
  </a>
  <ul class="dropdown-menu">
  <li><a href="cebuBranch.php">Cebu Branch</a></li>
   <li><a href="leyteBranch.php">Leyte Branch</a></li>
  
   
  </ul>
</div>

<div class="container">
    
<?php

                    //Include config file

                    require_once 'connection.php'; ?>
                    <br><br><br>

                    <?php
                    // Attempt select query execution

                    $sql = "SELECT employee.employee_id, employee.employee_firstname,employee.employee_lastname, employee.username, employee.employee_email, employee.employee_contactnumber, employee.employee_address, branch.branch_id, branch.branch_name, employee.isAdmin, employee.deleteStatus,
                    CASE WHEN employee.isAdmin = 1 THEN 'Admin' ELSE 'Cashier' END AS isAdmin ,

                    CASE WHEN employee.deleteStatus = 1 THEN 'Not Active' ELSE 'Active' END AS deleteStatus

                    FROM employee, branch


                    WHERE branch.branch_id= employee.branch_id 
                    AND branch.branch_id= 1
                   
                    ORDER BY employee_id ASC";





                    if($result = mysqli_query($conn, $sql)){

                        if(mysqli_num_rows($result) > 0){



                            echo "<center><table class='table'></center>";


                                echo "<thead>";
                                echo "<caption><h1>Employee Master List Report (Cebu Branch)</h1></caption>";

                                    echo "<tr style='width: 100px;'>";

                                        echo "<th style='width: 150px;'>Employee Id</th>";

                                        echo "<th>Employee Firstname</th>";

                                        echo "<th>Employee Lastname</th>";

                                       
                                         echo "<th>Username</th>";

                                        echo "<th>Employee Email</th>";

                                        echo "<th>Contact Number</th>";

                      

                                        echo "<th>Address</th>";

                                        echo "<th>Branch Assigned</th>";

                                        echo "<th>Role</th>";

                                        echo "<th>Status</th>";

                                       

                         


                                    echo "</tr>";

                                echo "</thead>";

                                echo "<tbody>";


                                while($row = mysqli_fetch_assoc($result)){

                                    //print_r($row); 

                                    echo "<tr>";

                                        echo "<td> ", "<center>". $row['employee_id'] . "</center>", "</td>";

                                        echo "<td> ","<center>". $row['employee_firstname'] . "</center>","</td>";

                                        echo "<td> ", "<center>". $row['employee_lastname'] . "</center>","</td>";

                                        
                                        echo "<td>", "<center>". $row['username'] ."</center>", "</td>";

                                        echo "<td> ", "<center>". $row['employee_email'] . "</center>", "</td>";

                                        echo "<td> ", "<center>". $row['employee_contactnumber'] . "</center>", "</td>";

                                        echo "<td> ", "<center>". $row['employee_address'] . "</center>", "</td>";

                                        echo "<td> ", "<center>". $row['branch_name'] . "</center>", "</td>";

                                        echo "<td> ", "<center>". $row['isAdmin'].  "</center>", "</td>";

                                         echo "<td> ", "<center>". $row['deleteStatus'].  "</center>", "</td>";




                                        

                            

                                                  
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
</div>


</center>
  

</body>
</html>
