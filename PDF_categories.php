<?php
require('fpdf17/fpdf.php');

class PDF extends FPDF {
	function Header(){
		$this->SetFont('Arial','B',15);
		
		//dummy cell to put logo
		//$this->Cell(12,0,'',0,0);
		//is equivalent to:
		$this->Cell(12);
		
		//put logo
		$this->Image('pic.png',10,10,10);
		
		$this->Cell(100,10,'Tanciongs General Merchandise Categories',0,1);
		
		//dummy cell to give line spacing
		//$this->Cell(0,5,'',0,1);
		//is equivalent to:
		$this->Ln(5);
		
	}
	function Footer(){
		
		//Go to 1.5 cm from bottom
		$this->SetY(-15);
				
		$this->SetFont('Arial','',8);
		
		//width = 0 means the cell is extended up to the right margin
		$this->Cell(0,10,'Page '.$this->PageNo()." / {pages}",0,0,'C');
	}
}
$con = mysqli_connect('localhost','root','');
mysqli_select_db($con,'dbtanciongs');

$query = mysqli_query($con,"select * from category");
$category = mysqli_fetch_array($query);

//A4 width : 219mm
//default margin : 10mm each side
//writable horizontal : 219-(10*2)=189mm

$pdf = new PDF('P','mm','A4'); //use new class

//define new alias for total page numbers
$pdf->AliasNbPages('{pages}');

$pdf->AddPage();

//Image( file name , x position , y position , width [optional] , height [optional] )
//$pdf->Image('watermark.png',10,10,189);

//set font to arial, bold, 14pt
$pdf->SetFont('Arial','',12);

//Cell(width , height , text , border , end line , [align] )

//normal row height=5.

$pdf->Cell(20,10,'ID',1,0); //vertically merged cell, height=2x row height=2x5=10
$pdf->Cell(50,10,'Category Name',1,0); //vertically merged cell
$pdf->Cell(100,10,'Description',1,0); //normal height, but occupy 4 columns (horizontally merged)
 									//vertically merged cell
$pdf->Cell(0,10,'',0,1); //dummy line ending, height=5(normal row height) width=09 should be invisible 

$query = mysqli_query($con,"select * from category where category_id != 0 ");
while($category = mysqli_fetch_array($query)){


$pdf->SetFont('Arial','',11);
//data rows


	$pdf->Cell(20,5,$category['category_id'],1,0);
	$pdf->Cell(50,5,$category['category_name'],1,0);
	$pdf->Cell(100,5,$category['description'],1,0);
	$pdf->Cell(0,5,'',0,1); //dummy line ending, height=5(normal row height) width=09 should be invisible 
	
}
	$pdf->Cell(170,5,'','T',1);
	date_default_timezone_set("Asia/Manila");
	$pdf->Cell(40,2,'Date Printed: ' .date("m/d/Y") .' '.date("h:i:sa"),0,0);



















$pdf->Output();
?>
