<?php
	$institucion  = strtoupper($_POST["institucion"]);
	$tipo         = strtoupper($_POST["tipo"]);
	require '../../modelo/modelo_institucion.php';
	$MC = new Modelo_institucion();
	$consulta = $MC->Registrar_institucion($institucion,$tipo);
	echo $consulta;
?>