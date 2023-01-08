<?php 
session_start();
unset($_SESSION['email']);
unset($_SESSION['voted']);
unset($_SESSION['voter_id']);

header('location:index');

?>