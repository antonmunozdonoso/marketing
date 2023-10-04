<?php

require "../assets/vendor/phpoffice/autoload.php";
require "../modelos/conexion.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

extract($_POST);

//echo $fechai.$fechaf.$especialidad.$sucursal.$edadi.$edadf.$sexo;

$filtro = " WHERE Date(tor.fecha_pago) BETWEEN '".$fechai."' AND '".$fechaf."' ";

if ($especialidad != 't') {
      
      $filtro .= " AND lop.option_id ='".$especialidad."' ";
    
}

if ($sucursal != 't') {
      
      $filtro .= " AND tor.id_facility ='".$sucursal."' ";
    
}

if ($edadf != 0) {
      
      $filtro .= " AND TIMESTAMPDIFF(YEAR,pd.DOB,CURDATE()) >='".$edadi."'  AND TIMESTAMPDIFF(YEAR,pd.DOB,CURDATE()) >='".$edadf."' ";
    
}

if ($sexo != 't') {
      
      $filtro .= " AND pd.sex ='".$sexo."' ";
    
}

$stmt = "SELECT DISTINCT pd.email EMAIL, pd.lname SURNAME, pd.fname NOMBRE, 
										pd.phone_cell SMS
										FROM patient_data pd
										LEFT JOIN tab_orders tor ON pd.id = tor.id_patient
										LEFT JOIN facility f ON tor.id_facility = f.id
										LEFT JOIN tab_orders_detail tod ON tor.id = tod.id_order
										LEFT JOIN openemr_postcalendar_categories opc ON tod.id_category = opc.pc_catid
										LEFT JOIN list_options lop ON opc.pc_especialidad= lop.option_id AND lop.list_id = 'especialidades'
										$filtro AND tor.id_status = 'pagado' 
										AND tor.id_ttransaction = 'ingreso' AND pd.email LIKE '%@%' AND pd.email 
										NOT LIKE 'notie%@%' AND pd.email NOT LIKE 'sin%@%' AND pd.phone_cell IS NOT NULL";

$stmt = Conexion::conectar()->prepare($stmt);
$stmt->execute();
$results = $stmt -> fetchAll(\PDO::FETCH_OBJ);

$hoja1 = new Spreadsheet();
$hoja = $hoja1->getActiveSheet();
$hoja->setTitle("Pacientes");

$hoja1->getActiveSheet()->getStyle('A1:D1')->getFont()->setBold(true)->setName('Arial')
    ->setSize(13);

$hoja1->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$hoja1->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$hoja1->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$hoja1->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);


$hoja->setCellValue('A1', 'EMAIL');
$hoja->setCellValue('B1', 'SURNAME');
$hoja->setCellValue('C1', 'NOMBRE');
$hoja->setCellValue('D1', 'SMS');

$fila = 2;



foreach ($results as $value) {
	
	$hoja->setCellValue('A'.$fila, $value->EMAIL);
	$hoja->setCellValue('B'.$fila, $value->SURNAME);
	$hoja->setCellValue('C'.$fila, $value->NOMBRE);
	$hoja->setCellValue('D'.$fila, $value->SMS);
		
	
	$fila++;
}

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="excel_pacientes.xlsx"');
header('Cache-Control: max-age=0');

$writer = IOFactory::createWriter($hoja1, 'Xlsx');
$writer->save('php://output');

//$stmt = null;
exit;
     