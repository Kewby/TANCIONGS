<!--print supplier Master List-->



<?php
ob_start();
require ("fpdf/fpdf.php");
$db= new PDO('mysql:host=localhost;dbname=finaltanciongs','root','');


class myPDF extends FPDF{
	function header(){
	$this->Image('pic.png',93,1,29);
	$this->SetFont('Arial', 'B', 20);
	$this->Cell(276,8, 'Report Module', 0,0, 'C');
	$this->Ln();
	$this->SetFont('Times', '', 18);
	$this->Cell(276,10,'Supplier Master List', 0, 0, 'C');
	$this->Ln(20);
	}
	function footer(){
	$this->SetY(-15);
	$this->SetFont('Arial','',12);
	$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
function headerTable(){
	$this->SetFont('Times', 'B', 12);
	$this->Cell(23,10,'Supplier ID',1,0,'C');
	$this->Cell(40,10,'Supplier Name',1,0,'C');
	$this->Cell(48,10,'Supplier Address ',1,0,'C');
	$this->Cell(50,10,'Supplier Email ',1,0,'C');
	$this->Cell(50,10,'Supplier Contact Number',1,0,'C');
	$this->Cell(50,10,'Supplier Contact Person',1,0,'C');
	$this->Cell(24,10,'Status',1,0,'C');
	$this->Ln();
}	
function viewTable($db){
	$this->SetFont('Times', '', 10);
	$stmt= $db->query("SELECT supplier.supplier_id, supplier.supplier_name, supplier.supplier_address, supplier.supplier_email, supplier.supplier_contactnumber, supplier.supplier_contactperson, supplier.deleteStatus,
                    CASE WHEN supplier.deleteStatus = 1 THEN 'Not Active' ELSE 'Active' END AS deleteStatus
                    FROM supplier
                   
                    ORDER BY supplier_id ASC");
	while($data= $stmt->fetch(PDO::FETCH_OBJ)){
		$this->Cell(23,10,$data->supplier_id,1,0,'L');
	$this->Cell(40,10,$data->supplier_name,1,0,'L');
	$this->Cell(48,10,$data->supplier_address,1,0,'L');
	$this->Cell(50,10,$data->supplier_email,1,0,'L');
	$this->Cell(50,10,$data->supplier_contactnumber,1,0,'L');
	$this->Cell(50,10,$data->supplier_contactperson,1,0,'L');
	$this->Cell(24,10,$data->deleteStatus,1,0,'L');
	$this->Ln();
	}
}
}
$pdf= new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('L','A4', 0);
$pdf->headerTable();
$pdf->viewTable($db);
date_default_timezone_set("Asia/Manila");
$pdf->Cell(0,10,'Date & Time Printed:  '. date("M d Y").' '.date("h:i:sa"), 0,0);
$pdf->output();
ob_end_flush(); 

?>


<link rel="icon" href="favicon.ico" type="image" sizes="16x16">