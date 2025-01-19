<?php  

session_start();
include 'handlers/Validation.php';

session_destroy();
redirection('login.php');

die;

?>