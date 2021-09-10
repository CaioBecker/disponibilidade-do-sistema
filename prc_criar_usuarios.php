<?php
session_start();
include 'conexao.php';


$var_cd_usu = $_POST['cd_usu'];
$var_nm_usu = $_POST['nm_usu'];
$var_setor  = $_POST['setor_usu'];
$var_adm    = $_POST['tp_usu'];
$var_senha  = $_POST['senha'];

echo '</br> cd usu: </br>' . $var_cd_usu;
echo '</br> nm usu: </br>' . $var_nm_usu;
echo '</br> setor: </br>' . $var_setor;
echo '</br> adm: </br>' . $var_adm;

$result_usu_exis="SELECT COUNT(*) AS QTD FROM usuarios WHERE CD_USUARIO = '$var_cd_usu'";
echo $result_usu_exis;
$usu_exis = mysqli_query($conn,$result_usu_exis);
$row_usu_exis = mysqli_fetch_array($usu_exis);
echo '</br> qtd: </br>'. $row_usu_exis['QTD'];
if ($row_usu_exis['QTD'] == 0){
    $result_usu = "INSERT INTO usuarios (CD_USUARIO, NM_USUARIO, SETOR, CD_SENHA, SN_ATIVO, ADM)
                                VALUES
                            ('$var_cd_usu',
                            '$var_nm_usu',
                            '$var_setor',
                            '$var_senha',
                            'S',
                            '$var_adm')";
                            echo "</br>".$result_usu;
    $insert_usu = mysqli_query($conn,$result_usu);

    if(!$insert_usu){
        $erro = mysqli_error($insert_usu);	
        $_SESSION['msgerro'] = 'Erro ao criar o usuario! ' . htmlentities($erro['message']);
        header('usuarios.php');
        return 0;
    }else{
        $_SESSION['msg'] = 'Usuario ' . $var_cd_usu . ' criado com sucesso!';
        header('location: usuarios.php'); 
        return 0;
    }
}else{
    $_SESSION['msgerro'] = 'Usuario ja existe! ' ;
    header('location: usuarios.php');
    return 0;
}
?>