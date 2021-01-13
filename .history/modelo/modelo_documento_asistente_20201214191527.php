<?php
	class Modelo_documento
	{
		private $conexion;

		function __construct()
		{
			require_once('modelo_conexion.php');
			$this->conexion = new conexion();
			$this->conexion->conectar();
		}
					function listar_codigodocumento(){
							$sql = "select COUNT(*) from documento";
							$arreglo = array();
							if ($consulta = $this->conexion->conexion->query($sql)) {

								while ($consulta_VU = mysqli_fetch_array($consulta)) {
									$arreglo[] = $consulta_VU;
								}
								return $arreglo;
								$this->conexion->cerrar();
							}
					}

		function Registrar_documento_asistente($iddocumento,$asunto,$idnumero,$idtipodocu,$idasesor,$idarea,$idremitente,$idusuario,$opcion,$destinoImagen,$cont,$modalidad){
			$sql = "call PA_REGISTRARDOCUMENTOARCHIVO('$iddocumento','$asunto','$idnumero','$idtipodocu','$idasesor','$idarea','$idremitente','$idusuario','$opcion','$destinoImagen','$cont','$modalidad')";
			//echo $sql;exit;
			if ($resultado = $this->conexion->conexion->query($sql)){
				return 1;
			}
			else{
				return 0;
			}
			$this->conexion->Cerrar_Conexion();
		}

		function subir_documento_turniting($iddocumento,$porcentaje,$destinoImagen){
			$sql = "call PA_SUBIRARCHIVOTURNITING('$iddocumento','$porcentaje','$destinoImagen')";
			//print_r($sql);exit;
			if ($resultado = $this->conexion->conexion->query($sql)){
				return 1;
			}
			else{
				return 0;
			}
			$this->conexion->Cerrar_Conexion();
		}
		function obtenerporcentajeturniting($codigo){
			$sql = "CALL PA_obtenerporcentajeturniting('$codigo')";
			//echo $sql;exit;
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {

				while ($consulta_VU = mysqli_fetch_array($consulta)) {
					$arreglo[] = $consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();
			}
		}
		function Editar_institucion($codigo,$institucion,$tipo,$estado){
			$sql = "call PA_EDITARINSTITUCION('$codigo','$institucion','$tipo','$estado')";
			if ($resultado = $this->conexion->conexion->query($sql)){
				return 1;
			}
			else{
				return 0;
			}
			$this->conexion->Cerrar_Conexion();
		}
		function listar_documento($valor, $inicio=FALSE,$limite=FALSE){
			if ($inicio!==FALSE && $limite!==FALSE) {
			    $sql = "SELECT documento.documento_cod, documento.doc_asunto,documento.doc_fecha_recepcion,tipo_documento.tipodo_descripcion,area.area_nombre,documento.doc_estado,documento.doc_tipo,area.area_cod,tipo_documento.tipodocumento_cod,IFNULL(documento.doc_documento,''),CONCAT(asesor.nombre,' ',asesor.apellido_pater,' ',asesor.apellido_mater) AS asesor_full_name,documento.archivo_turniting,documento.porcentaje FROM documento INNER JOIN tipo_documento ON documento.tipoDocumento_cod = tipo_documento.tipodocumento_cod INNER JOIN area ON documento.area_cod = area.area_cod INNER JOIN asesor ON documento.asesor_cod = asesor.asesor_cod WHERE documento.documento_cod LIKE '".$valor."%' ORDER BY documento.documento_cod DESC LIMIT $inicio,$limite";
			}else{
			    $sql = "SELECT documento.documento_cod, documento.doc_asunto,documento.doc_fecha_recepcion,tipo_documento.tipodo_descripcion,area.area_nombre,documento.doc_estado,documento.doc_tipo,area.area_cod,tipo_documento.tipodocumento_cod,IFNULL(documento.doc_documento,''),CONCAT(asesor.nombre,' ',asesor.apellido_pater,' ',asesor.apellido_mater) AS asesor_full_name,documento.archivo_turniting,documento.porcentaje FROM documento INNER JOIN tipo_documento ON documento.tipoDocumento_cod = tipo_documento.tipodocumento_cod INNER JOIN area ON documento.area_cod = area.area_cod INNER JOIN asesor ON documento.asesor_cod = asesor.asesor_cod WHERE documento.documento_cod LIKE '".$valor."%' ORDER BY documento.documento_cod DESC";
			}
			//echo $sql;exit;
			$resultado =  $this->conexion->conexion->query($sql);
			$arreglo = array();
			while($consulta_VU=mysqli_fetch_array($resultado)){ ///MYSQL_BOTH, MYSQL_ASSOC, MYSQL_NUM
			    $arreglo[] = $consulta_VU;
			}
			return $arreglo;
			$this->conexion->cerrar();
 		}
 		function traerremitenteciudadano_documento($codigo){
				$sql = "SELECT CONCAT_WS(' ',ciudadano.ciud_nombres,ciudadano.ciud_apellidoPate,ciudadano.ciud_apellidoMate), ciudadano.ciud_dni,ciudadano.ciud_telefono FROM detalle_ciudadano INNER JOIN ciudadano ON detalle_ciudadano.ciudadano_cod = ciudadano.ciudadano_cod where detalle_ciudadano.documento_cod = '$codigo'";
				$arreglo = array();
				if ($consulta = $this->conexion->conexion->query($sql)) {

					while ($consulta_VU = mysqli_fetch_array($consulta)) {
						$arreglo[] = $consulta_VU;
					}
					return $arreglo;
					$this->conexion->cerrar();
				}
		}
		function traerremitenteinstitucion_documento($codigo){
				$sql = "SELECT institucion.inst_nombre, institucion.inst_tipoinstitucion FROM detalle_institucion INNER JOIN institucion ON detalle_institucion.institucion_cod = institucion.institucion_cod WHERE detalle_institucion.documento_cod = '$codigo'";
				$arreglo = array();
				if ($consulta = $this->conexion->conexion->query($sql)) {
					while ($consulta_VU = mysqli_fetch_array($consulta)) {
						$arreglo[] = $consulta_VU;
					}
					return $arreglo;
					$this->conexion->cerrar();
				}
		}
		function listar_documentopendiente($valor, $inicio=FALSE,$limite=FALSE){
			if ($inicio!==FALSE && $limite!==FALSE) {
			    $sql = "SELECT documento.documento_cod, documento.doc_asunto,documento.doc_fecha_recepcion,tipo_documento.tipodo_descripcion,area.area_nombre,documento.doc_estado,documento.doc_tipo,area.area_cod,tipo_documento.tipodocumento_cod,IFNULL(documento.doc_documento,'') FROM documento INNER JOIN tipo_documento ON documento.tipoDocumento_cod = tipo_documento.tipodocumento_cod INNER JOIN area ON documento.area_cod = area.area_cod WHERE documento.doc_estado LIKE '".$valor."%' ORDER BY documento.documento_cod DESC LIMIT $inicio,$limite";
			}else{
			    $sql = "SELECT documento.documento_cod, documento.doc_asunto,documento.doc_fecha_recepcion,tipo_documento.tipodo_descripcion,area.area_nombre,documento.doc_estado,documento.doc_tipo,area.area_cod,tipo_documento.tipodocumento_cod,IFNULL(documento.doc_documento,'') FROM documento INNER JOIN tipo_documento ON documento.tipoDocumento_cod = tipo_documento.tipodocumento_cod INNER JOIN area ON documento.area_cod = area.area_cod WHERE documento.doc_estado LIKE '".$valor."%' ORDER BY documento.documento_cod DESC";
			}
			$resultado =  $this->conexion->conexion->query($sql);
			$arreglo = array();
			while($consulta_VU=mysqli_fetch_array($resultado)){ ///MYSQL_BOTH, MYSQL_ASSOC, MYSQL_NUM
			    $arreglo[] = $consulta_VU;
			}
			return $arreglo;
			$this->conexion->cerrar();
 		}
		function listar_documentopendiente_asistente($valor, $inicio=FALSE,$limite=FALSE){
			if ($inicio!==FALSE && $limite!==FALSE) {
					$sql = "SELECT documento.documento_cod, documento.doc_asunto,documento.doc_fecha_recepcion,tipo_documento.tipodo_descripcion,area.area_nombre,documento.doc_estado,documento.doc_tipo,area.area_cod,tipo_documento.tipodocumento_cod,IFNULL(documento.doc_documento,'') FROM documento INNER JOIN tipo_documento ON documento.tipoDocumento_cod = tipo_documento.tipodocumento_cod INNER JOIN area ON documento.area_cod = area.area_cod WHERE documento.doc_estado LIKE '".$valor."%'AND documento.num_proceso='2'ORDER BY documento.documento_cod DESC LIMIT $inicio,$limite";
			}else{
					$sql = "SELECT documento.documento_cod, documento.doc_asunto,documento.doc_fecha_recepcion,tipo_documento.tipodo_descripcion,area.area_nombre,documento.doc_estado,documento.doc_tipo,area.area_cod,tipo_documento.tipodocumento_cod,IFNULL(documento.doc_documento,'') FROM documento INNER JOIN tipo_documento ON documento.tipoDocumento_cod = tipo_documento.tipodocumento_cod INNER JOIN area ON documento.area_cod = area.area_cod WHERE documento.doc_estado LIKE '".$valor."%' ORDER BY documento.documento_cod DESC";
			}
			$resultado =  $this->conexion->conexion->query($sql);
			$arreglo = array();
			while($consulta_VU=mysqli_fetch_array($resultado)){ ///MYSQL_BOTH, MYSQL_ASSOC, MYSQL_NUM
					$arreglo[] = $consulta_VU;
			}
			return $arreglo;
			$this->conexion->cerrar();
		}
 		function Aceptar_documento($iddocumento){
			$sql = "UPDATE documento SET doc_estado = 'ACEPTADO', num_proceso='3' WHERE documento_cod = '$iddocumento'" ;
			if ($resultado = $this->conexion->conexion->query($sql)){
				return 1;
			}
			else{
				return 0;
			}
			$this->conexion->Cerrar_Conexion();
		}
		function Aceptar_documento_asistente($iddocumento){
			$sql = "UPDATE documento SET doc_estado = 'PENDIENTE', num_proceso='2' WHERE documento_cod = '$iddocumento'" ;
			if ($resultado = $this->conexion->conexion->query($sql)){
				return 1;
			}
			else{
				return 0;
			}
			$this->conexion->Cerrar_Conexion();
		}
		
		function Rechazado_documento($iddocumento){
			$sql = "UPDATE documento SET doc_estado = 'RECHAZADO' WHERE documento_cod = '$iddocumento'";
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
