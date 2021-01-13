<?php
	include '../../modelo/modelo_tipodocumento.php';
	$MC = new Modelo_TipoDocumento();
	$consulta = $MC->listar_combotipodocumento();
	echo json_encode($consulta);
?>