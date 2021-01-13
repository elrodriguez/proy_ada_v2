<?php
	class Modelo_TipoDocumento
	{
		private $conexion;
		function __construct()
		{
			require_once('modelo_conexion.php');
			$this->conexion = new conexion();
			$this->conexion->conectar();
		}
		function Registrar_TipoDocumento($descripcion){
			$sql = "call PA_REGISTRARTIPODOCUMENTO('$descripcion')";
			if ($resultado = $this->conexion->conexion->query($sql)){
				return 1;
			}
			else{
				return 0;
			}
			$this->conexion->Cerrar_Conexion();
		}
		function listar_TipoDocumento($valor, $inicio=FALSE,$limite=FALSE){
			if ($inicio!==FALSE && $limite!==FALSE) {
			    $sql = "SELECT * FROM tipo_documento td where td.tipodo_descripcion like '".$valor."%' ORDER BY td.tipodocumento_cod DESC LIMIT $inicio,$limite";
			}else{
			    $sql = "SELECT * FROM tipo_documento td where td.tipodo_descripcion like '".$valor."%' ORDER BY td.tipodocumento_cod DESC";
			}
			$resultado =  $this->conexion->conexion->query($sql);
			$arreglo = array();
			while($consulta_VU=mysqli_fetch_array($resultado)){ ///MYSQL_BOTH, MYSQL_ASSOC, MYSQL_NUM
			    $arreglo[] = $consulta_VU;
			}
			return $arreglo;
			$this->conexion->cerrar();	
		}
		function editar_tipodocumento($codigo,$descri,$estado){
			$sql = "CALL PA_EDITARTIPODOCUMENTO('$codigo','$descri','$estado')";
			if ($resultado = $this->conexion->conexion->query($sql)){
				return 1;
			}
			else{
				return 0;
			}
			$this->conexion->Cerrar_Conexion();
		}
		function listar_combotipodocumento(){
				$sql = "SELECT * FROM tipo_documento WHERE tipodo_estado = 'ACTIVO' ORDER BY tipodocumento_cod DESC";
				
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