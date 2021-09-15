<?php
	session_start();
	
	unset(
		$_SESSION['cd_usu'],
		$_SESSION['adm']
	);
	
	$_SESSION['msgneutra'] = "Logout realizado com sucesso!";
	
	//redirecionar o usuario para a página de login
	header("Location: index.php");

?>