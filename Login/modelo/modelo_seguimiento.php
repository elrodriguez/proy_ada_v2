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
		function listar_documentoseguimiento($valor, $inicio=FALSE,$limite=FALSE){
			session_start();
			$ciudadano = $_SESSION['alumno'];

			if ($inicio!==FALSE && $limite!==FALSE) {
			    $sql = "SELECT documento.documento_cod, documento.doc_asunto,documento.doc_fecha_recepcion,tipo_documento.tipodo_descripcion,area.area_nombre,documento.doc_estado,documento.doc_tipo,area.area_cod,tipo_documento.tipodocumento_cod,IFNULL(documento.doc_documento,''),num_proceso,archivo_etapa1_v2,archivo_etapa1_v3,anexo_seis,anexo_seis_2,anexo_seis_3,anexo_uno_etapa_tres,proyecto_etapa_tres,carta_etapa_tres FROM documento INNER JOIN tipo_documento ON documento.tipoDocumento_cod = tipo_documento.tipodocumento_cod INNER JOIN area ON documento.area_cod = area.area_cod INNER JOIN detalle_ciudadano ON detalle_ciudadano.documento_cod=documento.documento_cod WHERE documento.documento_cod LIKE '%".$valor."%' AND detalle_ciudadano.ciudadano_cod='".$ciudadano."' ORDER BY documento.documento_cod DESC LIMIT $inicio,$limite";
				echo  $sql;exit;
			}else{
			    $sql = "SELECT documento.documento_cod, documento.doc_asunto,documento.doc_fecha_recepcion,tipo_documento.tipodo_descripcion,area.area_nombre,documento.doc_estado,documento.doc_tipo,area.area_cod,tipo_documento.tipodocumento_cod,IFNULL(documento.doc_documento,''),num_proceso,archivo_etapa1_v2,archivo_etapa1_v3,anexo_seis,anexo_seis_2,anexo_seis_3,anexo_uno_etapa_tres,proyecto_etapa_tres,carta_etapa_tres FROM documento INNER JOIN tipo_documento ON documento.tipoDocumento_cod = tipo_documento.tipodocumento_cod INNER JOIN area ON documento.area_cod = area.area_cod INNER JOIN detalle_ciudadano ON detalle_ciudadano.documento_cod=documento.documento_cod WHERE documento.documento_cod LIKE '%".$valor."%' AND detalle_ciudadano.ciudadano_cod='".$ciudadano."' ORDER BY documento.documento_cod DESC";
			}
			
			$resultado =  $this->conexion->conexion->query($sql);
			$arreglo = array();
			while($consulta_VU=mysqli_fetch_array($resultado)){ ///MYSQL_BOTH, MYSQL_ASSOC, MYSQL_NUM
			    $arreglo[] = $consulta_VU;
			}
			return $arreglo;
			$this->conexion->cerrar();	
 		}
	}
?>