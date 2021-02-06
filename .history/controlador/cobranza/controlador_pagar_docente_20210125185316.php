<?php
	include '../../modelo/modelo_documento_coordinador.php';
	$codigo =  $_POST["codigo"];
	$estado =  $_POST["estado"];
	$flag =  $_POST["flag"];
	$MC = new Modelo_documento();
	$consulta = $MC->Rechazado_documento($codigo,$estado,$flag);
	echo $consulta;
?>