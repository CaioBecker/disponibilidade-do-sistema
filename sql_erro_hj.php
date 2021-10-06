<?php

include 'conexao.php';


//echo $data_ant. "</br>";
$consulta_hj = "SELECT os.*, serv.servico
FROM ocorrencias_sistema os
INNER JOIN servicos serv
  ON serv.cd_servico = os.cd_servico WHERE dt_fim is null";

//echo '</br> consulta: </br>' . $consulta_hj;
$result_hj = mysqli_query($conn, $consulta_hj);



//echo $result_oco;

?>