<?php

require '../modelos/pacientes.modelo.php';

class ControladorPacientes{

	/*=============================================
	MOSTRAR Especialidades
	=============================================*/

	static public function ctrMostrarPacientes(){

		$tabla = "patient_data";

		$respuesta = ModeloPacientes::mdlMostrarPacientes($tabla);
		
		return $respuesta;
	
	}


}

	
	


