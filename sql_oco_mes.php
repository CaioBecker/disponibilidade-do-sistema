<?php

include 'conexao.php';


//echo $data_ant. "</br>";
//echo $count_mes;
//echo $ano;
if($count_mes < 10){
     $consulta_mes = "SELECT count(*) as QTD FROM ocorrencias_sistema where dt_inicio like '%$ano-0$count_mes%'";

}else{
     $consulta_mes = "SELECT count(*) as QTD FROM ocorrencias_sistema where dt_inicio like '%$ano-$count_mes%'";
}
$result_mes = mysqli_query($conn,$consulta_mes);
$row_mes =mysqli_fetch_array($result_mes);
?>