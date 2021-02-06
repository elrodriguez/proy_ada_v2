<?php
	class Modelo_usuario
	{
		private $conexion;
		function __construct()
		{
			require_once('modelo_conexion.php');
			$this->conexion = new conexion();
			$this->conexion->conectar();
		}
		function Verificar_usuario($usuario,$pass){
			$sql = "call PA_VERIFICARUSUARIO('$usuario','$pass')";
			echo $sql;exit;
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {
				while ($consulta_VU = mysqli_fetch_array($consulta)) {
					$arreglo[] = $consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();	
			}
		}
		function buscar_adminsitrador($buscar){
			$sql = "call PA_BUSCARADMINISTRADOR('$buscar')";	
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {

				while ($consulta_VU = mysqli_fetch_array($consulta)) {
					$arreglo[] = $consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();	
			}
		}
		function editar_usuario($usuario,$actual,$nueva){
			$sql = "call PA_EDITARUSUARIO('$usuario','$actual','$nueva')";
			if ($resultado = $this->conexion->conexion->query($sql)){
				return 1;
			}
			else{
				return 0;
			}
			$this->conexion->Cerrar_Conexion();
		}
		function editar_personal($codigo,$nombre,$apePat,$apeMat,$email,$telefo,$movil,$direc,$fecha,$dni){
			$sql ="call PA_EDITARPERSONAL('$codigo','$nombre','$apePat','$apeMat','$email','$telefo','$movil','$direc','$fecha','$dni')";
			if ($resultado=$this->conexion->conexion->query($sql)){
				return 1;
			}else{
				return 0;
			}
			$this->conexion->Cerrar_Conexion();
		}
	}
?>