<?php
	class Modelo_asesor
	{
		private $conexion;
		function __construct()
		{
			require_once('modelo_conexion.php');
			$this->conexion = new conexion();
			$this->conexion->conectar();
		}
		function Registrar_areas($area){
			$sql = "call PA_REGISTRARAREA('$area')";
			if ($resultado = $this->conexion->conexion->query($sql)){
				return 1;
			}
			else{
				return 0;
			}
			$this->conexion->Cerrar_Conexion();
		}
		function Editar_areas($codigo,$area,$estado){
			$sql = "call PA_EDITARAREA('$codigo','$area','$estado')";
			if ($resultado = $this->conexion->conexion->query($sql)){
				return 1;
			}
			else{
				return 0;
			}
			$this->conexion->Cerrar_Conexion();
		}
		function listar_areas($valor, $inicio=FALSE,$limite=FALSE){
			if ($inicio!==FALSE && $limite!==FALSE) {
			    $sql = "SELECT * FROM asesor where nombre like '".$valor."%' ORDER BY asesor_cod DESC LIMIT $inicio,$limite";
			}else{
			    $sql = "SELECT * FROM asesor where nombre like '".$valor."%' ORDER BY asesor_cod DESC";
			}
			$resultado =  $this->conexion->conexion->query($sql);
			$arreglo = array();
			while($consulta_VU=mysqli_fetch_array($resultado)){ ///MYSQL_BOTH, MYSQL_ASSOC, MYSQL_NUM
			    $arreglo[] = $consulta_VU;
			}
			return $arreglo;
			$this->conexion->cerrar();
 		}
 		function buscar_dni($dni){
				$sql = "SELECT * from personal where pers_dni = '$dni'";

				$arreglo = array();
				if ($consulta = $this->conexion->conexion->query($sql)) {

					while ($consulta_VU = mysqli_fetch_array($consulta)) {
						$arreglo[] = $consulta_VU;
					}
					return $arreglo;
					$this->conexion->cerrar();
				}
		}

			function listar_asesor(){
					$sql = "SELECT * FROM asesor WHERE asesor_estado = 'ACTIVO' ORDER BY asesor_cod DESC";

					$arreglo = array();
					if ($consulta = $this->conexion->conexion->query($sql)) {

						while ($consulta_VU = mysqli_fetch_array($consulta)) {
							$arreglo[] = $consulta_VU;
						}
						return $arreglo;
						$this->conexion->cerrar();
					}
			}
	}
?>
