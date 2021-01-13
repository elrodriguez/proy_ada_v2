<?php 
ob_start();

session_start();
if (!isset($_SERVER['HTTP_REFERER'])) {

    echo 'error';
}