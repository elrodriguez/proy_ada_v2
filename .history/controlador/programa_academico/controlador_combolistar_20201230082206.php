<?php
	include '../../modelo/modelo_programa_academico.php';
	$MC = new Modelo_programa_academico();
	$consulta = $MC->listar_programa_academico();
	echo json_encode($consulta);
?>
