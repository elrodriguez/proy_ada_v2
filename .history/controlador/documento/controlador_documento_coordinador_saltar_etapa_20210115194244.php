<?php
	include '../../modelo/modelo_documento_coordinador.php';
	$codigo =  $_POST["codigo"];
	$estado =  $_POST["estado"];
	$MC = new Modelo_documento();
	$consulta = $MC->Rechazado_documento($codigo,'PENDIENTE','5');
	echo $consulta;
?>