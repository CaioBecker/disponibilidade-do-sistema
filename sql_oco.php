<?php

include 'conexao.php';


//echo $data_ant. "</br>";
$consulta_oco = "SELECT * FROM ocorrencias_sistema WHERE dt_inicio like '%$data_while%' and cd_servico = '$cd_serv'";
$consulta_oco_dias = "SELECT * FROM ocorrencias_sistema WHERE dt_inicio like '%$data_while%' and cd_servico = '$cd_serv'";
$consulta_oco_qtd = "SELECT COUNT(*) AS QTD FROM ocorrencias_sistema WHERE dt_inicio like '%$data_while%' and cd_servico = '$cd_serv'";
//echo '</br> consulta: </br>' . $consulta_oco;
$result_oco = mysqli_query($conn, $consulta_oco);
$result_oco_dias = mysqli_query($conn, $consulta_oco_dias);
$result_oco_qtd = mysqli_query($conn, $consulta_oco_qtd);

$row_oco = mysqli_fetch_array($result_oco);
$row_oco_qtd = mysqli_fetch_array($result_oco_qtd);
//echo $consulta_mes = "SELECT * FROM ocorrencias_sistema WHERE dt_inicio > '2021-01-01' and dt_fim < '2021-12-31'";
//echo $result_oco;

?>