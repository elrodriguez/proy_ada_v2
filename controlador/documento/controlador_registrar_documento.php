<?php
	$cont=0;
	if ($_FILES["id_archivo"]['tmp_name']!="") {
    $imagen=uniqid()."-".$_FILES['id_archivo']['name'];
	$ruta1=$_FILES['id_archivo']['tmp_name'];
	$destinoImagen='Archivo/'.$imagen;
	copy($ruta1, $destinoImagen);
	$cont=1;
	}else{
	$destinoImagen="";
	}
	$iddocumento= $_POST["iddocumento"];
	$asunto     = strtoupper($_POST["asunto"]);
	$idnumero   = strtoupper($_POST["idnumero"]);
	$idtipodocu = $_POST["idtipodocu"];
	$idasesor   = $_POST["idasesor"];
	$idarea     = $_POST["idarea"];
	$idremitente= $_POST["idremitente"];
	$idusuario  = $_POST["idusuario"];
	$opcion     = $_POST["opcion"];
	//
	// echo "<script>'alert($iddocumento)'</script>";
	// echo "<script>'alert($asunto)'</script>";
	// echo "<script>'alert($idtipodocu)'</script>";
	// echo "<script>'alert($idasesor)'</script>";
	// echo "<script>'alert($idarea)'</script>";
	// echo "<script>'alert($idremitente)'</script>";
	// echo "<script>'alert($idusuario)'</script>";
	// echo "<script>'alert($opcion)'</script>";
	// echo "<script>'alert($destinoImagen)'</script>";
	// echo "<script>'alert($cont)'</script>";
	// echo "<script>'alert($destinoImagen)'</script>";
	// echo "<script>'alert($cont)'</script>";

	require '../../modelo/modelo_documento.php';
	$MC = new Modelo_documento();
	$consulta = $MC->Registrar_documento($iddocumento,$asunto,$idnumero,$idtipodocu,$idasesor,$idarea,$idremitente,$idusuario,$opcion,$destinoImagen,$cont);
	echo $consulta;
?>
