<?php

require '../modelos/columnas.modelo.php';

class ControladorColumnas{

	/*=============================================
	MOSTRAR COLUMNAS
	=============================================*/

	static public function ctrMostrarColumnas(){

		$tabla = "patient_data";

		$respuesta = ModeloColumnas::mdlMostrarColumnas($tabla);
		
		return $respuesta;
	
	}


}

	
	


