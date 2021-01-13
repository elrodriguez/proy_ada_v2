<?php
	$id = $_POST["id"];
	
	require '../../modelo/modelo_documento.php';
	$MC = new Modelo_documento();
	$consulta = $MC->eliminar_revisor($id);
	echo $consulta;
?>
