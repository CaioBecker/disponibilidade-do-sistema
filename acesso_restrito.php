<?php
@session_start();
// Se o usuário não está logado, manda para página de login.
if (!isset($_SESSION['cd_usu'])){
	
	unset(
		$_SESSION['cd_usu'],
		$_SESSION['nomeusuario'],
		$_SESSION['adm']
		
	);
	
	$_SESSION['loginErro'] = "Sessão expirada!";
	header("Location: index.php");
	
};
?>