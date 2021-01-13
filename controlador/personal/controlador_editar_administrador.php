<?php
	$codigo = $_POST["personal_id"];
	$nombre = $_POST["nombres_personal"];
	$apePat = $_POST["apePate_personal"];
	$apeMat = $_POST["apeMate_personal"];
	$email  = $_POST["email_personal"];
	$telefo = $_POST["telefono_personal"];
	$movil  = $_POST["movil_personal"];
	$direc  = $_POST["direccion_personal"];
	$fecha  = $_POST["fechanacimiento_personal"];
	$dni  = $_POST["dni_personal"];
	include '../../modelo/modelo_usuario.php';
	$MC = new Modelo_usuario();
	$consulta = $MC->editar_personal($codigo,$nombre,$apePat,$apeMat,$email,$telefo,$movil,$direc,$fecha,$dni);
	echo $consulta;
?>