<?php

print_r($_POST);exit;

	$nombre = strtoupper($_POST["nombre"]);
	$apePat = strtoupper($_POST["apepat"]);
	$apeMat = strtoupper($_POST["apemat"]);
	$telefo = $_POST["telefono"];
	$movil  = $_POST["movil"];
	$direcc = strtoupper($_POST["direccion"]);
	$fecnac = $_POST["fecha"];
	$dni    = $_POST["nrodocume"];
	$email  = $_POST["email"];
	$genero = $_POST["sexo"];
	$tipo   = $_POST["cboTipo"];

	

	include '../../modelo/modelo_personal.php';
	$MC = new Modelo_personal();
	$consulta = $MC->Registrar_personal($nombre,$apePat,$apeMat,$telefo,$movil,$direcc,$fecnac,$dni,$email,$genero,$usuario,$clave,$tipo,$puesto);
	echo $consulta;
?>