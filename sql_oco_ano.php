<?php
include 'conexao.php';
    if(@$_SESSION['cd_usu'] != ''){
        $consulta_ano = "SELECT COUNT(*) as QTD, serv.servico
            FROM ocorrencias_sistema os
            INNER JOIN servicos serv
                ON serv.cd_servico = os.cd_servico where dt_inicio like '%$ano%' and sn_ti = 'S'";
    }else{
        $consulta_ano = "SELECT COUNT(*) as QTD, serv.servico
            FROM ocorrencias_sistema os
            INNER JOIN servicos serv
                ON serv.cd_servico = os.cd_servico where dt_inicio like '%$ano%' and sn_ti = 'N'";
    }
    $result_ano = mysqli_query($conn,$consulta_ano);
    $row_ano = mysqli_fetch_array($result_ano); 
?>