<?php
$usuario = $_POST['user'];
$pass = $_POST['pass'];
$nom = $_POST['nom'];
$img = $_POST['img'];
$usu = $_POST['usuario'];
$codigo_personal=$_POST['codigo_personal'];
$idusuario = $_POST['idusuario'];
session_start();
$_SESSION['usuario'] = $usuario;
$_SESSION['pass'] = $pass;
$_SESSION['nombre_usuario'] = $nom;
$_SESSION['imagen_usuario'] = $img; 
$_SESSION['usu'] = $usu; 
$_SESSION['codigo_personal']=$codigo_personal;
$_SESSION['codigo_usuario']=$idusuario;
?>

