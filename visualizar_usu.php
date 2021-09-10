<?php
    include 'cabecalho.php';
    $id  = filter_input(INPUT_GET, 'cd_usuario', FILTER_SANITIZE_STRING);
    
    include 'sql_viu_usu.php';
    //echo $_SESSION['CD_USUARIO'];
    $ativo = $row_usuario_viu['sn_ativo'];
    $adm = $row_usuario_viu['adm'];
    $_SESSION['usu'] = $id;
    //echo $adm;
    
?>

<h11><i class="fas fa-user"></i> Editar Usuario</h11>
<h27> <a href="usuarios.php" style="color: #444444; text-decoration: none;"> <i class="fa fa-reply" aria-hidden="true"></i> Voltar </a> </h27> 

</br>
<div class="row">
    <div class="col-md-2">
    </br>
        Usuario:
        <input class="form-control" type="text" id="cd_usuh" name="cd_usuh" value="<?php echo $row_usuario_viu['cd_usuario']?>" disabled>
    </div>
    <div class="col-md-4">
    </br>
        Nome do Usuario:
        <input class="form-control"  type="text" id="nm_usu" name="nm_usu" value="<?php echo $row_usuario_viu['nm_usuario']?>" disabled>
    </div>
    <div class="col-md-3">
    </br>
        Setor:
        <input class="form-control" type="text" id="setor_usu" name="setor_usu" value="<?php echo $row_usuario_viu['setor']?>" disabled>
    </div>
    <div class="col-md-2">
    </br>
 
        Tipo usuario:
      
        <?php 
        if($adm == 'S'){
        ?>
            <input class="form-control" type="text" id="setor_usu" name="setor_usu" value="Administrador" disabled>
        <?php
        }else{
        ?>
            <input class="form-control" type="text" id="setor_usu" name="setor_usu" value="Comum" disabled>
        <?php
        }
        ?>
    </div>
</div>
<div class="row-md">
    <div class="col-md-2">
            </br>
            <h27> <a href="usuarios.php" style="color: #444444; text-decoration: none;"> <i class="fa fa-reply" aria-hidden="true"></i> Voltar </a> </h27> 
    </div>
</div>



<?php
    include 'rodape.php';
?>