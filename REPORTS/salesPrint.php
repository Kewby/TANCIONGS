<!--print Sales by product report-->
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
	$this->Cell(276,10,'Sales By Product Report', 0, 0, 'C');
	$this->Ln(20);
	}
	function footer(){
	$this->SetY(-15);
	$this->SetFont('Arial','',12);
	$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
function headerTable(){
	$this->SetFont('Times', 'B', 12);
	$this->Cell(40,10,'Transaction Item ID',1,0,'C');
	$this->Cell(30,10,'Transaction ID',1,0,'C');
	$this->Cell(102,10,'Product Name',1,0,'C');
	$this->Cell(30,10,'Product type',1,0,'C');
	$this->Cell(20,10,'Quantity',1,0,'C');
	$this->Cell(30,10,'Unit Price',1,0,'C');
	$this->Cell(30,10,'Total Price',1,0,'C');
	$this->Ln();
}	
function viewTable($db){
	$this->SetFont('Times', '', 10);
	$stmt= $db->query("SELECT  transactionitem.transactionitem_id,transaction.transaction_id,product.product_id,  transactionitem.transactionitem_qty,  transactionitem.transactionitem_unitprice,  transactionitem.transactionitem_subtotal, product.product_name, product.product_type,

                     CASE WHEN product.product_type = 1 THEN 'Non-Agricultural' ELSE 'Agricultural' END AS product_type

                     FROM transactionitem, transaction, product


                      WHERE transaction.transaction_id= transactionitem.transaction_id AND

                      transactionitem.product_id= product.product_id
                  
                    ORDER BY transactionItem_id ASC");
	while($data= $stmt->fetch(PDO::FETCH_OBJ)){
		$this->Cell(40,10,$data->transactionitem_id,1,0,'L');
	$this->Cell(30,10,$data->transaction_id,1,0,'L');
	$this->Cell(102,10,$data->product_name,1,0,'L');
	$this->Cell(30,10,$data->product_type,1,0,'L');
	$this->Cell(20,10,$data->transactionitem_qty,1,0,'L');
	$this->Cell(30,10,$data->transactionitem_unitprice,1,0,'L');
	$this->Cell(30,10,$data->transactionitem_subtotal,1,0,'L');
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

