<?php 


if(@$_SESSION['cd_usu'] == ''){
    $_SESSION['msgerro'] = "Primeiro você tem que logar";
    header('Location: index.php');
}