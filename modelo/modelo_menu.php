<?php
	class Modelo_menu
	{
		private $conexion;
		function __construct()
		{
			require_once('modelo_conexion.php');
			$this->conexion = new conexion();
			$this->conexion->conectar();
		}
		function listar_documentos_pendientes(){
			$sql = "SELECT documento.doc_fecha_recepcion,documento.doc_estado,area.area_nombre,tipo_documento.tipodo_descripcion FROM documento INNER JOIN area ON documento.area_cod = area.area_cod INNER JOIN tipo_documento ON documento.tipoDocumento_cod = tipo_documento.tipodocumento_cod where documento.doc_estado = 'PENDIENTE' ORDER BY documento.documento_cod DESC ";
			
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