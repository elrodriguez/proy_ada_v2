<?php
	include '../../modelo/modelo_documento_coordinador.php';
	$codigo           =  $_POST["codigo"];
	$estado          =  $_POST["estado"];
	$MC = new Modelo_documento();
	$consulta = $MC->aprobar_observar_documento($codigo,$estado);
	echo $consulta;
?>