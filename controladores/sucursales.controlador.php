<?php

require '../modelos/sucursales.modelo.php';

class ControladorSucursales{

	/*=============================================
	MOSTRAR Especialidades
	=============================================*/

	static public function ctrMostrarSucursales(){

		$tabla = "facility";

		$respuesta = ModeloSucursales::mdlMostrarSucursales($tabla);
		
		return $respuesta;
	
	}


}

	
	


