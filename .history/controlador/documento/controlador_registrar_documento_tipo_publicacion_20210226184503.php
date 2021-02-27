<?php
	include '../../modelo/modelo_documento_coordinador.php';
	$codigo           =  $_POST["tipopublicacioniddociuemneto"];
	$tipo          =  $_POST["tipo_publicacion"];
	$nombre         =  $_POST["div_nombre_revista"];
	$MC = new Modelo_documento();
	$consulta = $MC->editar_tipo_publicacion($tipo,$codigo,$fecha);
	echo $consulta;
?>