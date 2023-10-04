<?php

require_once "conexion.php";

class ModeloUsuarios{

	/*=============================================
	LOGIN USUARIO
	=============================================*/

	static public function mdlMostrarUsuarios($tabla, $tabla2, $usuario){

		$stmt = Conexion::conectar()->prepare("SELECT us.id, us.password FROM $tabla us
												INNER JOIN $tabla2 u ON us.id = u.id	
												WHERE us.username = :usuario AND u.user_group = 2");

		$stmt->bindParam(":usuario", $usuario["usuario"], PDO::PARAM_STR);

		if($stmt->execute()){

			$results = $stmt -> fetchAll(\PDO::FETCH_OBJ);
			
			foreach ($results as $datos) {
                
                $password = $datos->password;
                
            }

            if (isset($password)) {
            	
            	$contrasena = $usuario["contrasena"];
			
				if (password_verify($contrasena, $password)) {
						
					return 'ok';
				
				}else {

					return 'contrasena';
				}
            
            }else {

            	return 'usuario';
        	}
				
		}else{

			return $stmt;
		
		}


		$stmt -> close();

		$stmt = null;
    }

    static public function mdlMostrarUsuarios2($tabla2, $user){

		
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla2 WHERE username = '$user' ");

		$stmt -> execute();

		return $stmt -> fetchAll();

		
		$stmt -> close();

		$stmt = null;

	}			



}
