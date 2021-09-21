<?php

include 'conexao.php';


//echo $data_ant. "</br>";
$consulta_hj = "SELECT * FROM ocorrencias_sistema WHERE dt_inicio < '$data_hj' and dt_fim = '1970-01-01 01:00:00'";
//echo '</br> consulta: </br>' . $consulta_hj;
$result_hj = mysqli_query($conn, $consulta_hj);



//echo $result_oco;

?>