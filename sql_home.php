<?php

include 'conexao.php';

$var_cd_usu = $_SESSION['cd_usu'];

$consulta_usuario = "SELECT * FROM usuarios WHERE cd_usuario = '$var_cd_usu'";
//echo $consulta_usuario;
$result_usuario = mysqli_query($conn ,$consulta_usuario);
$row_usuario_home = mysqli_fetch_array($result_usuario);

$_SESSION['adm'] = $row_usuario_home['adm'];
?>