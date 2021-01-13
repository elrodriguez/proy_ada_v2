<?php
	  include '../../modelo/modelo_personal.php';
    $MC = new Modelo_personal();
    $id = $_GET['id'];
	  $consulta = $MC->listar_combo_tipo_docente_detalle($id);
	  echo json_encode($consulta);
?>