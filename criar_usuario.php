<?php
    include 'cabecalho.php';
    $id  = filter_input(INPUT_GET, 'cd_usuario', FILTER_SANITIZE_STRING);
    
    //echo $adm;
    
?>

<h11><i class="fas fa-user"></i> Editar Usuario</h11>
<h27> <a href="usuarios.php" style="color: #444444; text-decoration: none;"> <i class="fa fa-reply" aria-hidden="true"></i> Voltar </a> </h27> 

</br>
<form method="post" action="prc_criar_usuarios.php">
<div class="row">
    <div class="col-md-2">
    </br>
        Usuario:
        <input class="form-control" type="text" id="cd_usu" name="cd_usu" required>
    </div>
    <div class="col-md-4">
    </br>
        Nome do Usuario:
        <input class="form-control"  type="text" id="nm_usu" name="nm_usu" required>
    </div>
    <div class="col-md-3">
    </br>
        Setor:
        <input class="form-control" type="text" id="setor_usu" name="setor_usu" required>
    </div>
    <div class="col-md-2">
    </br>
 
        Tipo usuario:
      
        <select class="form-control" name="tp_usu" id="tp_usu" onblur="">
        <option value='S'>Administrador</option>
        <option value='N'>Comum</option>
        </select>
    
    </div>
</div>
<div class="row">
    <div class="col-md-12 input-group">
        Senha:
    </div>
    <div class="col-md-3 input-group">
        <input class="input-group form-control " type="password" id="senha" name="senha" required>
        <button class="btn btn-primary" type="button" onclick="mostrarSenha()"><i class="fa fa-eye" aria-hidden="true"></i></button> <span class="espaco">
    </div>
</div>
<div class="row-md">
    <div class="col-md-2">
            </br>
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Salvar</button> 
    </div>
</div>
</form>


<?php
    include 'rodape.php';
?>

<script>



 
			function mostrarSenha(){
				var tipo = document.getElementById("senha");
				if(tipo.type == "password"){
					tipo.type = "text";
				}else{
					tipo.type = "password";
				}
			}

</script>