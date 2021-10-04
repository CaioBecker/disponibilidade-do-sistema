<?php

include 'conexao.php';



$consulta_oco_viu = "SELECT * FROM ocorrencias_sistema WHERE cd_ocorrencia = '$id'";
//echo "</br> consulta viu oco: </br> " . $consulta_oco_viu;
$result_oco_viu = mysqli_query($conn ,$consulta_oco_viu);
$row_oco_viu = mysqli_fetch_array($result_oco_viu);


?>