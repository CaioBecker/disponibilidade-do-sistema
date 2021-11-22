<?php

include 'conexao.php';


//echo $data_ant. "</br>";
//echo $count_mes;
//echo $ano;
if(@$_SESSION['cd_usu'] != ''){
  if($count_mes < 10){
      if($count_dias < 10){
          $consulta_dia = "SELECT os.*, serv.servico
          FROM ocorrencias_sistema os
          INNER JOIN servicos serv
            ON serv.cd_servico = os.cd_servico where dt_inicio like '%$ano-0$count_mes-0$count_dias%' and sn_ti = 'S'";
          $consulta_dia_QTD = "SELECT COUNT(*) as QTD, serv.servico
          FROM ocorrencias_sistema os
          INNER JOIN servicos serv
            ON serv.cd_servico = os.cd_servico where dt_inicio like '%$ano-0$count_mes-0$count_dias%' and sn_ti = 'S'";
      }else{
          $consulta_dia = "SELECT os.*, serv.servico
          FROM ocorrencias_sistema os
          INNER JOIN servicos serv
            ON serv.cd_servico = os.cd_servico where dt_inicio like '%$ano-0$count_mes-$count_dias%' and sn_ti = 'S'";
          $consulta_dia_QTD = "SELECT COUNT(*) as QTD, serv.servico
          FROM ocorrencias_sistema os
          INNER JOIN servicos serv
            ON serv.cd_servico = os.cd_servico where dt_inicio like '%$ano-0$count_mes-$count_dias%' and sn_ti = 'S'";
      }
  }else{
      if($count_dias < 10){
          $consulta_dia = "SELECT os.*, serv.servico
          FROM ocorrencias_sistema os
          INNER JOIN servicos serv
            ON serv.cd_servico = os.cd_servico where dt_inicio like '%$ano-$count_mes-0$count_dias%' and sn_ti = 'S'";
          $consulta_dia_QTD = "SELECT COUNT(*) as QTD, serv.servico
          FROM ocorrencias_sistema os
          INNER JOIN servicos serv
            ON serv.cd_servico = os.cd_servico where dt_inicio like '%$ano-$count_mes-0$count_dias%' and sn_ti = 'S'";
      }else{
          $consulta_dia = "SELECT os.*, serv.servico
          FROM ocorrencias_sistema os
          INNER JOIN servicos serv
            ON serv.cd_servico = os.cd_servico where dt_inicio like '%$ano-$count_mes-$count_dias%' and sn_ti = 'S'";
          $consulta_dia_QTD = "SELECT COUNT(*) as QTD, serv.servico
          FROM ocorrencias_sistema os
          INNER JOIN servicos serv
            ON serv.cd_servico = os.cd_servico where dt_inicio like '%$ano-$count_mes-$count_dias%' and sn_ti = 'S'";
      }
  }
}else{
  if($count_mes < 10){
    if($count_dias < 10){
        $consulta_dia = "SELECT os.*, serv.servico
        FROM ocorrencias_sistema os
        INNER JOIN servicos serv
          ON serv.cd_servico = os.cd_servico where dt_inicio like '%$ano-0$count_mes-0$count_dias%' and sn_ti = 'N'";
        $consulta_dia_QTD = "SELECT COUNT(*) as QTD, serv.servico
        FROM ocorrencias_sistema os
        INNER JOIN servicos serv
          ON serv.cd_servico = os.cd_servico where dt_inicio like '%$ano-0$count_mes-0$count_dias%' and sn_ti = 'N'";
    }else{
        $consulta_dia = "SELECT os.*, serv.servico
        FROM ocorrencias_sistema os
        INNER JOIN servicos serv
          ON serv.cd_servico = os.cd_servico where dt_inicio like '%$ano-0$count_mes-$count_dias%' and serv.sn_ti = 'N'";
        $consulta_dia_QTD = "SELECT COUNT(*) as QTD, serv.servico
        FROM ocorrencias_sistema os
        INNER JOIN servicos serv
          ON serv.cd_servico = os.cd_servico where dt_inicio like '%$ano-0$count_mes-$count_dias%' and serv.sn_ti = 'N'";
    }
  }else{
      if($count_dias < 10){
          $consulta_dia = "SELECT os.*, serv.servico
          FROM ocorrencias_sistema os
          INNER JOIN servicos serv
            ON serv.cd_servico = os.cd_servico where dt_inicio like '%$ano-$count_mes-0$count_dias%' and sn_ti = 'N'";
          $consulta_dia_QTD = "SELECT COUNT(*) as QTD, serv.servico
          FROM ocorrencias_sistema os
          INNER JOIN servicos serv
            ON serv.cd_servico = os.cd_servico where dt_inicio like '%$ano-$count_mes-0$count_dias%' and sn_ti = 'N'";
      }else{
          $consulta_dia = "SELECT os.*, serv.servico
          FROM ocorrencias_sistema os
          INNER JOIN servicos serv
            ON serv.cd_servico = os.cd_servico where dt_inicio like '%$ano-$count_mes-$count_dias%' and sn_ti = 'N'";
          $consulta_dia_QTD = "SELECT COUNT(*) as QTD, serv.servico
          FROM ocorrencias_sistema os
          INNER JOIN servicos serv
            ON serv.cd_servico = os.cd_servico where dt_inicio like  '%$ano-$count_mes-$count_dias%' and sn_ti = 'N'";
      }

  }
}
$result_dia = mysqli_query($conn,$consulta_dia);
$result_dia_QTD = mysqli_query($conn,$consulta_dia_QTD);
@$row_QTD_dia = mysqli_fetch_array(@$result_dia_QTD);


$result_dia_aux = mysqli_query($conn,$consulta_dia);






?>