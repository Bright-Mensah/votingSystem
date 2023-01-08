<?php 
session_start();

unset($_SESSION['loginSuccess']);
unset($_SESSION['hiddenEmail']);

header('location:index.php');

?>
