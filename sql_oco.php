<?php

include 'conexao.php';


//echo $data_ant. "</br>";
$consulta_oco = "SELECT * FROM ocorrencias_sistema WHERE dt_inicio like '%$data_while%'";
//echo '</br> consulta: </br>' . $consulta_oco;
$result_oco = mysqli_query($conn, $consulta_oco);

$_SESSION['dt_oco'] = $row_oco = mysqli_fetch_array($result_oco);

//echo $result_oco;

?>