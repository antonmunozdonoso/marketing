<?php

require_once "conexion.php";

class Modelosucursales{

	/*=============================================
	 MOSTRAR ESPECIALIDADES
	=============================================*/


    static public function mdlMostrarsucursales($tabla){

		
		$stmt = Conexion::conectar()->prepare("SELECT f.id, f.name FROM $tabla f 
												WHERE f.service_location = 1 ");

		$stmt -> execute();

		return $stmt -> fetchAll();

		
		$stmt -> close();

		$stmt = null;

	}			



}
