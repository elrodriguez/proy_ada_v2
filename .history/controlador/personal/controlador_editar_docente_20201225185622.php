<?php
	//print_r($_POST);exit;

	$nombre = strtoupper($_POST["txtnombre"]);
	$apePat = strtoupper($_POST["txtapellidopaterno"]);
	$apeMat = strtoupper($_POST["txtapellidomaterno"]);
	$telefo = $_POST["txttelefono"];
	$movil  = $_POST["txtmovil"];
	$direcc = strtoupper($_POST["txtdireccion"]);
	$fecnac = $_POST["txtfecha"];
	$dni    = $_POST["txtdni"];
	$email  = $_POST["txtemail"];
	$email  = $_POST["txtemail"];
	$genero = $_POST["txtGenero"];
	$inputs  = $_POST["cboTipo"];
	$estado  = $_POST["txtEstado"];

	$tipos = '';
	foreach($inputs as $key => $input){
		$tipos.=$input.($key<count($inputs)-1?'*':'');
	}
	require '../../modelo/modelo_personal.php';
	$MC = new Modelo_personal();
	$consulta = $MC->Editar_personal($codigo,$nombre,$apePat,$apeMat,$telefo,$movil,$direc,$fecha,$nrodocume,$email,$estado);
	echo $consulta;
?>