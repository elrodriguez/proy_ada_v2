<?php
	$nombre = $_POST["nombre"];
	$apePat = $_POST["apepat"];
	$apeMat = $_POST["apemat"];
	$tipope = isset($_POST["tipopersona"])?$_POST["tipopersona"]:null;
	$telefo = $_POST["telefono"];
	$movil  = $_POST["movil"];
	$direcc = $_POST["direccion"];
	$fecnac = $_POST["fecha"];
	$dni    = $_POST["nrodocume"];
	$email  = $_POST["email"];
	$genero = $_POST["sexo"];
	$carrera = $_POST["carrera"];
	include '../../modelo/modelo_ciudadano.php';
	$MC = new Modelo_ciuadano();
	$consulta = $MC->Registrar_ciudadano($nombre,$apePat,$apeMat,$tipope,$telefo,$movil,$direcc,$fecnac,$dni,$email,$genero,$carrera);
	echo $consulta;
?>