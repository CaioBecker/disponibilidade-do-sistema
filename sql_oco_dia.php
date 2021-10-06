<?php

include 'conexao.php';


//echo $data_ant. "</br>";
//echo $count_mes;
//echo $ano;
if($count_mes < 10){
    if($count_dias < 10){
        $consulta_dia = "SELECT os.*, serv.servico
        FROM ocorrencias_sistema os
        INNER JOIN servicos serv
          ON serv.cd_servico = os.cd_servico where dt_inicio like '%$ano-0$count_mes-0$count_dias%'";
        $consulta_dia_qtd = "SELECT COUNT(*) AS QTD FROM ocorrencias_sistema where dt_inicio like '%$ano-0$count_mes-0$count_dias%'";
    }else{
        $consulta_dia = "SELECT os.*, serv.servico
        FROM ocorrencias_sistema os
        INNER JOIN servicos serv
          ON serv.cd_servico = os.cd_servico where dt_inicio like '%$ano-0$count_mes-$count_dias%'";
        $consulta_dia_qtd = "SELECT COUNT(*) AS QTD FROM ocorrencias_sistema where dt_inicio like '%$ano-0$count_mes-$count_dias%'";
    }
}else{
    if($count_dias < 10){
        $consulta_dia = "SELECT os.*, serv.servico
        FROM ocorrencias_sistema os
        INNER JOIN servicos serv
          ON serv.cd_servico = os.cd_servico where dt_inicio like '%$ano-$count_mes-0$count_dias%'";
        $consulta_dia_qtd = "SELECT COUNT(*) AS QTD FROM ocorrencias_sistema where dt_inicio like '%$ano-$count_mes-0$count_dias%'";
    }else{
        $consulta_dia = "SELECT os.*, serv.servico
        FROM ocorrencias_sistema os
        INNER JOIN servicos serv
          ON serv.cd_servico = os.cd_servico where dt_inicio like '%$ano-$count_mes-$count_dias%'";
        $consulta_dia_qtd = "SELECT COUNT(*) AS QTD FROM ocorrencias_sistema where dt_inicio like '%$ano-$count_mes-$count_dias%'";
    }

}

$result_dia = mysqli_query($conn,$consulta_dia);
$result_dia_qtd = mysqli_query($conn,$consulta_dia_qtd);
@$row_qtd_dia = mysqli_fetch_array(@$result_dia_qtd);


$result_dia_aux = mysqli_query($conn,$consulta_dia);






?>