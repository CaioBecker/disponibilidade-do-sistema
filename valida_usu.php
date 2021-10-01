<?php 

echo $_COOKIE['cd_usu'];
if(@$_COOKIE['cd_usu'] == ''){
    $_SESSION['msgerro'] = "Primeiro você tem que logar";
    //header('Location: index.php');
}