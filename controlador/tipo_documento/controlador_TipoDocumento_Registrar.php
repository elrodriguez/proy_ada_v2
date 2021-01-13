<?php
	$descripcion = strtoupper($_POST['nombre']);    
	include '../../modelo/modelo_tipodocumento.php';
	$MC = new Modelo_TipoDocumento();
	$consulta = $MC->Registrar_TipoDocumento($descripcion);
	echo $consulta;
?>