<?php
	print_r($_POST);
	$cont=0;
	$iddocumento = $_POST['iddocumentovcorreccionesocho'];
	$tipo = $_POST['tipo-e4'];
	if ($_FILES["file-ax1-e4"]['tmp_name']!="") {
		$file_type = $_FILES['file-ax1-e4']['type'];
        list($type, $extension) = explode('/', $file_type);
		if($extension == 'pdf'){
			$imagen=uniqid()."-".$_FILES['file-ax1-e4']['name'];
			$ruta1=$_FILES['file-ax1-e4']['tmp_name'];

			$dir='../../Archivo/'.$iddocumento.'/';

			if (!file_exists($dir)) {
                mkdir($dir, 0777, true);
			}
			
			$destino1 = $dir.$imagen;
			$nombre1 = 'Archivo/'.$iddocumento.'/'.$imagen;
			//print_r($ruta1);exit;
			copy($ruta1, $destino1);
			$cont=1;
		}
	}else{
		$nombre1 = "0";
		$destino1="";
	}
	
	
	require '../../modelo/modelo_documento_coordinador.php';

	$MC = new Modelo_documento();
	$consulta = $MC->subir_documento_anexos($tipo,$iddocumento,$nombre1,null);
	echo $consulta;
?>
