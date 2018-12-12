<!--print delivery date (filtered) report-->
<?php
ob_start();
session_start();

require ("fpdf/fpdf.php");
$db= new PDO('mysql:host=localhost;dbname=finaltanciongs','root','');


class myPDF extends FPDF{
	function header(){
	$this->Image('pic.png',93,1,29);
	$this->SetFont('Arial', 'B', 20);
	$this->Cell(276,8, 'Report Module', 0,0, 'C');
	$this->Ln();
	$this->SetFont('Times', '', 18);
	$this->Cell(276,10,'Sales By Date Report', 0, 0, 'C');
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
	$this->Cell(20,10,'Day',1,0,'C');
	$this->Cell(30,10,'Employee Name',1,0,'C');
	$this->Cell(20,10,'Branch',1,0,'C');
	$this->Cell(35,10,'Sales for the Day',1,0,'C');
	$this->Cell(30,10,'Beginning Fund',1,0,'C');
	//$this->Cell(20,10,'Profit',1,0,'C');

	$this->Ln();
}	
function viewTable($db){
	$this->SetFont('Times', '', 10);
//if(isset($_GET['generate']) || true){
if(1==1){                  

if(isset($_SESSION['start']) && isset($_SESSION['end'])){ 
						$stringQuery1 = "SELECT sales.sales_id, sales.sales_datetime, employee.employee_id, employee.employee_firstname, sales.changefund, sales.total_sales, branch.branch_id, branch.branch_name

                    FROM sales, employee, branch
                    WHERE sales.employee_id= employee.employee_id AND employee.branch_id= branch.branch_id
                    AND sales.sales_datetime >= '$_SESSION[start]'
            AND sales.sales_datetime <= '$_SESSION[end]' 

                    ORDER BY sales_id ASC";
                       $stmt= $db->query($stringQuery1);
                      // echo $stringQuery1;
                            // echo $stringQuery1;
                       
 

    while($data= $stmt->fetch(PDO::FETCH_OBJ)){
	$this->Cell(10,10,$data->sales_id,1,0,'L');
	$this->Cell(32,10,$data->sales_datetime,1,0,'L');

	$date= $data ->sales_datetime;
    $day= date('l', strtotime($date));

    $this->Cell(20,10,$day,1,0,'L');
	$this->Cell(30,10,$data->employee_firstname,1,0,'L');
	$this->Cell(20,10,$data->branch_name,1,0,'L');
	$this->Cell(35,10,$data->total_sales,1,0,'L');
	$this->Cell(30,10,$data->changefund,1,0,'L');
	
	

	$this->Ln();
}
    
     }else {
     	


 						$stringQuery = "SELECT sales.sales_id, sales.sales_datetime, employee.employee_id, employee.employee_firstname, sales.changefund, sales.total_sales, branch.branch_id, branch.branch_name

                    FROM sales, employee, branch
                    WHERE sales.employee_id= employee.employee_id AND employee.branch_id= branch.branch_id
                     
                    ORDER BY sales_id ASC";
                        $stmt= $db->query($stringQuery);
                        }

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
$pdf->Cell(0,10, "Start Date:" .$_SESSION['start']);
$pdf->Ln();
$pdf->Cell(0,10, "End Date:" .$_SESSION['end']);
$pdf->Ln();

date_default_timezone_set("Asia/Manila");
$pdf->Cell(0,10,'Date & Time Printed:  '. date("M d Y").' '.date("h:i:sa"), 0,0);



$pdf->output();
ob_end_flush(); 

?>

