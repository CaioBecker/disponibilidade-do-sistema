<?php
include 'conexao.php';
session_start();
$ds_oco = $_POST['ds_oco'];
$ds_detalha = $_POST['ds_detalha'];
$dt_inicio = date('Y-m-d H:i:s', strtotime($_POST['dt_inicio']));
$dt_fim =  date('Y-m-d H:i:s', strtotime($_POST['dt_fim']));
$cd_usu = $_SESSION['cd_usu'];
echo "</br> ds oco: </br>" . $ds_oco;
echo "</br> ds detalha: </br>" . $ds_detalha;
echo "</br> dt_inicio: </br>" . $dt_inicio;
echo "</br> dt_fim: </br>" . $dt_fim;
echo "</br> cd_usu: </br>" . $cd_usu;

$result_insert_oco="INSERT INTO `ocorrencias_sistema`
(`cd_ocorrencia`, `ds_ocorrencia`, `ds_detalhada`, `dt_inicio`, `dt_fim`, `cd_usuario`) 
VALUES ('','$ds_oco','$ds_detalha','$dt_inicio','$dt_fim','$cd_usu')";

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