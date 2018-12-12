<!--print delivery print(not filtered) report-->
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
	$this->Cell(276,10,'Delivery Report', 0, 0, 'C');
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
	$this->Cell(26,10,'Product Code',1,0,'C');
	
	$this->Cell(31,10,'Supplier',1,0,'C');
	$this->Cell(21,10,'Branch',1,0,'C');
	$this->Cell(26,10,'Employee',1,0,'C');
	$this->Cell(26,10,'Expiry Date',1,0,'C');
	
	$this->Ln();
}	
function viewTable($db){
	$this->SetFont('Times', '', 10);
//if(isset($_GET['generate']) || true){

						$stmt= $db->query("SELECT  delivery.delivery_id, delivery.dateDelivered, product.product_id, product.product_name, product.product_code, delivery.delivery_quantity, supplier.supplier_id, supplier.supplier_name,employee.employee_id, employee.employee_firstname, delivery.expiry_date, branch.branch_id, branch.branch_name
                    

                    FROM delivery, product, supplier, branch, employee

                    
                    WHERE delivery.supplier_id =supplier.supplier_id AND 
                    employee.branch_id= branch.branch_id AND 
                    delivery.employee_id= employee.employee_id
                    AND delivery.product_id= product.product_id
                     

                    ORDER BY delivery_id ASC");
                       
       
         while($data= $stmt->fetch(PDO::FETCH_OBJ)){


         	
		$this->Cell(10,10,$data->delivery_id,1,0,'L');
	$this->Cell(32,10,$data->dateDelivered,1,0,'L');
	$this->Cell(65,10,$data->product_name,1,0,'L');
	$this->Cell(26,10,$data->product_code,1,0,'L');
	$this->Cell(31,10,$data->supplier_name,1,0,'L');
	$this->Cell(21,10,$data->branch_name,1,0,'L');
	$this->Cell(26,10,$data->employee_firstname,1,0,'L');
	$this->Cell(26,10,$data->expiry_date,1,0,'L');

	

$this->Ln(); 
  
    }
}
}

$pdf= new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('L','A4', 0);
$pdf->headerTable();
$pdf->viewTable($db);
//$pdf->Cell(0,10, "Total P". number_format($sum_sales, 2));
$pdf->Ln();
date_default_timezone_set("Asia/Manila");
$pdf->Cell(0,10,'Date & Time Printed:  '. date("M d Y").' '.date("h:i:sa"), 0,0);
$pdf->output();
ob_end_flush(); 

?>

