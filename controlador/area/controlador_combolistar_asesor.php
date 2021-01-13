<?php
	include '../../modelo/modelo_asesor.php';
	$MC = new Modelo_asesor();
	$consulta = $MC->listar_asesor();
	echo json_encode($consulta);
?>
