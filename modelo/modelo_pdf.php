<?php
	class Modelo_pdf
	{
		private $conexion;
		function __construct()
		{
			require_once('modelo_conexion.php');
			$this->conexion = new conexion();
			$this->conexion->conectar();
		}

		function Editar_pdf($codigo,$nombre,$apePat,$apeMat,$telefo,$movil,$direc,$fecha,$nrodocume,$email,$estado){
			$sql = "call PA_EDITARPERSONALTODOS('$codigo','$nombre','$apePat','$apeMat','$telefo','$movil','$direc','$fecha','$nrodocume','$email','$estado')";
			if ($resultado = $this->conexion->conexion->query($sql)){
				return 1;
			}
			else{
				return 0;
			}
			$this->conexion->Cerrar_Conexion();
		}

	}
?>
