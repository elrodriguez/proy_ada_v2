<?php
	$buscar = $_POST['buscar'];
	include '../../modelo/modelo_usuario.php';
	$MC = new Modelo_usuario();
	$consulta = $MC->buscar_adminsitrador($buscar);
	echo json_encode($consulta);
?>