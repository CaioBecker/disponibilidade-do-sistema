<?php
include 'conexao.php';
    $consulta_ano = "SELECT COUNT(*) AS QTD FROM ocorrencias_sistema where dt_inicio like '%$ano%'";
    $result_ano = mysqli_query($conn,$consulta_ano);
    $row_ano = mysqli_fetch_array($result_ano);
?>