<?php

include 'conexao.php';



$consulta_oco = "SELECT * FROM ocorrencias_sistema WHERE cd_ocorrencia = '$id'";
//echo $consulta_oco;
$result_oco = mysqli_query($conn ,$consulta_oco);
$row_oco_edit = mysqli_fetch_array($result_oco);


?>