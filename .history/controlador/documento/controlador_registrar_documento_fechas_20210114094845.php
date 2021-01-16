<?php
	include '../../modelo/modelo_documento_coordinador.php';
	$codigo           =  $_POST["codigo"];
	$tipo          =  $_POST["tipo"];
	$fecha          =  $_POST["fecha"];
	$MC = new Modelo_documento();
	$consulta = $MC->aprobar_desaprobar_etica_documento($codigo,$estado);
	echo $consulta;
?>