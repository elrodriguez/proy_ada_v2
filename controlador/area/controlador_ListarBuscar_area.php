<?php
	  include '../../modelo/modelo_area.php';
    $boton = $_POST['boton'];
    if($boton==='buscar'){
      $inicio = 0;
      $limite = 5;
      if(isset($_POST['pagina'])){
        $pagina = $_POST['pagina'];
        $inicio = ($pagina -1) * $limite;
      }
      $valor = $_POST['valor'];
      $instancia = new Modelo_area();
      $a = $instancia->listar_areas($valor);
      $b = count($a);
      $c = $instancia->listar_areas($valor,$inicio,$limite);
      echo json_encode($c)."*".$b;
    }
?>