<?php 
ob_start();

session_start();
if (!isset($_SERVER['HTTP_REFERER'])) {
    echo 'error url';
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = isset($_POST['inputEmail'])? htmlspecialchars($_POST['inputEmail']):'';
    $password = isset($_POST['inputPassword'])? htmlspecialchars($_POST['inputPassword']):'';

    require_once('../modelo/modelo_conexion.php');
    $conexion = new conexion();
    $conexion->conectar();
        
    $sql = "CALL SP_LOGINCIUDADANO('$email','$password')";

    $arreglo = array();
    if ($consulta = $conexion->conexion->query($sql)) {

        while ($consulta_VU = mysqli_fetch_array($consulta)) {
            $arreglo[] = $consulta_VU;
        }
        if(count($arreglo)>0){
            $_SESSION['alumno']=$arreglo[0]['ciudadano_cod'];
            $_SESSION['nombre_completo']=$arreglo[0]['ciud_nombres'].' '.$arreglo[0]['ciud_apellidoPate'].' '.$arreglo[0]['ciud_apellidoMate'];
            header("Location: ../seguimiento.php");
            exit;
        }else{
            header("Location: index.php?msg=3r0l");
            exit;
        }
        $conexion->cerrar();
    }
            
}else{
    echo 'error method';
    exit;
}