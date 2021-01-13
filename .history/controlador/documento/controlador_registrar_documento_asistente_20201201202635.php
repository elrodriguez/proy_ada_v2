<?php
	$cont=0;
	if ($_FILES["id_archivo"]['tmp_name']!="") {
    $imagen=uniqid()."-".$_FILES['id_archivo']['name'];
	$ruta1=$_FILES['id_archivo']['tmp_name'];
	$destinoImagen='Archivo/'.$imagen;
	copy($ruta1, $destinoImagen);
	$cont=1;
	}else{
	$destinoImagen="";
	}
	$iddocumento= $_POST["iddocumento"];
	$asunto     = strtoupper($_POST["asunto"]);
	$idnumero   = strtoupper($_POST["idnumero"]);
	$idtipodocu = $_POST["idtipodocu"];
	$idasesor   = $_POST["idasesor"];
	$idarea     = $_POST["idarea"];
	$idremitente= $_POST["idremitente"];
	$idusuario  = $_POST["idusuario"];
	$opcion     = $_POST["opcion"];


	require '../../modelo/modelo_documento_asistente.php';
	$MC = new Modelo_documento();
	$consulta = $MC->Registrar_documento_asistente($iddocumento,$asunto,$idnumero,$idtipodocu,$idasesor,$idarea,$idremitente,$idusuario,$opcion,$destinoImagen,$cont);
	echo $consulta;
?>
