<?php
	include '../../modelo/modelo_documento_coordinador.php';
	$codigo           =  $_POST["codigo"];
	$estado          =  $_POST["estado"];
	$MC = new Modelo_documento();
	$consulta = $MC->aprobar_pagar_jurado_documento($codigo,$estado);
	echo $consulta;
?>