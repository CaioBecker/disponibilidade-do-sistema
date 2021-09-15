<?php
session_start();
include 'conexao.php';



$var_cd_oco = $_POST['cd_oco'];
$var_ds_oco = $_POST['ds_oco'];
$var_ds_deta = $_POST['ds_deta'];
$var_dt_fim = $_POST['dt_fim'];

echo '</br> cd oco: </br>' . $var_cd_oco;
echo '</br> ds oco: </br>' . $var_ds_oco;
echo '</br> ds deta: </br>' . $var_ds_deta;
echo '</br> dt fim: </br>' . $var_dt_fim;


$result_usu = "UPDATE usuarios SET 
                        nm_usuario='$var_nm_usu',
                        setor='$var_setor',
                        adm=UPPER('$var_adm') WHERE cd_usuario = '$var_cd_usu'";
                        echo "</br>".$result_usu;
$updade_usu = mysqli_query($conn,$result_usu);

if(!$updade_usu){
    $erro = mysqli_error($updade_usu);	
    $_SESSION['msgerro'] = 'Erro ao atualizar o usuario! ' . htmlentities($erro['message']);
    //header('usuarios.php');
    return 0;
}else{
    $_SESSION['msg'] = 'Usuario ' . $var_cd_usu . ' editado com sucesso!';
    //header('location: usuarios.php'); 
    return 0;
}
?>