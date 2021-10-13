<?php 
include 'conexao.php';
session_start();
$cd_usu = $_POST['login'];
$cd_senha = base64_encode($_POST['senha']);
$consulta_login_qtd = "SELECT COUNT(*) AS QTD FROM usuarios WHERE cd_usuario = '$cd_usu' and sn_ativo = 'S' and senha = '$cd_senha'";
$consulta_login = "SELECT * FROM usuarios WHERE cd_usuario = '$cd_usu' and senha = '$cd_senha' and sn_ativo = 'S'";

$result_login_qtd = mysqli_query($conn,$consulta_login_qtd);
$result_login = mysqli_query($conn,$consulta_login);
$row_qtd = mysqli_fetch_array($result_login_qtd);
$row_login = mysqli_fetch_array($result_login);

$_SESSION['nomeusuario'] = $row_login['nm_usuario'];
if($row_qtd['QTD'] == '1'){
    //$_COOKIE = $row_login['cd_usuario'];
    echo$_SESSION['cd_usu'] = $row_login['cd_usuario'];

header("Location: home.php");
}else{
    if($row_login['sn_ativo'] == 'N'){
        $_SESSION['msgerro'] = "Usuario desativado";
    }else{
        $_SESSION['msgerro'] = "Usuario ou senha invalido";
    }
    header("Location: index.php");
}


?>