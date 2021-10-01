<?php
    session_start();
    include 'conexao.php';

    $cd_servico = filter_input(INPUT_GET,'id');
    echo '</br> cd_servico: </br>'. $cd_servico;
    $result_excluir_serv = "DELETE FROM servicos WHERE cd_servico = '$cd_servico'";
    echo '</br>excluir usu: </br>'. $result_excluir_serv;
    $excluir_serv = mysqli_query($conn, $result_excluir_serv);

    if(!$result_excluir_serv){
        $erro = mysqli_error($result_excluir_serv);	
        $_SESSION['servicos'] = 'Erro ao excluido o serviço! ' . htmlentities($erro['message']);
        header('usuarios.php');
        return 0;
    }else{
        $_SESSION['msg'] = 'Servico ' . $cd_serv . ' excluido com sucesso!';
        header('location: servicos.php'); 
        return 0;
    }
    

?>