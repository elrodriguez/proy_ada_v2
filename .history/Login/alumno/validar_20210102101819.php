<?php 
ob_start();

session_start();
if (!isset($_SERVER['HTTP_REFERER'])) {
    echo 'error';
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = isset($_POST['inputEmail'])? htmlspecialchars($_POST['inputEmail']):'';
    $password = isset($_POST['inputPassword'])? htmlspecialchars($_POST['inputEmail']):'';

    echo $password;
}else{
    echo 'error';
    exit;
}