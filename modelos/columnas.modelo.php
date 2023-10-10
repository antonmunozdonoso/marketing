<?php

require_once "conexion.php";

class ModeloColumnas{

	/*=============================================
	 MOSTRAR COLUMNAS
	=============================================*/


    static public function mdlMostrarColumnas($tabla){

		
		$stmt = Conexion::conectar()->prepare("SELECT COLUMN_NAME columna from INFORMATION_SCHEMA.COLUMNS 
												WHERE TABLE_NAME = '$tabla' ");

		$stmt -> execute();

		return $stmt -> fetchAll();

		
		$stmt -> close();

		$stmt = null;

	}			



}
