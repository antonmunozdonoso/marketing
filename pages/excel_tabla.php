<?php

require "../assets/vendor/phpoffice/autoload.php";
require "../modelos/conexion.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

/*foreach ($_POST as $k=>$v){
    echo "La clave es $k y su valor es $v"."<br>";
}*/
extract($_POST);
$numero_id = $_POST['numero_id'];
$columna = 'pd.'.$_POST['columna'].' '.$_POST['columna'];
$array = explode(",", $numero_id);

$indices = array();
array_push($indices, $_POST['columna']);
foreach ($array as $indice => $valor){
    $clave = "columna_$valor" ;
    @$datos .= 'pd.'.$_POST[$clave].' '.$_POST[$clave].',';
    array_push($indices, $_POST[$clave]);
}

unset($indice);
$datos .= $columna;
$datos_p = $datos;
$contador =  count($indices);
$datos = 'SELECT DISTINCT '.$datos_p;


$filtro = " WHERE Date(tor.fecha_pago) BETWEEN '".$fechai."' AND '".$fechaf."' ";

if ($especialidad != 't') {
      
      $filtro .= " AND lop.option_id ='".$especialidad."' ";
    
}

if ($sucursal != 't') {
      
      $filtro .= " AND tor.id_facility ='".$sucursal."' ";
    
}

$datos = $datos. ' FROM patient_data pd
		LEFT JOIN tab_orders tor ON pd.id = tor.id_patient
		LEFT JOIN facility f ON tor.id_facility = f.id
		LEFT JOIN tab_orders_detail tod ON tor.id = tod.id_order
		LEFT JOIN openemr_postcalendar_categories opc ON tod.id_category = opc.pc_catid
		LEFT JOIN list_options lop ON opc.pc_especialidad= lop.option_id AND lop.list_id = "especialidades"
		'.$filtro.' AND tor.id_status = "pagado" 
		AND tor.id_ttransaction = "ingreso" AND pd.email LIKE "%@%" AND pd.email 
		NOT LIKE "notie%@%" AND pd.email NOT LIKE "sin%@%" AND pd.phone_cell IS NOT NULL';
//var_dump($datos);

$stmt = "SELECT DISTINCT $datos_p
		
		$filtro AND tor.id_status = 'pagado' 
		AND tor.id_ttransaction = 'ingreso' AND pd.email LIKE '%@%' AND pd.email 
		NOT LIKE 'notie%@%' AND pd.email NOT LIKE 'sin%@%' AND pd.phone_cell IS NOT NULL";

$stmt = Conexion::conectar()->prepare($datos);
$stmt->execute();
$results = $stmt -> fetchAll(\PDO::FETCH_OBJ);
//var_dump($indices, $contador);

$hoja1 = new Spreadsheet();
$hoja = $hoja1->getActiveSheet();
$hoja->setTitle("Pacientes");

$letra = 'A';

for ($i=1; $i<$contador; $i++) {
    
    $letra++;
}
$letra = $letra.'1';
//echo $letra;
$hoja1->getActiveSheet()->getStyle('A1:'.$letra.'')->getFont()->setBold(true)->setName('Arial')
    ->setSize(13);

$letra = 'A';

foreach ($indices as $key => $value) {
	
	$hoja->setCellValue($letra.'1', $value);
	$letra++;
}
//var_dump($indices);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="excel_pacientes.xlsx"');
header('Cache-Control: max-age=0');

$writer = IOFactory::createWriter($hoja1, 'Xlsx');
$writer->save('php://output');


exit;
     