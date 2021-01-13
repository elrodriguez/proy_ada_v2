<?php
	$codigo = $_POST['cod'];
	$descri = strtoupper($_POST['descri']);
	$estado = $_POST['estado'];
	include '../../modelo/modelo_tipodocumento.php';
	$MV = new Modelo_TipoDocumento();
	$consulta = $MV->editar_tipodocumento($codigo,$descri,$estado);
	echo $consulta;
?>