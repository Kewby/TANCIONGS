<?php 

  include_once ('..\connection.php'); 

  //$category_id = $_GET['category_id'];
  $detCategory = $_GET['category'];

  $detCatquery = "SELECT category_id FROM `category` WHERE category_name = '".$detCategory."' LIMIT 1";


    if($result=mysqli_query($conn,$detCatquery)){

      $fp = fopen('determineCategory.json', 'w');
      fwrite($fp, '{"data":[');

    while ($r=mysqli_fetch_assoc($result)) {
      $rows['category_id'] = $r['category_id'];
      // $rows['category_name'] = $r['category_name']; 
      
      fwrite($fp, json_encode($rows));
    }

    fwrite($fp, "]}");
    fclose($fp);

   $jsonURL = 'C://TANCIONGS//determineCategory.json';
   $data = file_get_contents($jsonURL);
   $id = json_decode($data);
  }


?>