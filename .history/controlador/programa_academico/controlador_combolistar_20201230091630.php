<?php
	include '../../modelo/modelo_programa_academico.php';
	$MC = new Modelo_programa_academico();
	$consulta = $MC->listar_programa_academico();
	
	$nom_grado = '';
	$html = '<option value="otro">SELECCIONAR</option>';
	foreach($consulta as $grado){
		if($nom_grado != $grado['modalidad']){
			$html .= '<optgroup label="'.$grado['modalidad'].'">';
			foreach($consulta as $programa){
				$html .= "<option value='".$programa['id']."'>".$programa['descripcion']."</option>";
			}
			$html .= "</optgroup>";
		}
		$nom_grado = $grado['modalidad'];
	}

	echo $html;
?>
