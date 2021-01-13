<?php
	$codigo = $_POST["codigo"];
	
	require '../../modelo/modelo_documento.php';
	$MC = new Modelo_documento();
	$consulta = $MC->traer_revisor($codigo);
	echo json_encode($consulta);
?>
