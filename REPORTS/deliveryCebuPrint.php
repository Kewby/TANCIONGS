<!--print delivery print cebu branch report-->
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
	$this->Cell(276,10,'Delivery Report(Cebu Branch)', 0, 0, 'C');
	$this->Ln(20);
	}
	function footer(){
	$this->SetY(-15);
	$this->SetFont('Arial','',12);
	$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
function headerTable(){
	$this->SetFont('Times', 'B', 12);
	$this->Cell(10,10,'ID',1,0,'C');
	$this->Cell(32,10,'Date/Time',1,0,'C');
	$this->Cell(65,10,'Product Name',1,0,'C');
	$this->Cell(20,10,'type',1,0,'C');
	$this->Cell(15,10,'Price',1,0,'C');
	$this->Cell(17,10,'Quantity',1,0,'C');
	$this->Cell(20,10,'Measure',1,0,'C');
	$this->Cell(31,10,'Supplier',1,0,'C');
	$this->Cell(21,10,'Branch',1,0,'C');
	$this->Cell(20,10,'Employee',1,0,'C');
	$this->Cell(15,10,'Total',1,0,'C');
	$this->Cell(20,10,'Status',1,0,'C');

	$this->Ln();
}	
function viewTable($db){
	$this->SetFont('Times', '', 10);
//if(isset($_GET['generate']) || true){

						$stmt= $db->query("SELECT  delivery.delivery_id, delivery.delivery_datetime, product.product_id, product.product_name, product.product_type, delivery.delivery_unitprice, delivery.delivery_numberofunits, delivery.delivery_unitofmeasure, delivery.delivery_totalcostamount, supplier.supplier_id, supplier.supplier_name, branch.branch_id, branch.branch_name, employee.employee_id, employee.employee_firstname, delivery.deleteStatus,

                    CASE WHEN delivery.deleteStatus = 1 THEN 'Phaseout' ELSE 'Available' END AS deleteStatus, 

                     CASE WHEN product.product_type = 1 THEN 'Non-Agricultural' ELSE 'Agricultural' END AS product_type

                    FROM delivery, product,   supplier, branch, employee
                    WHERE delivery.supplier_id =supplier.supplier_id AND delivery.branch_id= branch.branch_id 
                    AND delivery.employee_id= employee.employee_id
                    AND delivery.product_id= product.product_id
                    AND branch.branch_id = 1
                     

                    ORDER BY delivery_id ASC");
                       
        global $sum_sales;              // echo $stringQuery1;
                       
  $sum_sales= 0;
         while($data= $stmt->fetch(PDO::FETCH_OBJ)){


         	
		$this->Cell(10,10,$data->delivery_id,1,0,'L');
	$this->Cell(32,10,$data->delivery_datetime,1,0,'L');
	$this->Cell(65,10,$data->product_name,1,0,'L');
	$this->Cell(20,10,$data->product_type,1,0,'L');
	$this->Cell(15,10,$data->delivery_unitprice,1,0,'L');
	$this->Cell(17,10,$data->delivery_numberofunits,1,0,'L');
	$this->Cell(20,10,$data->delivery_unitofmeasure,1,0,'L');
	$this->Cell(31,10,$data->supplier_name,1,0,'L');
	$this->Cell(21,10,$data->branch_name,1,0,'L');
	$this->Cell(20,10,$data->employee_firstname,1,0,'L');
	$this->Cell(15,10,$data->delivery_totalcostamount,1,0,'L');
	$this->Cell(20,10,$data->deleteStatus,1,0,'L');

	$sum_sales += $data->delivery_totalcostamount;

$this->Ln(); 
  
    }
}
}

$pdf= new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('L','A4', 0);
$pdf->headerTable();
$pdf->viewTable($db);
$pdf->Cell(0,10, "Total P". number_format($sum_sales, 2));
$pdf->Ln();
date_default_timezone_set("Asia/Manila");
$pdf->Cell(0,10,'Date & Time Printed:  '. date("M d Y").' '.date("h:i:sa"), 0,0);
$pdf->output();
ob_end_flush(); 

?>

