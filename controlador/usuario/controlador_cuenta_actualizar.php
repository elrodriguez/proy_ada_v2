<?php
	include '../../modelo/modelo_usuario.php';
	$usuario     =  $_POST["_usuario"];
	$actual      =  $_POST["_actual"];
	$nueva       =  $_POST["_nueva"];
	$MC = new Modelo_usuario();
	$consulta = $MC->editar_usuario($usuario,$actual,$nueva);
	echo $consulta;
?>