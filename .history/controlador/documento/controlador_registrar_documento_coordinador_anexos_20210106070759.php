<?php
	$cont=0;
	$iddocumento = $_POST['iddocumentoanexos'];
	if ($_FILES["file-v1"]['tmp_name']!="") {
		$file_type = $_FILES['file-v1']['type'];
        list($type, $extension) = explode('/', $file_type);
		if($extension == 'pdf'){
			$imagen=uniqid()."-".$_FILES['file-v1']['name'];
			$ruta1=$_FILES['file-v1']['tmp_name'];

			$dir='../../Archivo/'.$iddocumento.'/';

			if (!file_exists($dir)) {
                mkdir($dir, 0777, true);
			}
			
			$destino1 = $dir.$imagen;
			$nombre = 'Archivo/'.$iddocumento.'/'.$imagen;
			//print_r($ruta1);exit;
			copy($ruta1, $destino1);
			$cont=1;
		}
	}else{
		$destino1="";
	}
	if ($_FILES["file-v2"]['tmp_name']!="") {
    	$imagen=uniqid()."-".$_FILES['file-v2']['name'];
		$ruta1=$_FILES['file-v2']['tmp_name'];
		$destino2='Archivo/'.$imagen;
		//print_r($ruta1);exit;
		copy($ruta1, $destino6);
		$cont=1;
	}else{
		$destino2="";
	}
	if ($_FILES["file-v3"]['tmp_name']!="") {
    	$imagen=uniqid()."-".$_FILES['file-v3']['name'];
		$ruta1=$_FILES['file-v3']['tmp_name'];
		$destino3='Archivo/'.$imagen;
		//print_r($ruta1);exit;
		copy($ruta1, $destino3);
		$cont=1;
	}else{
		$destino3="";
	}
	
	require '../../modelo/modelo_documento_coordinador.php';

	$MC = new Modelo_documento();
	$consulta = $MC->subir_documento_anexos(3,$iddocumento,$destino1,$destino6);
	echo $consulta;
?>
