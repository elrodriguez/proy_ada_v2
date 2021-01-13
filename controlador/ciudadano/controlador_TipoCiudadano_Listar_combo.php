<?php
	include '../../modelo/personal/modelo_ciudadano.php';
	$MC = new Modelo_ciuadano();
	$consulta = $MC->listar_TipoPersonal();
	echo json_encode($consulta);
?>