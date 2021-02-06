<?php
	include '../../modelo/modelo_cobranza.php';
	$codigo =  $_POST["codigo"];
	$estado =  $_POST["estado"];
	$flag =  $_POST["flag"];
	$MC = new modelo_cobranza();
	$consulta = $MC->pagar_docente($codigo,$estado,$flag);
	echo $consulta;
?>