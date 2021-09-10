<?php
session_start();
include 'conexao.php';


$var_cd_usu = $_POST['cd_usu'];
$var_nm_usu = $_POST['nm_usu'];
$var_setor  = $_POST['setor_usu'];
$var_adm    = $_POST['tp_usu'];

echo '</br> cd usu: </br>' . $var_cd_usu;
echo '</br> nm usu: </br>' . $var_nm_usu;
echo '</br> setor: </br>' . $var_setor;
echo '</br> adm: </br>' . $var_adm;


$result_usu = "UPDATE usuarios SET 
                        nm_usuario='$var_nm_usu',
                        setor='$var_setor',
                        adm=UPPER('$var_adm') WHERE cd_usuario = '$var_cd_usu'";
                        echo "</br>".$result_usu;
$updade_usu = mysqli_query($conn,$result_usu);

if(!$updade_usu){
    $erro = mysqli_error($updade_usu);	
    $_SESSION['msgerro'] = 'Erro ao atualizar o usuario! ' . htmlentities($erro['message']);
    header('usuarios.php');
    return 0;
}else{
    $_SESSION['msg'] = 'Usuario ' . $var_cd_usu . ' editado com sucesso!';
    header('location: usuarios.php'); 
    return 0;
}
?>