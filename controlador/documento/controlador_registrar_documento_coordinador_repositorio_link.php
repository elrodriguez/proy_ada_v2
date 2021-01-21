<?php
	//print_r($_POST);exit;
	$cont=0;
	$iddocumento = $_POST['iddocumentorepositorio'];
	$repositorio = $_POST['repositorio'];
	$tipo = $_POST['tipo-repositorio'];
	
	
	require '../../modelo/modelo_documento_coordinador.php';

	$MC = new Modelo_documento();
	$consulta = $MC->subir_documento_anexos($tipo,$iddocumento,$repositorio,null);
	echo $consulta;
?>
