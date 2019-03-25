<?php 
session_start();

unset($_SESSION);
session_destroy();
$_SESSION = [];

header("Location: seneca.php"); exit;


?>


