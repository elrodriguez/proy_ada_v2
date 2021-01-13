<?php
	include '../../modelo/modelo_personal.php';
	$MC = new Modelo_personal();
	$consulta = $MC->listar_combo_tipo_docente();
	echo json_encode($consulta);
?>