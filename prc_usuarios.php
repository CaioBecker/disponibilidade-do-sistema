<?php
session_start();
include 'conexao.php';

echo 'senha normal: </br>' . $_POST['senha_e'];
$var_senha = base64_encode($_POST['senha_e']);
$var_cd_usu = $_POST['cd_usu_e'];
$var_nm_usu = $_POST['nm_usu_e'];
$var_setor  = $_POST['setor_usu_e'];
$var_adm    = $_POST['tp_usu_e'];

echo '</br> senha : </br>' . $var_senha;
echo '</br> cd usu: </br>' . $var_cd_usu;
echo '</br> nm usu: </br>' . $var_nm_usu;
echo '</br> setor: </br>' . $var_setor;
echo '</br> adm: </br>' . $var_adm;


$result_usu = "UPDATE usuarios SET 
                        nm_usuario='$var_nm_usu',
                        senha = '$var_senha',
                        setor='$var_setor',
                        adm=UPPER('$var_adm') WHERE cd_usuario = '$var_cd_usu'";
                        echo "</br>".$result_usu;
$updade_usu = mysqli_query($conn,$result_usu);

if(!$updade_usu){
    $erro = mysqli_error($updade_usu);	
    $_SESSION['msgerro'] = 'Erro ao atualizar o usuario! ';
    //header('location: usuarios.php');
    return 0;
}else{
    $_SESSION['msg'] = 'Usuario ' . $var_cd_usu . ' editado com sucesso!';
    //header('location: usuarios.php'); 
    return 0;
}
?>