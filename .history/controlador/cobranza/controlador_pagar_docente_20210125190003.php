<?php
	include '../../modelo/modelo_cobranza.php';
	$codigo =  $_POST["codigo"];
	$estado =  $_POST["estado"];
	$flag =  $_POST["flag"];
	$MC = new Modelo_documento();
	$consulta = $MC->pagar_docente($codigo,$estado,$flag);
	echo $consulta;
?>