<?php
	include '../../modelo/modelo_documento_coordinador.php';
	$codigo           =  $_POST["codigo"];
	$MC = new Modelo_documento();
	$consulta = $MC->Rechazado_documento($codigo);
	echo $consulta;
?>