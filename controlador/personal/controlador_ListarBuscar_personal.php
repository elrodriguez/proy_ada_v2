<?php
	  include '../../modelo/modelo_personal.php';
    $boton = $_POST['boton'];
    if($boton==='buscar'){
      $inicio = 0;
      $limite = 5;
      if(isset($_POST['pagina'])){
        $pagina = $_POST['pagina'];
        $inicio = ($pagina -1) * $limite;
      }
      $valor = $_POST['valor'];
      $instancia = new Modelo_personal();
      $a = $instancia->listar_personal($valor);
      $b = count($a);
      $c = $instancia->listar_personal($valor,$inicio,$limite);
      echo json_encode($c)."*".$b;
    }
?>