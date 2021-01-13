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

    echo $password;
}else{
    echo 'error method';
    exit;
}