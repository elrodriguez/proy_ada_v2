<?php
	include '../../modelo/modelo_personal.php';
	$MC = new Modelo_personal();
	$consulta = $MC->listar_combotipousuario();
	echo json_encode($consulta);
?>