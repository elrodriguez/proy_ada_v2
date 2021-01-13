<?php
	$codigo = $_POST["codigo"];
	
	require '../../modelo/modelo_documento.php';
	$MC = new Modelo_documento();
	$consulta = $MC->traerremitenteciudadano_documento($codigo);
	echo json_encode($consulta);
?>
