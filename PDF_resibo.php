<?php
require('fpdf17/fpdf.php');

class PDF extends FPDF {


}

$idcatcher = $_GET["transID"]; //diri ipasa ang transaction ID gikan sa java (katong ig click sa ok sa Purchase succeeded nga prompt)
$con = mysqli_connect('localhost','root','');
mysqli_select_db($con,'finaltanciongs');

$query = mysqli_query($con,"select * from transaction WHERE transaction_id = $idcatcher ");
$transaction = mysqli_fetch_array($query);

$query = mysqli_query($con,"select * from employee WHERE employee_id = {$transaction['employee_id']} ");
$employee = mysqli_fetch_array($query);
$transactionitem = mysqli_query($con,"select * from transactionitem WHERE transaction_id = $idcatcher");

//$transactionitem = mysqli_fetch_array($query);
//$query = mysqli_query($con,"select * from supplier");
//$supplier = mysqli_fetch_array($query);


//A4 width : 219mm
//default margin : 10mm each side
//writable horizontal : 219-(10*2)=189mm

$pdf = new PDF('P','in',array(4,10)); //use new class

//define new alias for total page numbers
$pdf->AliasNbPages('{pages}');

$pdf->AddPage();

//Image( file name , x position , y position , width [optional] , height [optional] )
//$pdf->Image('watermark.png',10,10,189);

//set font to arial, bold, 14pt
$pdf->SetFont('Arial','',9);

//Cell(width , height , text , border , end line , [align] )

//normal row height=5.


$pdf->Cell(0,0,"Tanciong's General Merchandise",0,1,'C'); //vertically merged cell
$pdf->Cell(0,.3,"NON-VAT Registered TIN 468-015-529-001 V",0,1,'C');
$pdf->Cell(0,0,"The Persimmon Plus M.J Cuenco Ave.,",0,1,'C'); 
$pdf->Cell(0,.3,"Mabolo Cebu City",0,1,'C'); 
$pdf->Cell(0,0,"POS sn:QA19550021   MIN:17051713343319433",0,1,'C');
$pdf->Cell(0,.3,"*THIS SERVES AS YOUR SALES INVOICE*",0,1,'C');  
 
$pdf->Cell(0,.5,'-------------------------------------------------',0,.1,'C'); //dummy line ending, height=5(normal row height) width=09 should be invisible 

$date = date('M d, Y h:i A', strtotime($transaction['transaction_datetime']));
$pdf->Cell(0,0,$date,0,0,'L'); //vertically merged cell
$pdf->Cell(0,0,"SI No: ".$transaction['transaction_id'],0,1,'R');
$pdf->Cell(0,.5,'-------------------------------------------------',0,.1,'C');






while($row = mysqli_fetch_array($transactionitem)){
	
	$query = mysqli_query($con,"select * from product WHERE product_id = {$row['product_id']}");
	$product = mysqli_fetch_array($query);
	
	



			$pdf->Cell(0,0,$product['product_name'].$product['product_type'],0,0,'L'); 
    		$pdf->Cell(0,0,$row['transactionItem_subtotal'],0,1,'R'); 
    		$pdf->Cell(0,.5,"       {$row['transactionItem_qty']} PCS  x  @{$row['transactionItem_unitprice']}",0,1,'L');
    		
									} 

 $change = (($transaction['transaction_tender'])-(($transaction['transaction_grandtotal'])+($transaction['transaction_grandtotal']*.12)));

// $change = (($transaction['transaction_grandtotal'])-(($transaction['transaction_tender'])+($transaction['transaction_grandtotal']*.12)));


$pdf->SetFont('Arial','B',13);
  $pdf->Cell(0,.3,"SUB TOTAL",0,0,'L'); 
  $pdf->Cell(0,.3,$transaction['transaction_grandtotal'],0,1,'R'); 


$pdf->SetFont('Arial','',9);
$pdf->Cell(0,.2,"VAT-Exempt Sale(Agricultural)",0,0,'L');
$pdf->Cell(0,.2,$transaction['transaction_grandtotal'],0,1,'R');
$pdf->Cell(0,.2,"12% VAT(Non-Agricultural)",0,0,'L');
$pdf->Cell(0,.2,$transaction['transaction_grandtotal']*.12,0,1,'R');
$pdf->Cell(0,.2,"Service Charge",0,0,'L'); 
$pdf->Cell(0,.2,"0.00",0,1,'R');
$pdf->Cell(0,.2,"VAT Sale",0,0,'L'); //vertically merged cell
$pdf->Cell(0,.2,$transaction['transaction_grandtotal']*.12,0,1,'R');
$pdf->Cell(0,.2,"Total Sale",0,0,'L'); 
$pdf->Cell(0,.2,(($transaction['transaction_grandtotal'])+($transaction['transaction_grandtotal']*.12)),0,1,'R');


$pdf->SetFont('Arial','B',14);
  $pdf->Cell(0,.5,"Total Amount",0,0,'L');
  $pdf->Cell(0,.5,(($transaction['transaction_grandtotal'])+($transaction['transaction_grandtotal']*.12)),0,1,'R');

$pdf->SetFont('Arial','',12);
  $pdf->Cell(0,.3,"CASH",0,0,'L'); 
  $pdf->Cell(0,.3,$transaction['transaction_tender'],0,1,'R'); 

 $pdf->SetFont('Arial','B',14);
  $pdf->Cell(0,.5,"CHANGE",0,0,'L'); 
  $pdf->Cell(0,.5,$change,0,1,'R'); 



$pdf->SetFont('Arial','',10);
  $pdf->Cell(0,.5,"CASHIER: {$employee['employee_firstname']} {$employee['employee_lastname']}",0,.5,'C'); 
  $pdf->Cell(0,.2,'-------------------------------------------------',0,.5,'C');

$pdf->SetFont('Arial','',9);
 
$pdf->Cell(0,.3,"*THIS INVOICE/RECEIPT SHALL BE VALID",0,1,'C'); 
$pdf->Cell(0,0,"FOR FIVE (5) YEARS FROM THE DATE OF",0,1,'C');
$pdf->Cell(0,.3,"*THE PERMIT TO USE*",0,1,'C'); 








$pdf->Output();
?>
