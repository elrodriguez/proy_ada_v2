<?php
	include '../../modelo/modelo_usuario.php';
	$MC = new Modelo_usuario();
	$consulta = $MC->listar_TipoUsuario();
	echo json_encode($consulta);
?>