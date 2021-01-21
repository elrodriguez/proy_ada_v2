<?php
	$cont=0;
	$iddocumento= $_POST["iddocumento"];
	if ($_FILES["id_archivo"]['tmp_name']!="") {
    	$imagen=uniqid()."-".$_FILES['id_archivo']['name'];
		$ruta1=$_FILES['id_archivo']['tmp_name'];

		$dir='../../Archivo/'.$iddocumento.'/';

		if (!file_exists($dir)) {
			mkdir($dir, 0777, true);
		}

		$destino1 = $dir.$imagen;
		$destinoImagen = 'Archivo/'.$iddocumento.'/'.$imagen;
		//print_r($ruta1);exit;
		copy($ruta1, $destino1);
		$cont=1;
	}else{
		$destinoImagen="";
	}
	
	$asunto     = strtoupper($_POST["asunto"]);
	$idnumero   = strtoupper($_POST["idnumero"]);
	$idtipodocu = $_POST["idtipodocu"];
	$idasesor   = $_POST["idasesor"];
	$idarea     = $_POST["idarea"];
	$idremitente= $_POST["idremitente"];
	$idusuario  = $_POST["idusuario"];
	$opcion     = $_POST["opcion"];

	require '../../modelo/modelo_documento.php';
	$MC = new Modelo_documento();
	$consulta = $MC->Registrar_documento($iddocumento,$asunto,$idnumero,$idtipodocu,$idasesor,$idarea,$idremitente,$idusuario,$opcion,$destinoImagen,$cont);
	echo $consulta;
?>
