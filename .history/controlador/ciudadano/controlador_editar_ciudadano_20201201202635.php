<?php
	$codigo       = $_POST["codigo"];
	$nombre       = strtoupper($_POST["nombre"]);
	$apePat       = strtoupper($_POST["apepat"]);
	$apeMat       = strtoupper($_POST["apemat"]);
	$tipopersona  = $_POST["tipopersona"];
	$telefo       = $_POST["telefono"];
	$movil        = $_POST["movil"];
	$direc        = strtoupper($_POST["direccion"]);
	$fecha        = $_POST["fecha"];
	$nrodocume    = $_POST["nrodocume"];
	$email    = $_POST["email"];
	require '../../modelo/modelo_ciudadano.php';
	$MC = new Modelo_ciuadano();
	$consulta = $MC->Editar_ciudadano($codigo,$nombre,$apePat,$apeMat,$tipopersona,$telefo,$movil,$direc,$fecha,$nrodocume,$email);
	echo $consulta;
?>