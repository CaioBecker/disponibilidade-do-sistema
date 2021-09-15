<?php

session_start();
include 'cabecalho.php';
include 'conexao.php';
include 'sql_home.php';

$_SESSION['adm'] = $row_usuario_home['adm'];
//echo '</br> cd_usu: </br>' . $row_usuario['adm'];
?>

<h11><i class="fa fa-home" aria-hidden="true"></i> Home</h11>
        
        <div class="div_br"> </div>
            
        <!--<h12>Bem vindo Heitor Scalabrini Sampaio</h12>-->
    
        <div class="div_br"> </div>
            
        <!--BOTOES-->
        
        <a href="usuarios.php" class="botao_home" type="submit"><h21><i class="fas fa-users"></i> Usuarios </h21></a>
		<span class="espaco_pequeno"></span>
        <a href="ocorrencias.php" class="botao_home" type="submit"><h21><i class="fas fa-book"></i> Ocorrências </h21></a>
		<span class="espaco_pequeno"></span>
<?php
include 'rodape.php';
?>