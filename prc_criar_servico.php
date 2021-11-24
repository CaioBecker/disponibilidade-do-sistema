<?php
session_start();
include 'conexao.php';

//ACESSO RESTRITO
include 'acesso_restrito_adm.php';


$var_tp_serv = $_POST['tp_serv_c'];
$var_cd_usu = $_SESSION['cd_usu'];
$var_cor = $_POST['cor'];

echo '</br> tp serv: </br>' . $var_tp_serv;

@$result_serv_exis="SELECT COUNT(*) AS QTD FROM servicos WHERE servico = '$var_tp_serv'";
echo $result_serv_exis;

@$serv_exis = mysqli_query($conn,$result_serv_exis);
@$row_serv_exis = mysqli_fetch_array($serv_exis);

echo '</br> qtd: </br>'. @$row_serv_exis['QTD'];
if (@$row_serv_exis['QTD'] == 0){
    $result_serv = "INSERT INTO servicos (servico,  rgb, cd_usuario)
                                VALUES
                            ('$var_tp_serv',  '$var_cor', '$var_cd_usu')";
                            echo "</br>".$result_serv;
    $insert_serv = mysqli_query($conn,$result_serv);

    if(!$insert_serv){
        $erro = mysqli_error($insert_serv);	
        $_SESSION['msgerro'] = 'Erro ao cadastrar o serviço! ' . htmlentities($erro['message']);
        header('servicos.php');
        return 0;
    }else{
        $_SESSION['msg'] = 'Serviço ' . $var_tp_serv . ' cadastrado com sucesso!';
        header('location: servicos.php'); 
        return 0;
    }
}else{
    $_SESSION['msgerro'] = 'Serviço ja existe! ' ;
    header('location: servicos.php');
    return 0;
}
?>