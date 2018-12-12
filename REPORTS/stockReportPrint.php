<!--print stocks report-->
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
	$this->Cell(276,10,'Stock Status Report', 0, 0, 'C');
	$this->Ln(20);
	}
	function footer(){
	$this->SetY(-15);
	$this->SetFont('Arial','',12);
	$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
function headerTable(){
	$this->SetFont('Times', 'B', 12);
	$this->Cell(23,10,'Stock ID',1,0,'C');
	$this->Cell(30,10,'Stock Onhand',1,0,'C');
	$this->Cell(30,10,'Restock',1,0,'C');
	$this->Cell(30,10,'product_code',1,0,'C');
	$this->Cell(102,10,'Product Name',1,0,'C');
	$this->Cell(30,10,'Delete Status',1,0,'C');
	$this->Ln();
}	
function viewTable($db){
	$this->SetFont('Times', '', 10);
	$stmt= $db->query("SELECT  stock.stock_id, stock.stock_onhand,  product.restockCount, product.product_id, product.product_name, product.product_code
                    
                    FROM stock, product
                    WHERE stock.product_code =product.product_code  
    
                    ORDER BY stock_id ASC");
	while($data= $stmt->fetch(PDO::FETCH_OBJ)){
		$this->Cell(23,10,$data->stock_id,1,0,'L');
	$this->Cell(30,10,$data->stock_onhand,1,0,'L');
	$this->Cell(30,10,$data->restockCount,1,0,'L');
	$this->Cell(30,10,$data->product_code,1,0,'L');
	$this->Cell(102,10,$data->product_name,1,0,'L');
	


$stockOnHand= $data->stock_onhand;
$restock= $data->restockCount;
$status= "";

if($stockOnHand <= $restock || $stockOnHand == 5)

{
 $status =  'Restock';
 }else{
  $status= 'Available';
 }

 $this->Cell(30,10,$status,1,0,'L');
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

