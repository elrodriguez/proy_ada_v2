<?php
	$cont=0;
	if ($_FILES["file-a1"]['tmp_name']!="") {
		$extension = end(explode(".", $_FILES['file-a1']['name']));

		if($extension == 'pdf'){
			
			$imagen=uniqid()."-".$_FILES['file-a1']['name'];
			$ruta1=$_FILES['file-a1']['tmp_name'];

			$dir='Archivo/'.$iddocumento.'/'.$imagen;

			if (!file_exists($dir)) {
                mkdir($dir, 0777, true);
			}
			
			
			//print_r($ruta1);exit;
			copy($ruta1, $destino1);
			$cont=1;
			
			$iddocumento = $_POST['iddocumentoanexos'];
			require '../../modelo/modelo_documento_coordinador.php';
		
			$MC = new Modelo_documento();
			$consulta = $MC->subir_documento_anexos(3,$iddocumento,$destino1,null);
			echo "Archivo cargado correctamente";
		
		}else{
			echo 'Solo Archivos pdf';
		}
	}else{
		echo 'Seleccionar un archivo';
	}
?>