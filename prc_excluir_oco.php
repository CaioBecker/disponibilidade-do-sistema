<?php
    session_start();
    include 'conexao.php';

    //ACESSO RESTRITO
    include 'acesso_restrito_adm.php';

    $cd_oco = filter_input(INPUT_GET,'id');
    echo '</br> cd_ooc: </br>'. $cd_oco;
    $result_excluir_usu = "DELETE FROM ocorrencias_sistema WHERE cd_ocorrencia = '$cd_oco'";
    echo '</br>excluir usu: </br>'. $result_excluir_usu;
    $excluir_usu = mysqli_query($conn, $result_excluir_usu);

    if(!$result_excluir_usu){
        $erro = mysqli_error($result_excluir_usu);	
        $_SESSION['msgerro'] = 'Erro ao excluido o usuario! ' . htmlentities($erro['message']);
        header('ocorrencias.php');
        return 0;
    }else{
        $_SESSION['msg'] = 'Ocorrencia ' . $cd_oco . ' excluido com sucesso!';
        header('location: ocorrencias.php'); 
        return 0;
    }
    

?>