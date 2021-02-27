<?php
	$cont=0;

	$revisor = $_POST['revisornumero'];
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
			$nombre1 = 'Archivo/'.$iddocumento.'/'.$imagen;
			//print_r($ruta1);exit;
			copy($ruta1, $destino1);
			$cont=1;
		}
	}else{
		$nombre1 = "0";
		$destino1="";
	}
	if ($_FILES["file-v2"]['tmp_name']!="") {
    	$file_type = $_FILES['file-v2']['type'];
        list($type, $extension) = explode('/', $file_type);
		if($extension == 'pdf'){
			$imagen=uniqid()."-".$_FILES['file-v2']['name'];
			$ruta1=$_FILES['file-v2']['tmp_name'];

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
	if ($_FILES["file-v3"]['tmp_name']!="") {
    	$file_type = $_FILES['file-v3']['type'];
        list($type, $extension) = explode('/', $file_type);
		if($extension == 'pdf'){
			$imagen3=uniqid()."-".$_FILES['file-v3']['name'];
			$ruta3=$_FILES['file-v3']['tmp_name'];

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
	
	require '../../modelo/modelo_documento_coordinador.php';

	$MC = new Modelo_documento();
	$consulta = $MC->subir_documento_anexos(3,$iddocumento,$nombre1,$nombre2,$nombre3,$revisor);
	echo $consulta;
?>
