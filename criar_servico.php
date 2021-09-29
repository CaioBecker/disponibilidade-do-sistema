<?php
    include 'cabecalho.php';
    $id  = filter_input(INPUT_GET, 'cd_usuario', FILTER_SANITIZE_STRING);
    
    //echo $adm;
    
?>

<h11><i class="fas fa-user"></i> Cadastrar serviço</h11>
<h27> <a href="servicos.php" style="color: #444444; text-decoration: none;"> <i class="fa fa-reply" aria-hidden="true"></i> Voltar </a> </h27> 

</br>
<form method="post" action="prc_criar_servico.php">
<div class="row">
    <div class="col-md-2">
    </br>
        Tipo de serviço:
        <input class="form-control" type="text" id="cd_usu" name="cd_usu" required>
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

