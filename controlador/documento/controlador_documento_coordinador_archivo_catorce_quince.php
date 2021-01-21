
<?php
	include '../../modelo/modelo_documento_coordinador.php';
	$codigo           =  $_POST["codigo"];
    $flag          =  $_POST["flag"];
    $valor          =  $_POST["valor"];
	$MC = new Modelo_documento();
	$consulta = $MC->actualizar_campo_archivo($codigo,$flag,$valor);
	echo $consulta;
?>