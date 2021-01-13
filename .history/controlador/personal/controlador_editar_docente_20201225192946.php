<?php
	//print_r($_POST);exit;
	$id = strtoupper($_POST["txtidciudadano"]);
	$nombre = strtoupper($_POST["txtnombre_alimentos"]);
	$apePat = strtoupper($_POST["txtapellidopaterno"]);
	$apeMat = strtoupper($_POST["txtapellidomaterno"]);
	$telefo = $_POST["txttelefono_modal"];
	$movil  = $_POST["txtmovil_modal"];
	$direcc = strtoupper($_POST["txtdireccion_modal"]);
	$fecnac = $_POST["txtfecha_modal"];
	$dni    = $_POST["txtnrodocumento"];
	$email  = $_POST["txtemail_modal"];
	$genero = isset($_POST["txtGenero"])?$_POST["txtGenero"]:'M';
	$inputs  = $_POST["cboTipo"];
	$estado  = $_POST["txtEstado"];

	$tipos = '';
	foreach($inputs as $key => $input){
		$tipos.=$input.($key<count($inputs)-1?'*':'');
	}

	include '../../modelo/modelo_personal.php';
	$MC = new Modelo_personal();
	$consulta = $MC->Editar_personal($id,$nombre,$apePat,$apeMat,$telefo,$movil,$direcc,$fecnac,$dni,$email,$genero,$estado,$tipos);
	echo $consulta;
?>