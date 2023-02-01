<?php

class Conexion{

	static public function conectar(){



		$link = new PDO("mysql:host=localhost;dbname=mixst936_posmixstore",
			            "mixst936",
			            "8BqtF87c8ZDAjA2");


		$link->exec("set names utf8");

		return $link;

	}

}
