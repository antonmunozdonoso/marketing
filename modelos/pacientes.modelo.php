<?php

require_once "conexion.php";

class ModeloPacientes{

	/*=============================================
	 MOSTRAR ESPECIALIDADES
	=============================================*/


    static public function mdlMostrarPacientes($tabla){

		
		$stmt = Conexion::conectar()->prepare("SELECT COLUMN_NAME columna from INFORMATION_SCHEMA.COLUMNS 
												WHERE TABLE_NAME = '$tabla' ");

		$stmt -> execute();

		return $stmt -> fetchAll();

		
		$stmt -> close();

		$stmt = null;

	}			



}
