<?php
	$iddocumento = $_POST["iddocumento"];
	$revisor     = $_POST["revisor"];
	$tipo     = $_POST["tipo"];
	require '../../modelo/modelo_documento.php';
	$MC = new Modelo_documento();
	$consulta = $MC->registrar_revisor($iddocumento,$revisor,tipo);
	echo $consulta;
?>
