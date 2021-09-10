<?php 
session_start();
$_SESSION['cd_usu'] = $_POST['login'];



echo $_SESSION['cd_usu'];
header("Location: home.php");



?>