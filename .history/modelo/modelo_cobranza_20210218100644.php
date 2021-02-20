<?php
	class modelo_cobranza
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
			    $sql = "SELECT documento_revisor.id,documento.doc_asunto,asesor.asesor_cod,programa_academico.modalidad,programa_academico.descripcion,CONCAT(asesor.nombre,' ',asesor.apellido_pater,' ',asesor.apellido_mater) AS nombre_completo,IF(documento_revisor.tipo='I','Independiente',IF(documento_revisor.tipo='C','comisión','Docente del curso')) AS tipo,asesor.categoria,documento_revisor.por_pagar_fecha,IF(documento_revisor.modalidad='I','Investigador Asociado',IF(documento_revisor.modalidad='T','Titular','Ninguno')) as moda,f_calularpagos(1,documento_revisor.tipo,asesor.categoria,documento_revisor.modalidad,programa_academico.modalidad,SUM(1)) AS pago,SUM(1) AS total_tesis,documento_revisor.modalidad AS mdp,documento_revisor.tipo AS tip FROM asesor INNER JOIN documento_revisor ON asesor.asesor_cod=documento_revisor.asesor_cod INNER JOIN documento ON documento_revisor.documento_cod=documento.documento_cod INNER JOIN programa_academico ON documento.grado=programa_academico.id where documento_revisor.pagado = '0' AND asesor.dni like '".$valor."%' AND por_pagar='SI' GROUP BY asesor.asesor_cod,asesor.categoria,documento_revisor.tipo,documento_revisor.modalidad ORDER BY asesor.asesor_cod DESC LIMIT $inicio,$limite";
			}else{
			    $sql = "SELECT documento_revisor.id,documento.doc_asunto,asesor.asesor_cod,programa_academico.modalidad,programa_academico.descripcion,CONCAT(asesor.nombre,' ',asesor.apellido_pater,' ',asesor.apellido_mater) AS nombre_completo,IF(documento_revisor.tipo='I','Independiente',IF(documento_revisor.tipo='C','comisión','Docente del curso')) AS tipo,asesor.categoria,documento_revisor.por_pagar_fecha,IF(documento_revisor.modalidad='I','Investigador Asociado',IF(documento_revisor.modalidad='T','Titular','Ninguno')) as moda,f_calularpagos(1,documento_revisor.tipo,asesor.categoria,documento_revisor.modalidad,programa_academico.modalidad,SUM(1)) AS pago,SUM(1) AS total_tesis,documento_revisor.modalidad AS mdp,documento_revisor.tipo AS tip FROM asesor INNER JOIN documento_revisor ON asesor.asesor_cod=documento_revisor.asesor_cod INNER JOIN documento ON documento_revisor.documento_cod=documento.documento_cod INNER JOIN programa_academico ON documento.grado=programa_academico.id where documento_revisor.pagado = '0' AND asesor.dni like '".$valor."%' AND por_pagar='SI' GROUP BY asesor.asesor_cod,asesor.categoria,documento_revisor.tipo,documento_revisor.modalidad ORDER BY asesor.asesor_cod DESC";
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
			    $sql = "SELECT documento_asesor.id,documento.doc_asunto,asesor.asesor_cod,programa_academico.modalidad,programa_academico.descripcion,CONCAT(asesor.nombre,' ',asesor.apellido_pater,' ',asesor.apellido_mater) AS nombre_completo,IF(documento_asesor.tipo='I','Independiente',IF(documento_asesor.tipo='C','comisión','Docente del curso')) AS tipo,asesor.categoria,documento_asesor.por_pagar_fecha,IF(documento_asesor.modalidad='I','Investigador Asociado',IF(documento_asesor.modalidad='T','Titular','Ninguno')) as moda,f_calularpagos(3,documento_asesor.tipo,asesor.categoria,documento_asesor.modalidad,programa_academico.modalidad,SUM(1)) AS pago,SUM(1) AS total_tesis,documento_asesor.modalidad AS mdp,documento_asesor.tipo AS tip FROM asesor INNER JOIN documento_asesor ON asesor.asesor_cod=documento_asesor.asesor_cod INNER JOIN documento ON documento_asesor.documento_cod=documento.documento_cod INNER JOIN programa_academico ON documento.grado=programa_academico.id where documento_asesor.pagado = '0' AND asesor.dni like '".$valor."%' AND por_pagar='SI' GROUP BY asesor.asesor_cod,asesor.categoria,documento_asesor.tipo,documento_asesor.modalidad ORDER BY asesor.asesor_cod DESC LIMIT $inicio,$limite";
			}else{
			    $sql = "SELECT documento_asesor.id,documento.doc_asunto,asesor.asesor_cod,programa_academico.modalidad,programa_academico.descripcion,CONCAT(asesor.nombre,' ',asesor.apellido_pater,' ',asesor.apellido_mater) AS nombre_completo,IF(documento_asesor.tipo='I','Independiente',IF(documento_asesor.tipo='C','comisión','Docente del curso')) AS tipo,asesor.categoria,documento_asesor.por_pagar_fecha,IF(documento_asesor.modalidad='I','Investigador Asociado',IF(documento_asesor.modalidad='T','Titular','Ninguno')) as moda,f_calularpagos(3,documento_asesor.tipo,asesor.categoria,documento_asesor.modalidad,programa_academico.modalidad,SUM(1)) AS pago,SUM(1) AS total_tesis,documento_asesor.modalidad AS mdp,documento_asesor.tipo AS tip FROM asesor INNER JOIN documento_asesor ON asesor.asesor_cod=documento_asesor.asesor_cod INNER JOIN documento ON documento_asesor.documento_cod=documento.documento_cod INNER JOIN programa_academico ON documento.grado=programa_academico.id where documento_asesor.pagado = '0' AND asesor.dni like '".$valor."%' AND por_pagar='SI' GROUP BY asesor.asesor_cod,asesor.categoria,documento_asesor.tipo,documento_asesor.modalidad ORDER BY asesor.asesor_cod DESC";
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
			    $sql = "SELECT documento_jurado.id,documento.doc_asunto,asesor.asesor_cod,programa_academico.modalidad,programa_academico.descripcion,CONCAT(asesor.nombre,' ',asesor.apellido_pater,' ',asesor.apellido_mater) AS nombre_completo,IF(documento_jurado.tipo='I','Independiente',IF(documento_jurado.tipo='C','comisión','Docente del curso')) AS tipo,asesor.categoria,documento_jurado.por_pagar_fecha,IF(documento_jurado.modalidad='I','Investigador Asociado',IF(documento_jurado.modalidad='T','Titular','Ninguno')) as moda,f_calularpagos(2,documento_jurado.tipo,asesor.categoria,documento_jurado.modalidad,programa_academico.modalidad,SUM(1)) AS pago,SUM(1) AS total_tesis,documento_jurado.modalidad AS mdp,documento_jurado.tipo AS tip FROM asesor INNER JOIN documento_jurado ON asesor.asesor_cod=documento_jurado.asesor_cod INNER JOIN documento ON documento_jurado.documento_cod=documento.documento_cod INNER JOIN programa_academico ON documento.grado=programa_academico.id where documento_jurado.pagado = '0' AND asesor.dni like '".$valor."%' AND por_pagar='SI' GROUP BY asesor.asesor_cod,asesor.categoria,documento_jurado.tipo,documento_jurado.modalidad ORDER BY asesor.asesor_cod DESC LIMIT $inicio,$limite";
			}else{
			    $sql = "SELECT documento_jurado.id,documento.doc_asunto,asesor.asesor_cod,programa_academico.modalidad,programa_academico.descripcion,CONCAT(asesor.nombre,' ',asesor.apellido_pater,' ',asesor.apellido_mater) AS nombre_completo,IF(documento_jurado.tipo='I','Independiente',IF(documento_jurado.tipo='C','comisión','Docente del curso')) AS tipo,asesor.categoria,documento_jurado.por_pagar_fecha,IF(documento_jurado.modalidad='I','Investigador Asociado',IF(documento_jurado.modalidad='T','Titular','Ninguno')) as moda,f_calularpagos(2,documento_jurado.tipo,asesor.categoria,documento_jurado.modalidad,programa_academico.modalidad,SUM(1)) AS pago,SUM(1) AS total_tesis,documento_jurado.modalidad AS mdp,documento_jurado.tipo AS tip FROM asesor INNER JOIN documento_jurado ON asesor.asesor_cod=documento_jurado.asesor_cod INNER JOIN documento ON documento_jurado.documento_cod=documento.documento_cod INNER JOIN programa_academico ON documento.grado=programa_academico.id where documento_jurado.pagado = '0' AND asesor.dni like '".$valor."%' AND por_pagar='SI' GROUP BY asesor.asesor_cod,asesor.categoria,documento_jurado.tipo,documento_jurado.modalidad ORDER BY asesor.asesor_cod DESC";
			}
			$resultado =  $this->conexion->conexion->query($sql);
			$arreglo = array();
			while($consulta_VU=mysqli_fetch_array($resultado)){ ///MYSQL_BOTH, MYSQL_ASSOC, MYSQL_NUM
			    $arreglo[] = $consulta_VU;
			}
			return $arreglo;
			$this->conexion->cerrar();	
		 }
		 function pagar_docente($codigo,$docente,$flag,$modalidad,$categoria,$tipo){
			$sql = "CALL SP_PAGARDOCENTE('$flag','$codigo','$docente','$categoria','$tipo','$modalidad')";
			//echo $sql;exit;
			if ($resultado = $this->conexion->conexion->query($sql)){
				return 1;
			}
			else{
				return 0;
			}
			$this->conexion->cerrar();
		}
		function reportepagardocente($flag,$fechainicio,$fechafin){
			$sql = "CALL PA_CALCULARPAGOSDOCENTES('$flag','$fechainicio','$fechafin')";
			$resultado =  $this->conexion->conexion->query($sql);
			$arreglo = array();
			while($consulta_VU=mysqli_fetch_array($resultado)){
			    $arreglo[] = $consulta_VU;
			}
			return $arreglo;
			$this->conexion->cerrar();	
		 }
	}
	
?>