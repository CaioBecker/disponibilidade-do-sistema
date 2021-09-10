<?php

include 'conexao.php';



$consulta_usuario = "SELECT * FROM usuarios WHERE cd_usuario = '$id'";
//echo $consulta_usuario;
$result_usuario = mysqli_query($conn ,$consulta_usuario);
$row_usuario_edit = mysqli_fetch_array($result_usuario);


?>