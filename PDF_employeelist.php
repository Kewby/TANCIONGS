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
		
		$this->Cell(100,10,'Tanciongs General Merchandise Employee List',0,1);
		
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

$query = mysqli_query($con,"select * from employee");
$employee = mysqli_fetch_array($query);


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


$pdf->Cell(40,10,'Employee Name',1,0); //vertically merged cell
$pdf->Cell(40,10,'Address',1,0);
$pdf->Cell(50,10,'E-Mail',1,0); 
$pdf->Cell(30,10,'Contact No.',1,0); 
$pdf->Cell(30,10,'Branch',1,0,'C');  
 
$pdf->Cell(0,10,'',0,1); //dummy line ending, height=5(normal row height) width=09 should be invisible 


$query = mysqli_query($con,"SELECT employee.employee_id, employee.employee_firstname,employee.employee_lastname, employee.username, employee.employee_email, employee.employee_contactnumber, employee.employee_address, branch.branch_id, branch.branch_name 
	
	FROM employee,branch 

	WHERE branch.branch_id= employee.branch_id");

while($employee = mysqli_fetch_array($query)){
 

$pdf->SetFont('Arial','',11);
//data rows


	
	$pdf->Cell(40,5,$employee['employee_lastname'].$employee['employee_firstname'],1,0,'LR');
	$pdf->Cell(40,5,$employee['employee_address'],1,0,'LR');
	$pdf->Cell(50,5,$employee['employee_email'],1,0,'LR');
	$pdf->Cell(30,5,$employee['employee_contactnumber'],1,0,'LR');
	$pdf->Cell(30,5,$employee['branch_name'],1,1,'C');
	
	
}
	$pdf->Cell(190,5,'','T',1);
date_default_timezone_set("Asia/Manila");
	$pdf->Cell(40,2,'Date Printed: ' .date("m/d/Y") .' '.date("h:i:sa"),0,0);
	
















$pdf->Output();
?>
