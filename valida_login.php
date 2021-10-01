<?php 
include 'conexao.php';
session_start();
$cd_usu = $_POST['login'];

$consulta_login_qtd = "SELECT COUNT(*) AS QTD FROM usuarios WHERE cd_usuario = '$cd_usu'";
$result_login_qtd = mysqli_query($conn,$consulta_login_qtd);
$row_qtd = mysqli_fetch_array($result_login_qtd);

$consulta_login = "SELECT * FROM usuarios WHERE cd_usuario = '$cd_usu'";
$result_login = mysqli_query($conn,$consulta_login);
$row_login = mysqli_fetch_array($result_login);

$_SESSION['nomeusuario'] = $row_login['nm_usuario'];
if($row_qtd['QTD'] == '1'){
    //$_COOKIE = $row_login['cd_usuario'];
    echo$_SESSION['cd_usu'] = $row_login['cd_usuario'];

header("Location: home.php");
}else{
    $_SESSION['msgerro'] = "Usuario não existe";
    header("Location: index.php");
}


?>