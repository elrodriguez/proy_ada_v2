<?php
	$dni = $_POST["dni"];
	require '../../modelo/modelo_ciudadano.php';
	$MC = new Modelo_ciuadano();
	$consulta = $MC->buscar_dni($dni);
	$data = json_encode($consulta);
	echo $data;
?>