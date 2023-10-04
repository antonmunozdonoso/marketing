<?php

class Conexion{

	static public function conectar(){

		$link = new PDO("mysql:host=localhost;dbname=alma16",
			            "alma",
			            "Omega001");

		$link->exec("set names utf8");

		return $link;

	}

}