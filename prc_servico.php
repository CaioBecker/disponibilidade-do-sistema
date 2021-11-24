<?php
session_start();
include 'conexao.php';


$var_cd = $_POST['cd_servico'];
$var_tp_serv = $_POST['tp_serv_c'];
$var_cor  = $_POST['cor'];

echo '</br> codigo : </br>' . $var_cd;
echo '</br> tipo de servico: </br>' . $var_tp_serv;
echo '</br> rgb: </br>' . $var_cor;



$result_serv = "UPDATE servicos SET 
                        cd_servico ='$var_cd',
                        servico = '$var_tp_serv',
                        rgb='$var_cor'
                        WHERE cd_servico = '$var_cd'";
                        echo "</br>".$result_serv;
$updade_serv = mysqli_query($conn,$result_serv);

if(!$updade_serv){
    $erro = mysqli_error($updade_serv);	
    $_SESSION['msgerro'] = 'Erro ao atualizar o usuario! ';
    header('location: servicos.php');
    return 0;
}else{
    $_SESSION['msg'] = 'Servico ' . $var_cd . ' editado com sucesso!';
    header('location: servicos.php'); 
    return 0;
}
?>