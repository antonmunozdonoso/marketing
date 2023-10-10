<?php

require_once "../controladores/columnas.controlador.php";

class AjaxColumnas{

	/*=============================================
	 LEER COLUMNAS TABLA
	=============================================*/	

	public function ajaxMostrarColumnas(){

		$tabla = "patient_data";
		
		$respuesta = ControladorColumnas::ctrMostrarColumnas();

		echo json_encode($respuesta);

	}

	
}

if(isset($_POST["columnas"])){

	//var_dump($_POST["columnas"]);
	$valColumnas = new AjaxColumnas();
	$valColumnas -> ajaxMostrarColumnas();

}