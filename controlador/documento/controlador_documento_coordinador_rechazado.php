<?php
	include '../../modelo/modelo_documento_coordinador.php';
	$codigo =  $_POST["codigo"];
	$estado =  $_POST["estado"];
	$etapa =  $_POST["etapa"];
	$MC = new Modelo_documento();
	$consulta = $MC->Rechazado_documento($codigo,$estado,$etapa);
	$cambia = $MC->cambiar_fecha_revisor_correo($codigo);
	echo $consulta;

?>
