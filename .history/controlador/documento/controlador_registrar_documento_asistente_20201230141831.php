<?php
	$cont=0;
	if ($_FILES["id_archivo"]['tmp_name']!="") {
    	$imagen=uniqid()."-".$_FILES['id_archivo']['name'];
		$ruta1=$_FILES['id_archivo']['tmp_name'];
		$destinoImagen='Archivo/'.$imagen;
		//print_r($ruta1);exit;
		copy($ruta1, $destinoImagen);
		$cont=1;
	}else{
		$destinoImagen="";
	}
	$modalidad = $_POST['cbm_tipo'];
	$iddocumento= $_POST["iddocumento"];
	$asunto     = strtoupper($_POST["asunto"]);
	$idnumero   = strtoupper($_POST["idnumero"]);
	$idtipodocu = $_POST["idtipodocu"];
	$multipleasesor   = $_POST["idasesor"];
	$idarea     = $_POST["idarea"];
	$inputs= $_POST["idremitente"];
	
	$idusuario  = $_POST["idusuario"];
	$opcion     = $_POST["opcion"];

	$idremitentes = '';
	foreach($inputs as $key => $input){
		$idremitentes.=$input.($key<count($inputs)-1?'*':'');
	}
	$idasesores = '';
	foreach($multipleasesor as $key => $asesor){
		$idasesores.=$asesor.($key<count($asesor)-1?'*':'');
	}
	//print_r('222222');exit;
	require '../../modelo/modelo_documento_asistente.php';
	$MC = new Modelo_documento();
	$consulta = $MC->Registrar_documento_asistente($iddocumento,$asunto,$idnumero,$idtipodocu,$idasesores,$idarea,$idremitentes,$idusuario,$opcion,$destinoImagen,$cont,$modalidad);
	echo $consulta;
?>
