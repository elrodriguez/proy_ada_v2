<?php
	$cont=0;
	$iddocumento = $_POST['iddocumentoturniting'];
	if ($_FILES["file-turniting"]['tmp_name']!="") {
    	$imagen=uniqid()."-".$_FILES['file-turniting']['name'];
		$ruta1=$_FILES['file-turniting']['tmp_name'];

		$dir='../../Archivo/'.$iddocumento.'/';

		if (!file_exists($dir)) {
			mkdir($dir, 0777, true);
		}

		$destino1 = $dir.$imagen;
		$nombre1 = str_replace(' ','-','Archivo/'.$iddocumento.'/'.$imagen);
		//print_r($ruta1);exit;
		copy($ruta1, $destino1);
		$cont=1;
	}else{
		$destinoImagen="";
	}
	$porcentaje = $_POST['porcentaje'];

	require '../../modelo/modelo_documento_asistente.php';

	$MC = new Modelo_documento();
	$consulta = $MC->subir_documento_turniting($iddocumento,$porcentaje,$nombre1);
	echo $consulta;
?>
