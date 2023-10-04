<?php

require 'modelos/login.modelo.php';

class ControladorUsuarios{

	/*=============================================
	INGRESO DE USUARIO
	=============================================*/

	static public function ctrLogin(){

		if(isset($_POST["usuario"]) && isset($_POST["contrasena"])){

			if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["usuario"]) ){

			   	$tabla = "users_secure";
			   	$tabla2 = "users";
			   	$user = $_POST["usuario"];
				$datos = array("usuario" => $_POST["usuario"],
					           "contrasena" => $_POST["contrasena"]);

				$respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $tabla2, $datos);

				if($respuesta == 'ok'){

					
					$respuesta = ModeloUsuarios::MdlMostrarUsuarios2($tabla2, $user);

					session_start();
					$_SESSION["iniciarSesion"] = "ok";
					$_SESSION["username"] = $respuesta[0]['username'];
		            $_SESSION['id'] = $respuesta[0]['id'];
		            $_SESSION['fname'] = $respuesta[0]['fname'];
		            $_SESSION['lname'] = $respuesta[0]['lname'];
		            $_SESSION['ss'] = $respuesta[0]['federaltaxid'];
		            $_SESSION['birthday'] = $respuesta[0]['birthday'];
					

					/*=============================================
					REGISTRAR FECHA PARA SABER EL ÚLTIMO LOGIN
					=============================================*/

					date_default_timezone_set('America/Santiago');

					
						echo '<script>

							window.location = "pages/inicio.php";

						</script>';
		

				}elseif ($respuesta == 'contrasena') {
					

					echo '<br><div class="alert alert-danger" style="color: white;">Error al ingresar Contraseña</div>';

				}elseif ($respuesta == 'usuario') {
					

					echo '<br><div class="alert alert-danger" style="color: white;">Error al ingresar Usuario</div>';

				}

			}	

		}

	}




}

	
	


