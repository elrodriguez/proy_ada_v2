<?php
	$codigo       = $_POST["codigo"];
	$area         = strtoupper($_POST["area"]);
	$estado       = strtoupper($_POST["estado"]);
	require '../../modelo/modelo_area.php';
	$MC = new Modelo_area();
	$consulta = $MC->Editar_areas($codigo,$area,$estado);
	echo $consulta;
?>