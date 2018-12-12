<!--landing or index page-->
<?php require_once('connection.php'); ?>
<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
   <link rel="icon" href="favicon.ico" type="image" sizes="16x16">
   <link rel="icon" href="favicon.ico" type="image" sizes="16x16">
  <style>
  
     .container-fluid {
      padding: 5px 50px;
      padding-top: 50px;
    }

      .btn-group{
  padding-left: 10px;
  padding-right: 0px;
  padding-top: 15px;
  padding-bottom:15px;
}

.btn {
    background-color: orange;
    color: white;
    padding-top: 16px;
    padding-bottom: 16px;
    padding-left: 16px;
    padding-right: 10px;
    font-size: 20px;
    border: none;
    padding-left: 10px;

}

.dropdown {
    position: absolute;
    display: inline-block;

}
.dropdown-menu{
background-color: #FFF;
font-size: 18px;
font-family: sans-serif;
}
 
.dropdown-menu li a:hover, .dropdown-menu li.active a {
      
      background-color: orange !important;
      color: #FFF;
  }
.img{
  width: 350px;


  </style>
</head>
<body>

<center>


<div class="container-fluid">
<div class= "choices">
<img class="img" src="pic.png">

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

<!--<div class="btn-group">
  <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
 Branch
    <span class="caret"></span>
  </a>
  <ul class="dropdown-menu">
   <li><a href="branchList.php"> Store Branch List</a></li>
  
   
  </ul>
</div>-->


</div>


</center>
  

</body>
</html>
