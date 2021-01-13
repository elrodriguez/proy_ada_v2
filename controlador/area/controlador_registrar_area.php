<?php
	$area         = strtoupper($_POST["area"]);
	require '../../modelo/modelo_area.php';
	$MC = new Modelo_area();
	$consulta = $MC->Registrar_areas($area);
	echo $consulta;
?>