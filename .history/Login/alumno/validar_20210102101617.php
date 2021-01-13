<?php 
ob_start();

session_start();
if (!isset($_SERVER['HTTP_REFERER'])) {
    echo 'error';
    exit;
}

$email = isset($_POST['inputEmail'])? htmlspecialchars($_POST['inputEmail']):'';
$password = isset($_POST['inputPassword'])? htmlspecialchars($_POST['inputEmail']):'';