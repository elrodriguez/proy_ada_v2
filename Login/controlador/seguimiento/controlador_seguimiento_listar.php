<?php
	$buscar = $_POST['buscar'];
	$data_buscar = $buscar."";
	include '../../modelo/modelo_seguimiento.php';
	$MV = new Modelo_documento();
	$consulta = $MV->listar_documentoseguimiento($data_buscar);
	echo json_encode($consulta);
?>