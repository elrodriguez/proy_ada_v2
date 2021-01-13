<?php
	$codigo       = $_POST["codigo"];
	$institucion  = strtoupper($_POST["institucion"]);
	$tipo         = strtoupper($_POST["tipo"]);
	$estado       = strtoupper($_POST["estado"]);
	require '../../modelo/modelo_institucion.php';
	$MC = new Modelo_institucion();
	$consulta = $MC->Editar_institucion($codigo,$institucion,$tipo,$estado);
	echo $consulta;
?>