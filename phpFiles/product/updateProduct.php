<?php

  include_once ('..\connection.php');   

    $product_code = $_GET['productCode'];
  $product_name = $_GET['productName'];
  $product_type = $_GET['productType'];
  $category = $_GET['category'];
  $standard_cost = $_GET['standardCost'];
  $markup_cost = $_GET['markupCost'];


  $conn = getConnection();


  $query = "UPDATE `product` 
        SET product_name ='".$product_name."' , 
              product_type= '".$product_type."' , 
              category_id= (SELECT category.category_id FROM `category` WHERE category.category_name = '".$category."' LIMIT 1) , 
              standard_cost='".$standard_cost."' , 
              markup_cost='".$markup_cost."'
              WHERE product_code = '".$product_code."'";
      

  echo $query;
  $result = mysqli_query($conn, $query) or die ("ERROR" .mysqli_error($conn));
  echo $result;

  ?>