<?php
$servidor = "portal_kpi.mysql.dbaas.com.br";
$usuario = "portal_kpi";
$senha = "kpisc@123";
$dbname = "portal_kpi";

//$servidor = "localhost";
//$usuario = "root";
//$senha = "";
//$dbname = "controle_ocorrenca";

//Criar a conexao
$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);
?>