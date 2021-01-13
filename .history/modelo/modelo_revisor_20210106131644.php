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
			    $sql = "SELECT personal.personal_cod,personal.pers_nombres,personal.pers_apellidoPate,personal.pers_apellidoMate,personal.pers_dni,personal.pers_sexo,personal.pers_fechaNacimiento,personal.pers_direccion,personal.pers_telefono,personal.pers_movil,personal.pers_email,personal.pers_fecharegistro,personal.pers_estado,usuario.usu_nombre,personal.pers_puesto FROM personal INNER JOIN usuario ON personal.usuario_cod = usuario.cod_usuario where personal.pers_dni like '".$valor."%' ORDER BY personal.personal_cod DESC LIMIT $inicio,$limite";
			}else{
			    $sql = "SELECT personal.personal_cod,personal.pers_nombres,personal.pers_apellidoPate,personal.pers_apellidoMate,personal.pers_dni,personal.pers_sexo,personal.pers_fechaNacimiento,personal.pers_direccion,personal.pers_telefono,personal.pers_movil,personal.pers_email,personal.pers_fecharegistro,personal.pers_estado,usuario.usu_nombre,personal.pers_puesto FROM personal INNER JOIN usuario ON personal.usuario_cod = usuario.cod_usuario where personal.pers_dni like '".$valor."%' ORDER BY personal.personal_cod DESC";
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