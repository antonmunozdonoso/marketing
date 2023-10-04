<?php

require '../modelos/especialidades.modelo.php';

class ControladorEspecialidades{

	/*=============================================
	MOSTRAR Especialidades
	=============================================*/

	static public function ctrMostrarEspecialidades(){

		$tabla = "list_options";

		$respuesta = ModeloEspecialidades::mdlMostrarEspecialidades($tabla);
		
		return $respuesta;
	
	}


}

	
	


