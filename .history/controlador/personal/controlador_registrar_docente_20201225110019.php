<?php

print_r($_POST);exit;

	$nombre = strtoupper($_POST["txtnombre"]);
	$apePat = strtoupper($_POST["txtapellidopaterno"]);
	$apeMat = strtoupper($_POST["txtapellidomaterno"]);
	$telefo = $_POST["txttelefono"];
	$movil  = $_POST["txtmovil"];
	$direcc = strtoupper($_POST["txtdireccion"]);
	$fecnac = $_POST["txtfecha"];
	$dni    = $_POST["txtdni"];
	$email  = $_POST["txtemail"];
	$genero = $_POST["sexo"];
	$tipo   = $_POST["cboTipo"];
	$stado  = $_POST["txtEstado"];
	

	include '../../modelo/modelo_personal.php';
	$MC = new Modelo_personal();
	$consulta = $MC->Registrar_personal($nombre,$apePat,$apeMat,$telefo,$movil,$direcc,$fecnac,$dni,$email,$genero,$usuario,$clave,$tipo,$puesto);
	echo $consulta;
?>