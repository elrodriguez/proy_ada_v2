<?php
	  include '../../modelo/modelo_ciudadano.php';
    $boton = $_POST['boton'];
    if($boton==='buscar'){
      $inicio = 0;
      $limite = 5;
      if(isset($_POST['pagina'])){
        $pagina = $_POST['pagina'];
        $inicio = ($pagina -1) * $limite;
      }
      $valor = $_POST['valor'];
      $instancia = new Modelo_ciuadano();
      $a = $instancia->listar_ciudadanoremitente($valor);
      $b = count($a);
      $c = $instancia->listar_ciudadanoremitente($valor,$inicio,$limite);
      echo json_encode($c)."*".$b;
    }
?>