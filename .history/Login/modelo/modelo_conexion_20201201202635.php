<?php
	class conexion{
		private $servidor;
		private $usuario;
		private $contraseña;
		private $basedatos;
		public $conexion;
		public function __construct(){
			$this->servidor = "localhost";
			$this->usuario = "root";
<<<<<<< HEAD
			$this->contrasena = "hiworld2018";
			$this->basedatos = "bd_tramite";
=======
			$this->contrasena = "";
			$this->basedatos = "mydb";
>>>>>>> 67aa91e971024f98d5e28e1fed97c0872eb65470
		}
		function conectar(){
			$this->conexion = new mysqli($this->servidor,$this->usuario,$this->contrasena,$this->basedatos);
			$this->conexion->set_charset("utf8");
		}
		function cerrar(){
			$this->conexion->close();
		}
	}
?>
