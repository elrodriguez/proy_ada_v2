<?php 
ob_start();

session_start();
if (!isset($_SERVER['HTTP_REFERER'])) {
    echo 'error';exit;
}

$email = isset($_POST['inputEmail'])?$_POST['inputEmail']:'';
$password = isset($_POST['inputPassword'])?$_POST['inputPassword']:'';