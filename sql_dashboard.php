<?php
    include 'conexao.php';
    $v_valor = filter_input(INPUT_GET,'ano_filtro');
    if(isset($v_valor)){
        $valor = $v_valor;
    }else{
        $valor = 'NULL';
    }

    $consulta_oco = "SELECT DISTINCT 
                        YEAR(os.DT_INICIO) AS ANO,
                        sv.CD_SERVICO, sv.SERVICO, sv.RGB, sv.SN_TI
                        FROM servicos sv
                        LEFT JOIN ocorrencias_sistema os
                        ON os.CD_SERVICO = sv.CD_SERVICO
                        WHERE YEAR(os.DT_INICIO) = IFNULL(" . $valor . ", YEAR(SYSDATE()))
                        GROUP BY MONTH(os.DT_INICIO), YEAR(os.DT_INICIO),
                        sv.CD_SERVICO, sv.SERVICO, sv.RGB, sv.SN_TI";

    $result_oco = mysqli_query($conn ,$consulta_oco);

    $row_oco = mysqli_fetch_array($result_oco);

?>