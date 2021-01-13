<?php
	$cont=0;
	if ($_FILES["file-v2"]['tmp_name']!="") {
		$file_type = $_FILES['file-v2']['type'];
        list($type, $extension) = explode('/', $file_type);
		$iddocumento = $_POST['iddocumentov2'];

		if($extension == 'pdf'){
			
			$imagen=uniqid()."-".$_FILES['file-v2']['name'];
			$ruta1=$_FILES['file-v2']['tmp_name'];

			$dir='../../../Archivo/'.$iddocumento.'/';

			if (!file_exists($dir)) {
                mkdir($dir, 0777, true);
			}
			
			$destino1 = 'Archivo/'.$iddocumento.'/'.$imagen;
			//print_r($ruta1);exit;
			copy($ruta1, $destino1);
			$cont=1;
			require '../../../modelo/modelo_documento_coordinador.php';
		
			$MC = new Modelo_documento();
			$consulta = $MC->subir_documento_anexos(6,$iddocumento,$destino1,null);
			echo "Archivo cargado correctamente";
		
		}else{
			echo 'Solo Archivos pdf';
		}
	}else{
		echo 'Seleccionar un archivo';
	}
?>