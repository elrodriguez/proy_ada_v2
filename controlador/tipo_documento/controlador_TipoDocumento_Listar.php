<?php
	require '../../modelo/modelo_tipodocumento.php';
	$boton = $_POST['boton'];
	if($boton==='buscar'){
	  $inicio = 0;
	  $limite = 5;
	  if(isset($_POST['pagina'])){
	    $pagina = $_POST['pagina'];
	    $inicio = ($pagina -1) * $limite;
	  }
	  $valor = $_POST['valor'];
	  $instancia = new Modelo_TipoDocumento();
	  $a = $instancia->listar_TipoDocumento($valor);
	  $b = count($a);
	  $c = $instancia->listar_TipoDocumento($valor,$inicio,$limite);
	  ///se imprime para poder exponerlos con json_encode javascript
	  echo json_encode($c)."*".$b;
	}
?>