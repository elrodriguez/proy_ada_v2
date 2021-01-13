<?php
	$cont=0;
	if ($_FILES["file-turniting"]['tmp_name']!="") {
    	$imagen=uniqid()."-".$_FILES['file-turniting']['name'];
		$ruta1=$_FILES['file-turniting']['tmp_name'];
		$destinoImagen='Archivo/'.$imagen;
		//print_r($ruta1);exit;
		copy($ruta1, $destinoImagen);
		$cont=1;
	}else{
		$destinoImagen="";
	}
	$porcentaje = $_POST['porcentaje'];

	require '../../modelo/modelo_documento_asistente.php';
	
	$MC = new Modelo_documento();
	$consulta = $MC->Registrar_documento_asistente($iddocumento,$asunto,$idnumero,$idtipodocu,$idasesor,$idarea,$idremitente,$idusuario,$opcion,$destinoImagen,$cont,$modalidad);
	echo $consulta;
?>
