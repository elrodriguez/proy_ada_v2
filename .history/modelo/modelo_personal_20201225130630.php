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
		function Registrar_personal($nombre,$apePat,$apeMat,$telefo,$movil,$direcc,$fecnac,$dni,$email,$genero,$usuario,$clave,$tipo,$puesto){
			$sql = "call PA_REGISTRARPERSONAL('$nombre','$apePat','$apeMat','$telefo','$movil','$direcc','$fecnac','$dni','$email','$genero','$usuario','$clave','$tipo','$puesto')";
			if ($resultado = $this->conexion->conexion->query($sql)){
				return 1;
			}
			else{
				return 0;
			}
			$this->conexion->Cerrar_Conexion();
		}
		function Editar_personal($codigo,$nombre,$apePat,$apeMat,$telefo,$movil,$direc,$fecha,$nrodocume,$email,$estado){
			$sql = "call PA_EDITARPERSONALTODOS('$codigo','$nombre','$apePat','$apeMat','$telefo','$movil','$direc','$fecha','$nrodocume','$email','$estado')";
			if ($resultado = $this->conexion->conexion->query($sql)){
				return 1;
			}
			else{
				return 0;
			}
			$this->conexion->Cerrar_Conexion();
		}
		function listar_personal($valor, $inicio=FALSE,$limite=FALSE){
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
		function listar_combotipousuario(){
				$sql = "SELECT * from tipo_usuario where tipusu_estado = 'ACTIVO'";
				
				$arreglo = array();
				if ($consulta = $this->conexion->conexion->query($sql)) {

					while ($consulta_VU = mysqli_fetch_array($consulta)) {
						$arreglo[] = $consulta_VU;
					}
					return $arreglo;
					$this->conexion->cerrar();	
				}
		}
		function listar_combo_tipo_docente(){
			$sql = "SELECT * from tipo_asesor";
			
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {

				while ($consulta_VU = mysqli_fetch_array($consulta)) {
					$arreglo[] = $consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();	
			}
		}
		function registrar_docente($nombre,$apePat,$apeMat,$telefo,$movil,$direcc,$fecnac,$dni,$email,$genero,$estado,$tipos){
			$sql = "CALL PA_REGISTRARDOCENTE('$nombre','$apePat','$apeMat','$telefo','$movil','$direcc','$fecnac','$dni','$email','$genero','$estado','$tipos')";
			//echo $sql;exit;
			if ($resultado = $this->conexion->conexion->query($sql)){
				return 1;
			}
			else{
				return 0;
			}
			$this->conexion->Cerrar_Conexion();
		}
		function listar_docente($valor, $inicio=FALSE,$limite=FALSE){
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