<?php
	$cont=0;
	if ($_FILES["file-a1"]['tmp_name']!="") {
    	$imagen=uniqid()."-".$_FILES['file-a1']['name'];
		$ruta1=$_FILES['file-a1']['tmp_name'];
		$destino1='Archivo/'.$imagen;
		copy($ruta1, $destino1);
		$cont=1;
	}else{
		$destino1="";
	}
	if ($_FILES["file-a4"]['tmp_name']!="") {
    	$imagen=uniqid()."-".$_FILES['file-a4']['name'];
		$ruta1=$_FILES['file-a4']['tmp_name'];
		$destino6='Archivo/'.$imagen;
		copy($ruta1, $destino6);
		$cont=1;
	}else{
		$destino6="";
	}
	$iddocumento = $_POST['iddocumentoanexos'];
	require '../../modelo/modelo_documento_coordinador.php';

	$MC = new Modelo_documento();
	$consulta = $MC->subir_documento_anexos(4,$iddocumento,$destino1,$destino6);
	echo $consulta;
?>