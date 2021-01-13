<?php
session_start();
  if (isset($_SESSION['usuario'])) {
    header('Location: ../vistas/admin.php');
  }
?>
<!DOCTYPE HTML>
<html lang="zxx">
<head>
	<title>Iniciar Sesion</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8" />
	<meta name="keywords" content="Full Screen Enroll Form Responsive Widget,Login form widgets, Sign up Web forms , Login signup Responsive web form,Flat Pricing table,Flat Drop downs,Registration Forms,News letter Forms,Elements" />
	<link rel="stylesheet" href="bootstrap.min.css" crossorigin="anonymous">
	</script>
	<link rel="stylesheet" href="_plantilla/css/style.css" type="text/css" media="all" />
	<link rel="stylesheet" href="_plantilla/css/fontawesome-all.css">
	<link rel="stylesheet" href="_plantilla/js/sweetalert.css">
</head>
<body>
	<div class="main-w3ls">
		<div class="left-content" style="text-align: center;" align="center">
      <br>
			<img  style="width: 90%;" src="_plantilla/images/ucsur_inicio.jpg" />
			<div class="copyright">
			</div>
		</div>
		<div class="right-form-agile">
			<div class="sub-main-w3">
				<br>
				<h3 style="color:#0071b4;">INICIAR SESION </h3>
				<br>
				<div class="form-style-agile">
					<label style="color:#000000;">Usuario</label>
					<br>
					<div class="input-group mb-3">
					    <div class="input-group-prepend" >
					    <span class="input-group-text" id="basic-addon1" style="background-color: white"><span style="color:#0071b4" class="fas fa-user"></span></span>
				        </div>
						<input type="text" class="form-control" placeholder="Ingresar Usuario" id="txt_usuario">
					</div>
				</div>
				<div class="form-style-agile">
					<label style="color:#000000;">Contraseña</label>
					<br>
					<div class="input-group mb-3">
					    <div class="input-group-prepend" >
					  	    <br>
					        <span class="input-group-text" id="basic-addon1" style="background-color: white"><span style="color:#0071b4" class="fa  fa-unlock-alt"></span></span>
					    </div>
						<input type="password" class="form-control" placeholder="Ingresar Contraseña" aria-label="Password" id="txt_pass">
					</div>
				</div>
				<a href="alumno/index.php" class="btn btn-default" style="box-shadow: 0 0 0 .2rem rgba(0,0,0,0);font-size: 20px; font-weight:bold">Seguimiento Documentario</a><br><br>
				<button onclick="VerificarUsuario()" style="background: #0071b4 ;border-top-color:#0071b4;border-bottom-color:#0071b4;border-left-color:#0071b4 ;border-right-color:#0071b4 ;color: white;" class="btn btn-warning btn-block btn-lg" >INGRESAR</button>
			</div>
		</div>
	</div>
</body>
<script src="../vistas/_recursos/js/jquery.min.js"></script>
<script src="../vistas/_recursos/js/consola_usuario.js"></script>
<script src="_plantilla/js/sweetalert.min.js"></script>
</html>
