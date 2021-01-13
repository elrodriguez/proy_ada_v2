<?php
	$iddocumento = $_POST["iddocumento"];
	$revisor     = $_POST["revisor"];
	require '../../modelo/modelo_documento.php';
	$MC = new Modelo_documento();
	$consulta = $MC->registrar_revisor($iddocumento,$revisor);
	echo $consulta;
?>
