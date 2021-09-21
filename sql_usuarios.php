<?php

include 'conexao.php';

$v_valor = filter_input(INPUT_GET,'filtro');


if ($v_valor != ""){
$consulta_usuario = "SELECT * FROM usuarios WHERE cd_usuario like '%$v_valor%' 
                    ORDER BY cd_usuario";

$qtd_consulta_usuario = "SELECT count(*) as qtd FROM usuarios WHERE cd_usuario like '%$v_valor%' 
                    ORDER BY cd_usuario";
                    //echo $qtd_consulta_usuario;
$result_usuario = mysqli_query($conn ,$consulta_usuario);
$qtd_result_usuario = mysqli_query($conn ,$qtd_consulta_usuario);

$row_qtd = mysqli_fetch_array($qtd_result_usuario);
}else{
    $consulta_usuario = "SELECT * FROM usuarios 
                    ORDER BY cd_usuario";
    $qtd_consulta_usuario = "SELECT count(*) as qtd FROM usuarios 
                    ORDER BY cd_usuario";
//echo $consulta_usuario;
$result_usuario = mysqli_query($conn ,$consulta_usuario);
$qtd_result_usuario = mysqli_query($conn ,$qtd_consulta_usuario);

$row_qtd = mysqli_fetch_array($qtd_result_usuario);
}
?>