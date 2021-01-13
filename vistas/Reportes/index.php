<!DOCTYPE html>
<html lang="en">
<head>	
	<meta charset="UTF-8">
	<title>Reportes</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
	<div class="container centrar">
		<div class="row">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h2>Reportes!</h2>
				</div>
				<div class="panel-body">
					<fieldset>
						<legend>
							<button class="btn btn-success" onclick="Consultar()">Mostrar Registros</button>
							<button class="btn btn-info"><a href="php/generar_reporte.php">Generar PDF</a></button>
						</legend>
					</fieldset>
					<div id="datos">
						
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/consola.js"></script>
</html>
<style>
	.centrar{
		padding: 5px;
	}

	.titulo{
		font-weight: 800;
	}
</style>