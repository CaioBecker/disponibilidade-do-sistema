<?php 
//require_once('acesso_restrito.php');

session_start();
include_once("conexao.php");

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);
$sn_ativo = filter_input(INPUT_GET, 'sn_ativo', FILTER_SANITIZE_STRING);
$item = filter_input(INPUT_GET, 'item', FILTER_SANITIZE_NUMBER_INT);

echo $id . "</br></br>";
echo $sn_ativo . "</br></br>";
echo $item . "</br></br>";

	
    if($sn_ativo == 'N' or $sn_ativo == 'S'){	
        if(!empty($id)){
            $result = "UPDATE servicos 
                        SET sn_ti = '$sn_ativo'
                        WHERE cd_servico ='$id'";
                        echo "</br> result: </br>". $result;
            $resultado = mysqli_query($conn, $result);
            echo $resultado;
                if(!$resultado){
                    $_SESSION['msg'] = "<p style='color:red;'>Erro, o Serviço não foi alterado!</p>";
                    header("Location: servicos.php");
                }else{
                    
                    $_SESSION['msg'] = "<p style='color:green;'>Serviço alterado com sucesso!</p>";
                    header("Location: servicos.php");
                }
        }else{	
            $_SESSION['msg'] = "<p style='color:red;'>Necessário selecionar um serviço!</p>";
            header("Location: servicos.php");    
        }
    }




?>