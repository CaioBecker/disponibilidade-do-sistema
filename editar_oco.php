<?php
    include 'cabecalho.php';
    $id  = filter_input(INPUT_GET, 'cd_oco', FILTER_SANITIZE_STRING);
    echo $id;
    include 'sql_edit_oco.php';
    //echo $_SESSION['CD_USUARIO'];
    $dt_inicio = date('d/m/Y H:i:s', strtotime($row_oco_edit['dt_inicio']));
    @$dt_fim = date('d/m/Y H:i:s', strtotime($row_oco_edit['dt_fim']));
    //$_SESSION['usu'] = $id;
    //echo $dt_inicio;
    
?>

<h11><i class="fas fa-user"></i> Editar ocorrência</h11>
<h27> <a href="ocorrencias.php" style="color: #444444; text-decoration: none;"> <i class="fa fa-reply" aria-hidden="true"></i> Voltar </a> </h27> 

</br>
<div class="row">
    <div class="col-md-2">
    </br>
        Codigo da ocorrencia:
        <input class="form-control" type="text" id="cd_usuh" name="cd_usuh" value="<?php echo $id?>" disabled>
    </div>
    <div class="col-md-2">
    </br>
        Usuario responsavel:
        <input class="form-control" type="text" id="cd_usuh" name="cd_usuh" value="<?php echo $row_oco_edit['cd_usuario'];?>" disabled>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
    </br>
        Descrição da ocorrencia:
        <textarea rows="5" cols="50" class="form-control" value="<?php echo $row_oco_edit['ds_ocorrencia']?>" id="ds_oco" name="ds_oco" disabled></textarea>

    </div>
    <div class="col-md-3">
    </br>
        Descrição detalhada:
        <input class="form-control" type="text" id="setor_usu" name="setor_usu" value="<?php echo $row_oco_edit['ds_detalhada']?>" disabled>
    </div>
    
</div>
</br>
<div class="row">
    <div class="col-md-3">
        Data inicio:
        <input class="form-control" type="text" value="<?php echo $dt_inicio; ?>" id="dt_inicio" name="dt_inicio" disabled>
    </div>
    <div class="col-md-3">
        Data fim:
        <input class="form-control" type="text" placeholder="<?php if($dt_fim == '01/01/1970 01:00:00'){ echo "não foi encerrado ainda";
                                                            }else{echo $dt_fim; }
                                                        ?>" id="dt_fim" name="dt_fim" >
    </div>

</div>
<div class="row-md">
    <div class="col-md-2">
            </br>
            <h27> <a href="ocorrencias.php" style="color: #444444; text-decoration: none;"> <i class="fa fa-reply" aria-hidden="true"></i> Voltar </a> </h27> 
    </div>
</div>



<?php
    include 'rodape.php';
?>