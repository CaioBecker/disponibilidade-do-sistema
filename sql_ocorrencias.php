<?php

include 'conexao.php';

$cd_oco = filter_input(INPUT_GET,'filtro');
$dt_inicio = filter_input(INPUT_GET,'dt_inicio');
$dt_fim = filter_input(INPUT_GET,'dt_fim');

if ($cd_oco != "" && $dt_inicio != '' && $dt_fim != ''){
$consulta_usuario = "SELECT * FROM ocorrencias_sistema WHERE cd_ocorrencia like '%$cd_oco%' AND dt_inicio = '$dt_inicio' AND dt_fim = '$dt_fim' 
                    ORDER BY cd_usuario";
//echo $consulta_usuario;
$result_usuario = mysqli_query($conn ,$consulta_usuario);

}else if($cd_oco = "" && $dt_inicio != '' && $dt_fim != ''){
    $consulta_usuario = "SELECT * FROM ocorrencias_sistema WHERE dt_inicio = '$dt_inicio' AND dt_fim = '$dt_fim' 
    ORDER BY cd_usuario";
//echo $consulta_usuario;
$result_usuario = mysqli_query($conn ,$consulta_usuario);
}else if($cd_oco != "" && $dt_inicio = '' && $dt_fim != ''){
    $consulta_usuario = "SELECT * FROM ocorrencias_sistema WHERE cd_ocorrencia like '%$cd_oco%' AND dt_fim = '$dt_fim' 
    ORDER BY cd_usuario";
//echo $consulta_usuario;
$result_usuario = mysqli_query($conn ,$consulta_usuario);

}else if($cd_oco != "" && $dt_inicio != '' && $dt_fim = ''){
    $consulta_usuario = "SELECT * FROM ocorrencias_sistema WHERE cd_ocorrencia like '%$cd_oco%' AND dt_inicio = '$dt_inicio'  
                        ORDER BY cd_usuario";
    //echo $consulta_usuario;
    $result_usuario = mysqli_query($conn ,$consulta_usuario);
}else if($cd_oco = "" && $dt_inicio = '' && $dt_fim != ''){
    $consulta_usuario = "SELECT * FROM ocorrencias_sistema WHERE  dt_fim = '$dt_fim' 
                        ORDER BY cd_usuario";
    //echo $consulta_usuario;
    $result_usuario = mysqli_query($conn ,$consulta_usuario);
}else if($cd_oco = "" && $dt_inicio != '' && $dt_fim = ''){
    $consulta_usuario = "SELECT * FROM ocorrencias_sistema WHERE dt_inicio = '$dt_inicio' 
                        ORDER BY cd_usuario";
    //echo $consulta_usuario;
    $result_usuario = mysqli_query($conn ,$consulta_usuario);
}else if ($cd_oco != "" && $dt_inicio = '' && $dt_fim = ''){
    $consulta_usuario = "SELECT * FROM ocorrencias_sistema WHERE cd_ocorrencia like '%$cd_oco%' 
                        ORDER BY cd_usuario";
    //echo $consulta_usuario;
    $result_usuario = mysqli_query($conn ,$consulta_usuario);
}else{
    $consulta_usuario = "SELECT * FROM ocorrencias_sistema
                        ORDER BY cd_usuario";
    //echo $consulta_usuario;
    $result_usuario = mysqli_query($conn ,$consulta_usuario);
}
//$row_oco = mysqli_fetch_array($result_usuario);
?>