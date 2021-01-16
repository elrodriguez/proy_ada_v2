<?php
	$iddocumento = $_POST["iddocumento"];
	$revisor     = $_POST["revisor"];
	$tipo     = $_POST["tipo"];
	$modalidad     = $_POST["modalidad"];
	require '../../modelo/modelo_documento.php';
	$MC = new Modelo_documento();
	$consulta = $MC->registrar_revisor($iddocumento,$revisor,$tipo,$modalidad );
	echo $consulta;
?>
