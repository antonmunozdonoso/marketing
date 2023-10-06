<?php 
require_once('../modelos/conexion.php');


$especialidad ="SELECT COLUMN_NAME columna from INFORMATION_SCHEMA.COLUMNS 
				WHERE TABLE_NAME = 'patient_data' ";

$stmt = Conexion::conectar()->prepare($especialidad);
$result = $stmt->execute();
$rows = $stmt->fetchAll(\PDO::FETCH_OBJ);
echo(json_encode($rows));
?>