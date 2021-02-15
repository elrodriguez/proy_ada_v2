<?php
	  include '../../modelo/modelo_cobranza.php';
    $boton = $_POST['boton'];
    if($boton==='buscar'){
      $inicio = 0;
      $limite = 5;
      if(isset($_POST['pagina'])){
        $pagina = $_POST['pagina'];
        $inicio = ($pagina -1) * $limite;
      }
      $valor = $_POST['valor'];
      $instancia = new modelo_cobranza();
      $a = $instancia->listar_asesor($valor);
      $b = count($a);
      $c = $instancia->listar_asesor($valor,$inicio,$limite);
      //print_r($b);
      echo json_encode($c)."*".$b;
    }
?>