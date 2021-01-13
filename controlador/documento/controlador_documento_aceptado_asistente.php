<?php
	include '../../modelo/modelo_documento_asistente.php';
	$codigo           =  $_POST["codigo"];
	$MC = new Modelo_documento();
	$consulta = $MC->Aceptar_documento_asistente($codigo);
	echo $consulta;

?>
