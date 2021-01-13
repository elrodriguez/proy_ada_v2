<?php
$documento = $_REQUEST['doc'];

$MC = new Modelo_documento();
	$consulta = $MC->obtenerporcentajeturniting($documento);
	echo $consulta;

?>