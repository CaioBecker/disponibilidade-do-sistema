<?php

include 'conexao.php';



$consulta_usuario_viu = "SELECT * FROM usuarios WHERE cd_usuario = '$id'";
//echo $consulta_usuario;
$result_usuario_viu = mysqli_query($conn ,$consulta_usuario_viu);
$row_usuario_viu = mysqli_fetch_array($result_usuario_viu);


?>