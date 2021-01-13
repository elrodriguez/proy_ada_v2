<?php
	$cont=0;
	$iddocumento = $_POST['iddocumentoanexos'];
	if ($_FILES["file-a1"]['tmp_name']!="") {
		$file_type = $_FILES['file-a1']['type'];
        list($type, $extension) = explode('/', $file_type);
		if($extension == 'pdf'){
			$imagen=uniqid()."-".$_FILES['file-a1']['name'];
			$ruta1=$_FILES['file-a1']['tmp_name'];

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
	if ($_FILES["file-a4v1"]['tmp_name']!="") {
    	$file_type = $_FILES['file-a4v1']['type'];
        list($type, $extension) = explode('/', $file_type);
		if($extension == 'pdf'){
			$imagen=uniqid()."-".$_FILES['file-a4v1']['name'];
			$ruta1=$_FILES['file-a4v1']['tmp_name'];

			$dir='../../Archivo/'.$iddocumento.'/';

			if (!file_exists($dir)) {
                mkdir($dir, 0777, true);
			}
			
			$destino2 = $dir.$imagen;
			$nombre2 = 'Archivo/'.$iddocumento.'/'.$imagen;
			//print_r($ruta1);exit;
			copy($ruta1, $destino2);
			$cont=1;
		}
	}else{
		$nombre2 = "0";
		$destino2="";
	}
	if ($_FILES["file-a4v3v"]['tmp_name']!="") {
    	$file_type = $_FILES['file-a4v3v']['type'];
        list($type, $extension) = explode('/', $file_type);
		if($extension == 'pdf'){
			$imagen3=uniqid()."-".$_FILES['file-a4v3v']['name'];
			$ruta3=$_FILES['file-a4v3v']['tmp_name'];

			$dir3='../../Archivo/'.$iddocumento.'/';

			if (!file_exists($dir3)) {
                mkdir($dir3, 0777, true);
			}
			
			$destino3 = $dir3.$imagen3;
			$nombre3 = 'Archivo/'.$iddocumento.'/'.$imagen3;
			//print_r($ruta1);exit;
			copy($ruta3, $destino3);
			$cont=1;
		}
	}else{
		$nombre3 = "0";
		$destino3="";
	}
	if ($_FILES["file-a4v3v"]['tmp_name']!="") {
    	$file_type = $_FILES['file-a4v3v']['type'];
        list($type, $extension) = explode('/', $file_type);
		if($extension == 'pdf'){
			$imagen4=uniqid()."-".$_FILES['file-a4v3v']['name'];
			$ruta4=$_FILES['file-a4v3v']['tmp_name'];

			$dir4='../../Archivo/'.$iddocumento.'/';

			if (!file_exists($dir4)) {
                mkdir($dir4, 0777, true);
			}
			
			$destino4 = $dir4.$imagen4;
			$nombre4 = 'Archivo/'.$iddocumento.'/'.$imagen3;
			//print_r($ruta1);exit;
			copy($ruta4, $destino3);
			$cont=1;
		}
	}else{
		$nombre4 = "0";
		$destino4="";
	}
	require '../../modelo/modelo_documento_coordinador.php';

	$MC = new Modelo_documento();
	$consulta = $MC->subir_documento_anexos(4,$iddocumento,$destino1,$destino6);
	echo $consulta;
?>
