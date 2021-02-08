<?php
	$cont=0;
	
	$modalidad = $_POST['cbm_tipo'];
	
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
		$idasesores.=$asesor.($key<count($multipleasesor)-1?'*':'');
	}
	//print_r('222222');exit;
	require '../../modelo/modelo_documento_asistente.php';
	$MC = new Modelo_documento();

	$file_type = $_FILES['id_archivo']['type'];
	list($type, $extension) = explode('/', $file_type);
	$destino_carpeta = 'Archivo';
	$consulta = $MC->Registrar_documento_asistente($extension,$asunto,$idnumero,$idtipodocu,$idasesores,$idarea,$idremitentes,$idusuario,$opcion,$destino_carpeta,$cont,$modalidad);
	print_r($consulta);
	$iddocumento= $consulta;

	if ($_FILES["id_archivo"]['tmp_name']!="") {
    	$imagen=uniqid()."-".$_FILES['id_archivo']['name'];
		$ruta1=$_FILES['id_archivo']['tmp_name'];

		//print_r($ruta1);exit;
		$dir='../../'.$destino_carpeta.'/'.$iddocumento.'/';

		if (!file_exists($dir)) {
			mkdir($dir, 0777, true);
		}
		
		$destino1 = $dir.$iddocumento.'.'.$extension;
		$destinoImagen = $destino_carpeta.'/'.$iddocumento.'/'.$iddocumento.'.'.$extension;
		//print_r($ruta1);exit;
		copy($ruta1, $destino1);
		$cont=1;

		//$consulta = $MC->subir_documento_anexos(1,$iddocumento,$destinoImagen);
	}else{
		$destinoImagen="";
	}

	echo 1;
?>
