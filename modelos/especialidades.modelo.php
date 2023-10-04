<?php

require_once "conexion.php";

class ModeloEspecialidades{

	/*=============================================
	 MOSTRAR ESPECIALIDADES
	=============================================*/


    static public function mdlMostrarEspecialidades($tabla){

		
		$stmt = Conexion::conectar()->prepare("SELECT li.option_id, li.title FROM $tabla li 
												WHERE li.list_id = 'especialidades' ");

		$stmt -> execute();

		return $stmt -> fetchAll();

		
		$stmt -> close();

		$stmt = null;

	}			



}
