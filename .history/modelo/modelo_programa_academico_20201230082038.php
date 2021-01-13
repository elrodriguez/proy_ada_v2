<?php
	class Modelo_programa_academico
	{
		private $conexion;
		function __construct()
		{
			require_once('modelo_conexion.php');
			$this->conexion = new conexion();
			$this->conexion->conectar();
		}
		function listar_programa_academico(){
			$sql = "SELECT * FROM area WHERE area_estado = 'ACTIVO' ORDER BY area_cod DESC";
				
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