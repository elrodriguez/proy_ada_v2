<?php
	$cont=0;
	$iddocumento = $_POST['iddocumentovcorrecciones'];
	if ($_FILES["file-ax1"]['tmp_name']!="") {
		$file_type = $_FILES['file-ax1']['type'];
        list($type, $extension) = explode('/', $file_type);
		if($extension == 'pdf'){
			$imagen=uniqid()."-".$_FILES['file-ax1']['name'];
			$ruta1=$_FILES['file-ax1']['tmp_name'];

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
	if ($_FILES["file-pc"]['tmp_name']!="") {
    	$file_type = $_FILES['file-pc']['type'];
        list($type, $extension) = explode('/', $file_type);
		if($extension == 'pdf'){
			$imagen=uniqid()."-".$_FILES['file-pc']['name'];
			$ruta1=$_FILES['file-pc']['tmp_name'];

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
	if ($_FILES["file-carta"]['tmp_name']!="") {
    	$file_type = $_FILES['file-carta']['type'];
        list($type, $extension) = explode('/', $file_type);
		if($extension == 'pdf'){
			$imagen3=uniqid()."-".$_FILES['file-carta']['name'];
			$ruta3=$_FILES['file-carta']['tmp_name'];

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
	$consulta = $MC->subir_documento_anexos(8,$iddocumento,$nombre1,$nombre2,$nombre3);
	echo $consulta;
?>
