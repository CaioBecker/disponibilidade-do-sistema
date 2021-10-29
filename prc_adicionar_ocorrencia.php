<?php
include 'conexao.php';
session_start();
$ds_titu = $_POST['titulo'];
$serv = $_POST['servico'];
$tp = $_POST['tipo'];
$ds_oco = $_POST['ds_oco'];
$dt_inicio = date('Y-m-d H:i:s', strtotime($_POST['dt_inicio']));

$cd_usu = $_SESSION['cd_usu'];
echo "</br> titulo: </br>" . $ds_titu;
echo "</br> serviço: </br>" . $serv;
echo "</br> tipo: </br>" . $tp;
echo "</br> ds oco: </br>" . $ds_oco;
echo "</br> dt_inicio: </br>" . $dt_inicio;

echo "</br> cd_usu: </br>" . $cd_usu;

$result_insert_oco="INSERT INTO `ocorrencias_sistema`
(`cd_ocorrencia`,`titulo`, `cd_servico`,`ds_ocorrencia`, `dt_inicio`, `cd_usuario`, `tp_ocorrencia`) 
VALUES ('','$ds_titu','$serv', '$ds_oco','$dt_inicio','$cd_usu','$tp')";

echo "</br> insert: </br>" . $result_insert_oco;

$insert_oco = mysqli_query($conn, $result_insert_oco);

if(!$insert_oco){
    $erro = oci_error($insert_oco) . oci_error($insert_oco) ;																							
          $_SESSION['msgerro'] = htmlentities($erro['message']);
          //header('location: adicionar_ocorrencia.php'); 
          return 0;
}else{
    $_SESSION['msg'] = 'Ocorrência registrada com sucesso com sucesso!';
          header('location: ocorrencias.php'); 
          return 0;
}
?>