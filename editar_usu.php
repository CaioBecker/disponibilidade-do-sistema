<?php
session_start();
    include 'cabecalho.php';
    $id  = filter_input(INPUT_GET, 'cd_usuario', FILTER_SANITIZE_STRING);
    
    include 'sql_editar_usu.php';
    //echo $_SESSION['CD_USUARIO'];
    $ativo = $row_usuario_edit['sn_ativo'];
    $adm = $row_usuario_edit['adm'];
   
    $_SESSION['usu_ex'] = $id;

       //echo $adm;
    
?>

<h11><i class="fas fa-user"></i> Editar Usuario</h11>
<h27> <a href="usuarios.php" style="color: #444444; text-decoration: none;"> <i class="fa fa-reply" aria-hidden="true"></i> Voltar </a> </h27> 

</br>
<form method="post" action="prc_usuarios.php">
<div class="row">
    <div class="col-md-2">
    </br>
        Usuario:
        <input class="form-control" type="text" id="cd_usuh" name="cd_usuh" value="<?php echo $row_usuario_edit['cd_usuario']?>" disabled>
        <input class="form-control" type="hidden" id="cd_usu" name="cd_usu" value="<?php echo $row_usuario_edit['cd_usuario']?>">
    </div>
    <div class="col-md-4">
    </br>
        Nome do Usuario:
        <input class="form-control"  type="text" id="nm_usu" name="nm_usu" value="<?php echo $row_usuario_edit['nm_usuario']?>">
    </div>
    <div class="col-md-3">
    </br>
        Setor:
        <input class="form-control" type="text" id="setor_usu" name="setor_usu" value="<?php echo $row_usuario_edit['setor']?>">
    </div>
    <div class="col-md-2">
    </br>
 
        Tipo usuario:
      
        <select class="form-control" name="tp_usu" id="tp_usu">
        <?php
        if(isset($row_usuario_edit['adm'])){
                //EXIBA ELE
                if($adm == 'S'){
                echo "<option value='S'>Administrador</option>";
                echo "<option value='N'>Comum</option>";
                }else{
                    echo  '<option value="'. $row_usuario_edit['adm'] . '">Comum</option>';
                    echo "<option value='S'>Administrador</option>";
                }
            } else {
                                
                //SENAO SOLICITA QUE SE SELECIONE UM VALOR
                echo "<option value=''>SELECIONE UM VALOR</option>";
            }
            
        
        ?>
        </select>
    
    </div>
</div>
<div class="row-md">
    <div class="col-md-2 ">
        </br>
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Salvar</button> 
    </div>
</form>

<?php
    include 'rodape.php';
?>