<?php
session_start();
include 'conexao.php';

$var_cd_usu = '';
$var_nm_usu = '';
$var_setor  = '';
$var_adm    = '';
$var_senha  = '';

$var_cd_usu = $_POST['cd_usus'];
$var_nm_usu = $_POST['nm_usus'];
$var_setor  = $_POST['setor_usus'];
$var_adm    = $_POST['tp_usus'];
$var_senha  = $_POST['senhas'];

echo '</br> cd usu: </br>' . $var_cd_usu;
echo '</br> nm usu: </br>' . $var_nm_usu;
echo '</br> setor: </br>' . $var_setor;
echo '</br> adm: </br>' . $var_adm;

$result_usu_exis="SELECT COUNT(*) AS QTD FROM usuarios WHERE CD_USUARIO = '$var_cd_usu'";
echo $result_usu_exis;
$usu_exis = mysqli_query($conn,$result_usu_exis);
$row_usu_exis = mysqli_fetch_array($usu_exis);
echo '</br> qtd: </br>'. $row_usu_exis['QTD'];
if ($row_usu_exis['QTD'] == 0 && $var_cd_usu != ''){
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
    if($var_cd_usu == ''){
        $_SESSION['msgerro'] = 'Digite um valor ' ;
    }else{
        $_SESSION['msgerro'] = 'Usuario ja existe! ' ;
    }
    header('location: usuarios.php');
    return 0;
}
?>