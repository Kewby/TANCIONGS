<!--print cebu branch in employee Master List-->
<?php
ob_start();
require ("fpdf/fpdf.php");
$db= new PDO('mysql:host=localhost;dbname=finaltanciongs','root','');


class myPDF extends FPDF{
	function header(){
	$this->Image('pic.png',63,1,29);
	$this->SetFont('Arial', 'B', 20);
	$this->Cell(276,8, 'Report Module', 0,0, 'C');
	$this->Ln();
	$this->SetFont('Times', '', 18);
	$this->Cell(276,10,'Employee Master List (Cebu Branch)', 0, 0, 'C');
	$this->Ln(20);
	}
	function footer(){
	$this->SetY(-15);
	$this->SetFont('Arial','',12);
	$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
function headerTable(){
	$this->SetFont('Times', 'B', 10);
	$this->Cell(23,10,'Employee ID',1,0,'C');
	$this->Cell(32,10,'Employee Firstname',1,0,'C');
	$this->Cell(32,10,'Employee Lastname',1,0,'C');
	$this->Cell(30,10,'Username',1,0,'C');
	$this->Cell(32,10,'Email',1,0,'C');
	$this->Cell(30,10,'Contact Number',1,0,'C');
	$this->Cell(30,10,'Address',1,0,'C');
	$this->Cell(30,10,'Branch Assigned',1,0,'C');
	$this->Cell(17,10,'Role',1,0,'C');
	$this->Cell(30,10,'Status',1,0,'C');

	$this->Ln();
}	
function viewTable($db){
	$this->SetFont('Times', '', 9);
	$stmt= $db->query("SELECT employee.employee_id, employee.employee_firstname,employee.employee_lastname, employee.username, employee.employee_email, employee.employee_contactnumber, employee.employee_address, branch.branch_id, branch.branch_name, employee.isAdmin, employee.deleteStatus,
                    CASE WHEN employee.isAdmin = 1 THEN 'Admin' ELSE 'Cashier' END AS isAdmin ,

                    CASE WHEN employee.deleteStatus = 1 THEN 'Not Active' ELSE 'Active' END AS deleteStatus

                    FROM employee, branch


                    WHERE branch.branch_id= employee.branch_id 
                    AND branch.branch_id= 1
                   
                    ORDER BY employee_id ASC");
	while($data= $stmt->fetch(PDO::FETCH_OBJ)){
		$this->Cell(23,10,$data->employee_id,1,0,'L');
	$this->Cell(32,10,$data->employee_firstname,1,0,'L');
	$this->Cell(32,10,$data->employee_lastname,1,0,'L');
	$this->Cell(30,10,$data->username,1,0,'L');
	$this->Cell(32,10,$data->employee_email,1,0,'L');
	$this->Cell(30,10,$data->employee_contactnumber,1,0,'L');
    $this->Cell(30,10,$data->employee_address,1,0,'L');
	$this->Cell(30,10,$data->branch_name,1,0,'L');
	$this->Cell(17,10,$data->isAdmin,1,0,'L');
	$this->Cell(30,10,$data->deleteStatus,1,0,'L');
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

