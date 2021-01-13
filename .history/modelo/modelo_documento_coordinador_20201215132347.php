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
			    $sql = "SELECT documento.documento_cod, documento.doc_asunto,documento.doc_fecha_recepcion,tipo_documento.tipodo_descripcion,area.area_nombre,documento.doc_estado,documento.doc_tipo,area.area_cod,tipo_documento.tipodocumento_cod,IFNULL(documento.doc_documento,''),CONCAT(t5.nombre,' ',t5.apellido_pater,' ',t5.apellido_mater) AS asesor_full_name,porcentaje,archivo_turniting,paso FROM documento INNER JOIN tipo_documento ON documento.tipoDocumento_cod = tipo_documento.tipodocumento_cod INNER JOIN area ON documento.area_cod = area.area_cod INNER JOIN asesor AS t5 ON documento.asesor_cod=t5.asesor_cod WHERE documento.num_proceso='2' AND documento.documento_cod LIKE '".$valor."%' ORDER BY documento.documento_cod DESC LIMIT $inicio,$limite";
			}else{
			    $sql = "SELECT documento.documento_cod, documento.doc_asunto,documento.doc_fecha_recepcion,tipo_documento.tipodo_descripcion,area.area_nombre,documento.doc_estado,documento.doc_tipo,area.area_cod,tipo_documento.tipodocumento_cod,IFNULL(documento.doc_documento,''),CONCAT(t5.nombre,' ',t5.apellido_pater,' ',t5.apellido_mater) AS asesor_full_name,porcentaje,archivo_turniting,paso FROM documento INNER JOIN tipo_documento ON documento.tipoDocumento_cod = tipo_documento.tipodocumento_cod INNER JOIN area ON documento.area_cod = area.area_cod INNER JOIN asesor AS t5 ON documento.asesor_cod=t5.asesor_cod WHERE documento.num_proceso='2' AND documento.documento_cod LIKE '".$valor."%' ORDER BY documento.documento_cod DESC";
			}
			$resultado =  $this->conexion->conexion->query($sql);
			$arreglo = array();
			while($consulta_VU=mysqli_fetch_array($resultado)){ ///MYSQL_BOTH, MYSQL_ASSOC, MYSQL_NUM
			    $arreglo[] = $consulta_VU;
			}
			return $arreglo;
			$this->conexion->cerrar();
		 }
		 function listar_documento_revisor($valor, $inicio=FALSE,$limite=FALSE){
			if ($inicio!==FALSE && $limite!==FALSE) {
			    $sql = "SELECT documento.documento_cod, documento.doc_asunto,documento.doc_fecha_recepcion,tipo_documento.tipodo_descripcion,area.area_nombre,documento.doc_estado,documento.doc_tipo,area.area_cod,tipo_documento.tipodocumento_cod,IFNULL(documento.doc_documento,''),CONCAT(t5.nombre,' ',t5.apellido_pater,' ',t5.apellido_mater) AS asesor_full_name,porcentaje,archivo_turniting,paso,fecha_revisor_correo,fecha_final,TIMESTAMPDIFF(DAY, NOW(), fecha_final) AS dias_restantes,anexo_uno,anexo_seis,estado_paso_tres FROM documento INNER JOIN tipo_documento ON documento.tipoDocumento_cod = tipo_documento.tipodocumento_cod INNER JOIN area ON documento.area_cod = area.area_cod INNER JOIN asesor AS t5 ON documento.asesor_cod=t5.asesor_cod WHERE documento.num_proceso='3' AND documento.documento_cod LIKE '".$valor."%' ORDER BY documento.documento_cod DESC LIMIT $inicio,$limite";
			}else{
			    $sql = "SELECT documento.documento_cod, documento.doc_asunto,documento.doc_fecha_recepcion,tipo_documento.tipodo_descripcion,area.area_nombre,documento.doc_estado,documento.doc_tipo,area.area_cod,tipo_documento.tipodocumento_cod,IFNULL(documento.doc_documento,''),CONCAT(t5.nombre,' ',t5.apellido_pater,' ',t5.apellido_mater) AS asesor_full_name,porcentaje,archivo_turniting,paso,fecha_revisor_correo,fecha_final,TIMESTAMPDIFF(DAY, NOW(), fecha_final) AS dias_restantes,anexo_uno,anexo_seis,estado_paso_tres FROM documento INNER JOIN tipo_documento ON documento.tipoDocumento_cod = tipo_documento.tipodocumento_cod INNER JOIN area ON documento.area_cod = area.area_cod INNER JOIN asesor AS t5 ON documento.asesor_cod=t5.asesor_cod WHERE documento.num_proceso='3' AND documento.documento_cod LIKE '".$valor."%' ORDER BY documento.documento_cod DESC";
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
		function obtenerporcentajeturniting($codigo){
			$sql = "CALL PA_obtenerporcentajeturniting('$codigo');";
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
		function cambiar_paso_documento($iddocumento,$paso,$estado){
			$sql = "CALL PA_EDITAR_PASO_DOCUMENTO('$paso','$estado','$iddocumento');";
			//echo $sql;exit;
			if ($resultado = $this->conexion->conexion->query($sql)){
				return 1;
			}
			else{
				return 0;
			}
			$this->conexion->Cerrar_Conexion();
		}
		function obtener_revisores($codigo){
			$sql = "CALL PA_LISTAR_REVISORES_DOCUMENTO('$codigo')";
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
		function subir_documento_anexos($iddocumento,$destino1,$destino6){
			$sql = "call PA_SUBIRARCHIVOANEXOS('$iddocumento','$destino1','$destino6')";
			//print_r($sql);exit;
			if ($resultado = $this->conexion->conexion->query($sql)){
				return 1;
			}
			else{
				return 0;
			}
			$this->conexion->Cerrar_Conexion();
		}
		function aprobar_observar_documento($iddocumento,$estado){
			$sql = "UPDATE documento SET estado_paso_tres = '$estado' WHERE documento_cod = '$iddocumento'";
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
