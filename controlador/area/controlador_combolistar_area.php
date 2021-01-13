<?php
	include '../../modelo/modelo_area.php';
	$MC = new Modelo_area();
	$consulta = $MC->listar_comboarea();
	echo json_encode($consulta);
?>