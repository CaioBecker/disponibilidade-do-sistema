<?php

include 'conexao.php';


//echo $data_ant. "</br>";
//echo $count_mes;
//echo $ano;
if(@$_SESSION['cd_usu'] != ''){
     if($count_mes < 10){
          $consulta_mes = "SELECT COUNT(*) as QTD, serv.servico
          FROM ocorrencias_sistema os
          INNER JOIN servicos serv
            ON serv.cd_servico = os.cd_servico where dt_inicio like '%$ano-0$count_mes%' and sn_ti = 'S'";
          
     }else{
          $consulta_mes = "SELECT COUNT(*) as QTD, serv.servico
          FROM ocorrencias_sistema os
          INNER JOIN servicos serv
            ON serv.cd_servico = os.cd_servico where dt_inicio like '%$ano-$count_mes%' and sn_ti = 'S'";
     }
}else{
     if($count_mes < 10){
          $consulta_mes = "SELECT COUNT(*) as QTD, serv.servico
          FROM ocorrencias_sistema os
          INNER JOIN servicos serv
            ON serv.cd_servico = os.cd_servico where dt_inicio like '%$ano-0$count_mes%' and sn_ti = 'N'";

     }else{
          $consulta_mes = "SELECT COUNT(*) as QTD, serv.servico
          FROM ocorrencias_sistema os
          INNER JOIN servicos serv
            ON serv.cd_servico = os.cd_servico where dt_inicio like '%$ano-$count_mes%' and sn_ti = 'N'";
     }  
}
$result_mes = mysqli_query($conn,$consulta_mes);
@$row_mes =mysqli_fetch_array($result_mes);
?>