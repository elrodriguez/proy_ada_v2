<?php
	$codigo       = $_POST["codigo"];
	$nombre       = strtoupper($_POST["nombre"]);
	$apePat       = strtoupper($_POST["apepat"]);
	$apeMat       = strtoupper($_POST["apemat"]);
	$telefo       = $_POST["telefono"];
	$movil        = $_POST["movil"];
	$direc        = strtoupper($_POST["direccion"]);
	$fecha        = $_POST["fecha"];
	$nrodocume    = $_POST["nrodocume"];
	$email        = $_POST["email"];
	$estado       = $_POST["estado"];
	require '../../modelo/modelo_personal.php';
	$MC = new Modelo_personal();
	$consulta = $MC->Editar_personal($codigo,$nombre,$apePat,$apeMat,$telefo,$movil,$direc,$fecha,$nrodocume,$email,$estado);
	echo $consulta;
?>