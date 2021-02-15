<?php
	include '../../modelo/modelo_cobranza.php';
	$codigo =  $_POST["codigo"];
	$docente =  $_POST["docente"];
	$flag =  $_POST["flag"];
	$modalidad =  $_POST["modalidad"];
	$categoria =  $_POST["categoria"];
	$tipo =  $_POST["tipo"];

	$MC = new modelo_cobranza();
	$consulta = $MC->pagar_docente($codigo,$docente,$flag,$modalidad,$categoria,$tipo);
	echo $consulta;
?>