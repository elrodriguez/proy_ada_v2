<?php
	  include '../../modelo/modelo_personal.php';
    $instancia = new Modelo_personal();
    $a = $instancia->listar_docente($valor);
    $b = count($a);
?>