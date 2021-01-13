<?php
	session_start();
	$usuario = $_POST['user'];
	$pass    = $_POST['pass'];
	include '../../modelo/modelo_usuario.php';
	$MU = new Modelo_usuario();
	$consulta = $MU->Verificar_usuario($usuario,$pass);
	$data = json_encode($consulta);
    if (count($consulta) > 0) {
	echo $data;
	}else{
		echo 0;
	}
	
?>