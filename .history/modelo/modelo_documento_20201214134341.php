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

		function Registrar_documento($iddocumento,$asunto,$idnumero,$idtipodocu,$idasesor,$idarea,$idremitente,$idusuario,$opcion,$destinoImagen,$cont){
			$sql = "call PA_REGISTRARDOCUMENTOARCHIVO('$iddocumento','$asunto','$idnumero','$idtipodocu','$idasesor','$idarea','$idremitente','$idusuario','$opcion','$destinoImagen','$cont')";
			if ($resultado = $this->conexion->conexion->query($sql)){
				return 1;
			}
			else{
				return 0;
			}
			$this->conexion->Cerrar_Conexion();
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
			    $sql = "SELECT documento.documento_cod, documento.doc_asunto,documento.doc_fecha_recepcion,tipo_documento.tipodo_descripcion,area.area_nombre,documento.doc_estado,documento.doc_tipo,area.area_cod,tipo_documento.tipodocumento_cod,IFNULL(documento.doc_documento,''),CONCAT(t5.nombre,' ',t5.apellido_pater,' ',t5.apellido_mater) AS asesor_full_name FROM documento INNER JOIN tipo_documento ON documento.tipoDocumento_cod = tipo_documento.tipodocumento_cod INNER JOIN area ON documento.area_cod = area.area_cod INNER JOIN asesor AS t5 ON documento.asesor_cod=t5.asesor_cod WHERE documento.documento_cod LIKE '".$valor."%' ORDER BY documento.documento_cod DESC LIMIT $inicio,$limite";
			}else{
			    $sql = "SELECT documento.documento_cod, documento.doc_asunto,documento.doc_fecha_recepcion,tipo_documento.tipodo_descripcion,area.area_nombre,documento.doc_estado,documento.doc_tipo,area.area_cod,tipo_documento.tipodocumento_cod,IFNULL(documento.doc_documento,''),CONCAT(t5.nombre,' ',t5.apellido_pater,' ',t5.apellido_mater) AS asesor_full_name FROM documento INNER JOIN tipo_documento ON documento.tipoDocumento_cod = tipo_documento.tipodocumento_cod INNER JOIN area ON documento.area_cod = area.area_cod INNER JOIN asesor AS t5 ON documento.asesor_cod=t5.asesor_cod WHERE documento.documento_cod LIKE '".$valor."%' ORDER BY documento.documento_cod DESC";
			}
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
		function traer_revisor($codigo){
			$sql = "SELECT asesor_cod,nombre,apellido_pater,apellido_mater,dni,celular,(SELECT COUNT(asesor_cod) FROM documento_revisor AS t2 WHERE t2.asesor_cod=t1.asesor_cod AND t2.documento_cod='".$codigo."') AS revisor FROM asesor AS t1 INNER JOIN asesor_tipo_detalle AS t4 ON t1.asesor_cod = t4.id_asesor WHERE t4.id_tipo = 2;";
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
		function listar_revisor($codigo){
			$sql = "SELECT t1.id,t2.nombre,t2.apellido_pater,t2.apellido_mater,t2.dni,t2.celular FROM documento_revisor AS t1 INNER JOIN asesor AS t2 ON t1.asesor_cod=t2.asesor_cod WHERE documento_cod='".$codigo."';";
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
		function eliminar_revisor($id){
			$sql = "DELETE FROM documento_revisor WHERE id = '$id';";
			if ($resultado = $this->conexion->conexion->query($sql)){
				return 1;
			}
			else{
				return 0;
			}
			$this->conexion->Cerrar_Conexion();
		}
		function registrar_revisor($iddocumento,$revisor){
			$fecha = date('Y-m-d');
			$sql = "INSERT INTO documento_revisor (documento_cod,asesor_cod,fecha_registro) VALUES ('$iddocumento','$revisor','$fecha')";
			if ($resultado = $this->conexion->conexion->query($sql)){
				return 1;
			}
			else{
				return 0;
			}
			$this->conexion->Cerrar_Conexion();
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
