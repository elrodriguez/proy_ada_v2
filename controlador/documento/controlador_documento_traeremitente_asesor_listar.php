<?php
	$codigo = $_POST["codigo"];
	
	require '../../modelo/modelo_documento.php';
	$MC = new Modelo_documento();
	$consulta = $MC->listar_asesor($codigo);
	echo json_encode($consulta);
?>
