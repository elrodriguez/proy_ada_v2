<?php
	include '../../modelo/modelo_documento.php';
	$codigo           =  $_POST["codigo"];
	$MC = new Modelo_documento();
	$consulta = $MC->Rechazado_documento($codigo);
	echo $consulta;
?>