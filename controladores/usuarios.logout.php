<?php 

/*=============================================
SALIR DEL SISTEMA
=============================================*/

	session_start();

	if(isset($_SESSION['username']) && isset($_SESSION['id'])){

		session_destroy();

		header("location:../index.php");

	}else{

		echo"Error";

	}
