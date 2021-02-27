<?php
	include '../../modelo/modelo_documento_coordinador.php';
	$codigo           =  $_POST["tipopublicacioniddociuemneto"];
	$tipo          =  $_POST["tipo_publicacion"];
	$fecha          =  $_POST["tipopublicacioniddociuemneto"];
	$MC = new Modelo_documento();
	$consulta = $MC->subir_documento_fechas($tipo,$codigo,$fecha);
	echo $consulta;
?>