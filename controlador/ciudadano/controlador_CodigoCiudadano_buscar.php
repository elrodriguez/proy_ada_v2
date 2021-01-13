<?php
	include '../../modelo/modelo_ciudadano.php';
	$MC = new Modelo_ciuadano();
	$consulta = $MC->listar_codigoPersonal();
	echo json_encode($consulta);
?>