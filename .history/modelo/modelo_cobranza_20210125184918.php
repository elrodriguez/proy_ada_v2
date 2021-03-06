<?php
	class Modelo_personal
	{
		private $conexion;
		function __construct()
		{
			require_once('modelo_conexion.php');
			$this->conexion = new conexion();
			$this->conexion->conectar();
		}
		function listar_revisor($valor, $inicio=FALSE,$limite=FALSE){
			if ($inicio!==FALSE && $limite!==FALSE) {
			    $sql = "SELECT documento_revisor.id,asesor.asesor_cod,programa_academico.modalidad,programa_academico.descripcion,CONCAT(asesor.nombre,' ',asesor.apellido_pater,' ',asesor.apellido_mater) AS nombre_completo,IF(documento_revisor.tipo='I','Independiente',IF(documento_revisor.tipo='C','comisión','Docente del curso')) AS tipo,asesor.categoria,documento_revisor.por_pagar_fecha,IF(documento_revisor.modalidad='I','Investigador Asociado',IF(documento_revisor.modalidad='T','Titular','Ninguno')) as moda FROM asesor INNER JOIN documento_revisor ON asesor.asesor_cod=documento_revisor.asesor_cod INNER JOIN documento ON documento_revisor.documento_cod=documento.documento_cod INNER JOIN programa_academico ON documento.grado=programa_academico.id where asesor.dni like '".$valor."%' AND por_pagar='SI' ORDER BY asesor.asesor_cod DESC LIMIT $inicio,$limite";
			}else{
			    $sql = "SELECT documento_revisor.id,asesor.asesor_cod,programa_academico.modalidad,programa_academico.descripcion,CONCAT(asesor.nombre,' ',asesor.apellido_pater,' ',asesor.apellido_mater) AS nombre_completo,IF(documento_revisor.tipo='I','Independiente',IF(documento_revisor.tipo='C','comisión','Docente del curso')) AS tipo,asesor.categoria,documento_revisor.por_pagar_fecha,IF(documento_revisor.modalidad='I','Investigador Asociado',IF(documento_revisor.modalidad='T','Titular','Ninguno')) as moda FROM asesor INNER JOIN documento_revisor ON asesor.asesor_cod=documento_revisor.asesor_cod INNER JOIN documento ON documento_revisor.documento_cod=documento.documento_cod INNER JOIN programa_academico ON documento.grado=programa_academico.id where asesor.dni like '".$valor."%' AND por_pagar='SI' ORDER BY asesor.asesor_cod DESC";
			}
			$resultado =  $this->conexion->conexion->query($sql);
			$arreglo = array();
			while($consulta_VU=mysqli_fetch_array($resultado)){ ///MYSQL_BOTH, MYSQL_ASSOC, MYSQL_NUM
			    $arreglo[] = $consulta_VU;
			}
			return $arreglo;
			$this->conexion->cerrar();	
		 }
		 function listar_asesor($valor, $inicio=FALSE,$limite=FALSE){
			if ($inicio!==FALSE && $limite!==FALSE) {
			    $sql = "SELECT documento_asesor.id,asesor.asesor_cod,programa_academico.modalidad,programa_academico.descripcion,CONCAT(asesor.nombre,' ',asesor.apellido_pater,' ',asesor.apellido_mater) AS nombre_completo,IF(documento_asesor.tipo='I','Independiente',IF(documento_asesor.tipo='C','comisión','Docente del curso')) AS tipo,asesor.categoria,documento_asesor.por_pagar_fecha,IF(documento_asesor.modalidad='I','Investigador Asociado',IF(documento_asesor.modalidad='T','Titular','Ninguno')) as moda FROM asesor INNER JOIN documento_asesor ON asesor.asesor_cod=documento_asesor.asesor_cod INNER JOIN documento ON documento_asesor.documento_cod=documento.documento_cod INNER JOIN programa_academico ON documento.grado=programa_academico.id where asesor.dni like '".$valor."%' AND por_pagar='SI' ORDER BY asesor.asesor_cod DESC LIMIT $inicio,$limite";
			}else{
			    $sql = "SELECT documento_asesor.id,asesor.asesor_cod,programa_academico.modalidad,programa_academico.descripcion,CONCAT(asesor.nombre,' ',asesor.apellido_pater,' ',asesor.apellido_mater) AS nombre_completo,IF(documento_asesor.tipo='I','Independiente',IF(documento_asesor.tipo='C','comisión','Docente del curso')) AS tipo,asesor.categoria,documento_asesor.por_pagar_fecha,IF(documento_asesor.modalidad='I','Investigador Asociado',IF(documento_asesor.modalidad='T','Titular','Ninguno')) as moda FROM asesor INNER JOIN documento_asesor ON asesor.asesor_cod=documento_asesor.asesor_cod INNER JOIN documento ON documento_asesor.documento_cod=documento.documento_cod INNER JOIN programa_academico ON documento.grado=programa_academico.id where asesor.dni like '".$valor."%' AND por_pagar='SI' ORDER BY asesor.asesor_cod DESC";
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
		 function listar_jurado($valor, $inicio=FALSE,$limite=FALSE){
			if ($inicio!==FALSE && $limite!==FALSE) {
			    $sql = "SELECT documento_jurado.id,asesor.asesor_cod,programa_academico.modalidad,programa_academico.descripcion,CONCAT(asesor.nombre,' ',asesor.apellido_pater,' ',asesor.apellido_mater) AS nombre_completo,IF(documento_jurado.tipo='I','Independiente',IF(documento_jurado.tipo='C','comisión','Docente del curso')) AS tipo,asesor.categoria,documento_jurado.por_pagar_fecha,IF(documento_jurado.modalidad='I','Investigador Asociado',IF(documento_jurado.modalidad='T','Titular','Ninguno')) as moda FROM asesor INNER JOIN documento_jurado ON asesor.asesor_cod=documento_jurado.asesor_cod INNER JOIN documento ON documento_jurado.documento_cod=documento.documento_cod INNER JOIN programa_academico ON documento.grado=programa_academico.id where asesor.dni like '".$valor."%' AND por_pagar='SI' ORDER BY asesor.asesor_cod DESC LIMIT $inicio,$limite";
			}else{
			    $sql = "SELECT documento_jurado.id,asesor.asesor_cod,programa_academico.modalidad,programa_academico.descripcion,CONCAT(asesor.nombre,' ',asesor.apellido_pater,' ',asesor.apellido_mater) AS nombre_completo,IF(documento_jurado.tipo='I','Independiente',IF(documento_jurado.tipo='C','comisión','Docente del curso')) AS tipo,asesor.categoria,documento_jurado.por_pagar_fecha,IF(documento_jurado.modalidad='I','Investigador Asociado',IF(documento_jurado.modalidad='T','Titular','Ninguno')) as moda FROM asesor INNER JOIN documento_jurado ON asesor.asesor_cod=documento_jurado.asesor_cod INNER JOIN documento ON documento_jurado.documento_cod=documento.documento_cod INNER JOIN programa_academico ON documento.grado=programa_academico.id where asesor.dni like '".$valor."%' AND por_pagar='SI' ORDER BY asesor.asesor_cod DESC";
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