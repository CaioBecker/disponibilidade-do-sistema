<?php
    session_start();
    include 'conexao.php';

    $cd_usu = filter_input(INPUT_GET,'id');
    echo '</br> cd_usu: </br>'. $cd_usu;
    $result_excluir_usu = "DELETE FROM usuarios WHERE cd_usuario = '$cd_usu'";
    echo '</br>excluir usu: </br>'. $result_excluir_usu;
    $excluir_usu = mysqli_query($conn, $result_excluir_usu);

    if(!$result_excluir_usu){
        $erro = mysqli_error($result_excluir_usu);	
        $_SESSION['msgerro'] = 'Erro ao excluido o usuario! ' . htmlentities($erro['message']);
        header('usuarios.php');
        return 0;
    }else{
        $_SESSION['msg'] = 'Usuario ' . $cd_usu . ' excluido com sucesso!';
        header('location: usuarios.php'); 
        return 0;
    }
    

?>