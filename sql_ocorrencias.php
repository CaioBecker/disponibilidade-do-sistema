<?php

include 'conexao.php';

$cd_oco_vali = filter_input(INPUT_GET,'filtro');
$dt_inicio_vali = filter_input(INPUT_GET,'dt_inicio');
$dt_fim_vali = filter_input(INPUT_GET,'dt_fim');

if ($dt_inicio_vali != ''){
    $dt_inicio = date('Y-m-d H:i:s', strtotime($dt_inicio_vali));
    //echo '</br> inicio: </br>' . $dt_inicio;
}else{
    $dt_inicio = '';
}


if ($dt_fim_vali != ''){
    $dt_fim = date('Y-m-d H:i:s', strtotime($dt_fim_vali));
    //echo '</br> inicio: </br>' . $dt_fim;
}else{
    $dt_fim = '';
}


if($cd_oco_vali != ''){
    $cd_oco = $cd_oco_vali;
    //echo '</br> cd oco: </br>' . $cd_oco;
}else{
    $cd_oco = '';
}


  ////////////////////////////////////////////////////
 ////////VALIDAÇÃO SQL///////////////////////////////
////////////////////////////////////////////////////


if($cd_oco != '' && $dt_inicio != '' && $dt_fim != '')
{
    $consulta_ocorrencia = "SELECT * FROM ocorrencias_sistema WHERE cd_ocorrencia = '$cd_oco' AND dt_inicio >= '$dt_inicio' AND dt_fim <= '$dt_fim' 
                        ORDER BY cd_ocorrencia";
    //echo $consulta_ocorrencia;
    $result_ocorrencia = mysqli_query($conn ,$consulta_ocorrencia);
    
}
elseif($cd_oco == '' && $dt_inicio != '' && $dt_fim != '')
{
    $consulta_ocorrencia = "SELECT * FROM ocorrencias_sistema WHERE dt_inicio >= '$dt_inicio' AND dt_fim <= '$dt_fim' 
                        ORDER BY cd_ocorrencia";
    //echo $consulta_ocorrencia;
    $result_ocorrencia = mysqli_query($conn ,$consulta_ocorrencia);
    
}
elseif($cd_oco != '' && $dt_inicio == '' && $dt_fim != '')
{
    $consulta_ocorrencia = "SELECT * FROM ocorrencias_sistema WHERE cd_ocorrencia = '$cd_oco' AND dt_fim <= '$dt_fim' 
                        ORDER BY cd_ocorrencia";
    //echo $consulta_ocorrencia;
    $result_ocorrencia = mysqli_query($conn ,$consulta_ocorrencia);
    
}
elseif($cd_oco != '' && $dt_inicio != '' && $dt_fim == '')
{
    $consulta_ocorrencia = "SELECT * FROM ocorrencias_sistema WHERE cd_ocorrencia = '$cd_oco' AND dt_inicio >= '$dt_inicio'  
                        ORDER BY cd_ocorrencia";
    //echo $consulta_ocorrencia;
    $result_ocorrencia = mysqli_query($conn ,$consulta_ocorrencia);
    
}
elseif($cd_oco == '' && $dt_inicio =='' && $dt_fim != '')
{
    $consulta_ocorrencia = "SELECT * FROM ocorrencias_sistema WHERE  dt_fim <= '$dt_fim' 
                        ORDER BY cd_ocorrencia";
    //echo $consulta_ocorrencia;
    $result_ocorrencia = mysqli_query($conn ,$consulta_ocorrencia);
    
}
elseif($cd_oco == '' && $dt_inicio != '' && $dt_fim == '')
{
    $consulta_ocorrencia = "SELECT * FROM ocorrencias_sistema WHERE dt_inicio >= '$dt_inicio' 
                        ORDER BY cd_ocorrencia";
    //echo $consulta_ocorrencia;
    $result_ocorrencia = mysqli_query($conn ,$consulta_ocorrencia);
    
}
elseif ($cd_oco != '' && $dt_inicio == '' && $dt_fim == '')
{
    $consulta_ocorrencia = "SELECT * FROM ocorrencias_sistema WHERE cd_ocorrencia = '$cd_oco' 
                        ORDER BY cd_ocorrencia";
    //echo $consulta_ocorrencia;
    $result_ocorrencia = mysqli_query($conn ,$consulta_ocorrencia);
    
}
else
{
    $consulta_ocorrencia = "SELECT * FROM ocorrencias_sistema
                        ORDER BY cd_ocorrencia";
    //echo $consulta_ocorrencia;
    $result_ocorrencia = mysqli_query($conn ,$consulta_ocorrencia);
    
}
//$row_oco = mysqli_fetch_array($result_ocorrencia);
?>