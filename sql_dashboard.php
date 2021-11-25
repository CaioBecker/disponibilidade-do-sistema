<?php
    include 'conexao.php';

    $consulta_oco = "SELECT 
                        MONTH(os.DT_INICIO) AS MES, YEAR(os.DT_INICIO) AS ANO,
                        sv.CD_SERVICO, sv.SERVICO, sv.RGB, sv.SN_TI,
                        SUM(43200) AS MINUTOS_TOTAIS_MES, 
                        SUM(TIMESTAMPDIFF(MINUTE, os.DT_INICIO, os.DT_FIM)) AS MINUTOS_FORA_MES,
                        ROUND((1-(SUM(TIMESTAMPDIFF(MINUTE, os.DT_INICIO, os.DT_FIM))/SUM(43200)))*100,0) AS DISPONIBILIDADE
                        FROM servicos sv
                        LEFT JOIN ocorrencias_sistema os
                        ON os.CD_SERVICO = sv.CD_SERVICO
                        WHERE MONTH(os.DT_INICIO) = 11
                        AND YEAR(os.DT_INICIO) = 2021
                        GROUP BY MONTH(os.DT_INICIO), YEAR(os.DT_INICIO),
                        sv.CD_SERVICO, sv.SERVICO, sv.RGB, sv.SN_TI";

    $result_oco = mysqli_query($conn ,$consulta_oco);

    $row_oco = mysqli_fetch_array($result_oco);

?>