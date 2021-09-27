<?php

include 'conexao.php';


//echo $data_ant. "</br>";
//echo $count_mes;
//echo $ano;
if($count_mes < 10){
    if($count_dias < 10){
        $consulta_dia = "SELECT * FROM ocorrencias_sistema where dt_inicio like '%$ano-0$count_mes-0$count_dias%'";

    }else{
        $consulta_dia = "SELECT * FROM ocorrencias_sistema where dt_inicio like '%$ano-0$count_mes-$count_dias%'";
    }
}else{
    if($count_dias < 10){
        $consulta_dia = "SELECT * FROM ocorrencias_sistema where dt_inicio like '%$ano-$count_mes-0$count_dias%'";

    }else{
        $consulta_dia = "SELECT * FROM ocorrencias_sistema where dt_inicio like '%$ano-$count_mes-$count_dias%'";
    }

}
$result_dia = mysqli_query($conn,$consulta_dia);
?>