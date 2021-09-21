<?php
session_start();
include 'conexao.php';



$var_cd_oco = $_POST['cd_oco'];
$var_ds_oco = $_POST['ds_oco'];
$var_ds_deta = $_POST['ds_deta'];
$var_dt_fim = date('Y-m-d H:i:s', strtotime($_POST['dt_fim']));

echo '</br> cd oco: </br>' . $var_cd_oco;
echo '</br> ds oco: </br>' . $var_ds_oco;
echo '</br> ds deta: </br>' . $var_ds_deta;
echo '</br> dt fim: </br>' . $var_dt_fim;

if ($var_dt_fim == ''){
    $result_oco = "UPDATE ocorrencias_sistema SET 
                    ds_ocorrencia = '$var_ds_oco', 
                    ds_detalhada = '$var_ds_deta' 
                    WHERE cd_ocorrencia = '$var_cd_oco'";
    echo '</br>' . $result_oco;
    $update_oco = mysqli_query($conn, $result_oco);
}else{
    $result_oco = "UPDATE ocorrencias_sistema SET 
                    ds_ocorrencia = '$var_ds_oco', 
                    ds_detalhada = '$var_ds_deta', 
                    dt_fim = '$var_dt_fim'
                    WHERE cd_ocorrencia = '$var_cd_oco'";
                    echo '</br>' . $result_oco;
    $update_oco = mysqli_query($conn, $result_oco);
}


if(!$update_oco){
    $erro = mysqli_error($update_oco);	
    $_SESSION['msgerro'] = 'Erro ao atualizar o usuario! ' . htmlentities($erro['message']);
    header('ocorrencias.php');
    return 0;
}else{
    $_SESSION['msg'] = 'Ocorrencia ' . $var_cd_oco . ' editada com sucesso!';
    header('location: ocorrencias.php'); 
    return 0;
}
?>