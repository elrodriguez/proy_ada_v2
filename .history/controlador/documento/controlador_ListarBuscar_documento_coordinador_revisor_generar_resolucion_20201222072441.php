<?php
	  include '../../modelo/modelo_documento_coordinador.php';
    $boton = $_POST['boton'];
    if($boton==='buscar'){
      $inicio = 0;
      $limite = 5;
      if(isset($_POST['pagina'])){
        $pagina = $_POST['pagina'];
        $inicio = ($pagina -1) * $limite;
      }
      $valor = $_POST['valor'];
      $instancia = new Modelo_documento();
      $a = $instancia->listar_documento_revisor_generar_resolucion($valor);
      $b = count($a);
      $c = $instancia->listar_documento_revisor_generar_resolucion($valor,$inicio,$limite);
      echo json_encode($c)."*".$b;
    }
?>
