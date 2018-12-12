<!--print employee Master List-->
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
	$this->Cell(276,10,'Employee Master List', 0, 0, 'C');
	$this->Ln(20);
	}
	function footer(){
	$this->SetY(-15);
	$this->SetFont('Arial','',12);
	$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
function headerTable(){
	$this->SetFont('Times', 'B', 10);
	$this->Cell(8,10,'ID',1,0,'C');
	$this->Cell(22,10,'Firstname',1,0,'C');
	$this->Cell(22,10,'Lastname',1,0,'C');
	$this->Cell(22,10,'Username',1,0,'C');
	$this->Cell(32,10,'Email',1,0,'C');
	$this->Cell(26,10,'Contact Number',1,0,'C');
	$this->Cell(21,10,'Tin Number',1,0,'C');
	$this->Cell(21,10,'Phil Health',1,0,'C');
	$this->Cell(21,10,'SSS Number',1,0,'C');
	$this->Cell(32,10,'Address',1,0,'C');
	$this->Cell(15,10,'Branch',1,0,'C');
	$this->Cell(15,10,'Role',1,0,'C');
	$this->Cell(13,10,'Status',1,0,'C');

	$this->Ln();
}	
function viewTable($db){
	$this->SetFont('Times', '', 9);
	$stmt= $db->query("SELECT employee.employee_id, employee.employee_firstname, employee.employee_lastname, employee.employee_username, employee.employee_email, employee.employee_contactnumber, employee.employee_tinNumber, employee.employee_philHealth, employee.employee_sssNumber, employee.employee_address, branch.branch_id, branch.branch_name, role.role_id, role.role_name, employee.deleteStatus,

                    CASE WHEN employee.deleteStatus = 0 THEN 'Active' ELSE 'Not Active' END AS deleteStatus
                    FROM employee, branch, role
                    WHERE branch.branch_id =employee.branch_id 
                    AND role.role_id = employee.role_id
                    AND role.role_id= 2
                    ORDER BY employee_id ASC");
	while($data= $stmt->fetch(PDO::FETCH_OBJ)){
		$this->Cell(8,10,$data->employee_id,1,0,'L');
	$this->Cell(22,10,$data->employee_firstname,1,0,'L');
	$this->Cell(22,10,$data->employee_lastname,1,0,'L');
	$this->Cell(22,10,$data->employee_username,1,0,'L');
	$this->Cell(32,10,$data->employee_email,1,0,'L');
	$this->Cell(26,10,$data->employee_contactnumber,1,0,'L');
	$this->Cell(21,10,$data->employee_tinNumber,1,0,'L');
	$this->Cell(21,10,$data->employee_philHealth,1,0,'L');
	$this->Cell(21,10,$data->employee_sssNumber,1,0,'L');
    $this->Cell(32,10,$data->employee_address,1,0,'L');
	$this->Cell(15,10,$data->branch_name,1,0,'L');
	$this->Cell(15,10,$data->role_name,1,0,'L');
	$this->Cell(13,10,$data->deleteStatus,1,0,'L');
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

