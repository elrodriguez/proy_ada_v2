<?php
	include '../../modelo/modelo_menu.php';
	$MC = new Modelo_menu();
	$consulta = $MC->listar_documentos_pendientes();
	echo json_encode($consulta);
?>