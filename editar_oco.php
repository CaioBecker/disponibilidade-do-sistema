<?php
    include 'cabecalho.php';
    $id  = filter_input(INPUT_GET, 'cd_oco', FILTER_SANITIZE_STRING);
    //echo $id;
    include 'sql_edit_oco.php';
    //echo $_SESSION['CD_USUARIO'];
    $dt_inicio = date('d/m/Y H:i:s', strtotime($row_oco_edit['dt_inicio']));
    @$dt_fim = date('d/m/Y H:i:s', strtotime($row_oco_edit['dt_fim']));
    $dt_inicio_j = date('Y-m-d H:i:s', strtotime($row_oco_edit['dt_inicio']));
    //$_SESSION['usu'] = $id;
    //echo $dt_fim;
    
?>

<h11><i class="fas fa-user"></i> Editar ocorrência</h11>
<h27> <a href="ocorrencias.php" style="color: #444444; text-decoration: none;"> <i class="fa fa-reply" aria-hidden="true"></i> Voltar </a> </h27> 

<form method="post" action="prc_ocorrencias.php">
</br>
<div class="row">
    <div class="col-md-2">
    </br>
        Codigo da ocorrencia:
        <input class="form-control" type="text" id="cd_oco_h" name="cd_oco_h" value="<?php echo $id?>" disabled>
        <input class="form-control" type="hidden" id="cd_oco" name="cd_oco" value="<?php echo $id?>">
    </div>
    <div class="col-md-2">
    </br>
        Usuario responsavel:
        <input class="form-control" type="text" id="cd_usu" name="cd_usu" value="<?php echo $row_oco_edit['cd_usuario'];?>" disabled>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
    </br>
        Descrição da ocorrencia:
        <?php 
        if($dt_fim == '01/01/1970 01:00:00'){
        ?>
        <textarea rows="5" cols="50" class="form-control" id="ds_oco" name="ds_oco" ><?php echo $row_oco_edit['ds_ocorrencia']?></textarea>
        <?php 
        }else{
        ?>
            <textarea rows="5" cols="50" class="form-control" id="ds_oco" name="ds_oco" disabled><?php echo $row_oco_edit['ds_ocorrencia']?></textarea>
        <?php 
        } 
        ?>
    </div>
    <div class="col-md-4">
    </br>
        Descrição detalhada:
        <?php 
        if($dt_fim == '01/01/1970 01:00:00'){
        ?>
            <textarea rows="5" cols="50" class="form-control" id="ds_deta" name="ds_deta" ><?php echo $row_oco_edit['ds_detalhada']?></textarea>
        <?php 
        }else{
        ?>
            <textarea rows="5" cols="50" class="form-control" id="ds_deta" name="ds_deta"  disabled><?php echo $row_oco_edit['ds_detalhada']?></textarea>
        <?php 
        } 
        ?>
    </div>
    
</div>
</br>
<div class="row">
    <div class="col-md-3">
        Data inicio:
        <input class="form-control" type="text" value="<?php echo $dt_inicio; ?>" id="dt_inicio_h" name="dt_inicio_h" disabled>
        <input class="form-control" type="hidden" value="<?php echo $dt_inicio_j; ?>" id="dt_inicio" name="dt_inicio">
    </div>
    <div class="col-md-3">
        Data fim:
        <?php 
        if($dt_fim == '01/01/1970 01:00:00'){ 
        ?>
            <input class="form-control" type="datetime-local" placeholder="Não foi encerrado" id="dt_fim" name="dt_fim" onblur="valida_dt_fim()">
        <?php
        }else{
        ?>
            <input class="form-control" type="text" value="<?php echo $dt_fim;?>" id="dt_fim" name="dt_fim" disabled >
        <?php 
        } 
        ?>                                         
        
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

<script>

    function valida_dt_fim(){

    var dt_inicio = document.getElementById('dt_inicio').value;
    var dt_fim = document.getElementById('dt_fim').value;
    

    if(dt_inicio == dt_fim ){
        alert("Hora Final Não Pode Ser Igual A Hora inicia");
        document.getElementById('dt_fim').value= "";
        window.setTiemout(function ()
        {
            document.getElementById('dt_fim').focus();
        }, 0);
        return false;
    }  

    if(dt_inicio.substring(0, 10) != dt_fim.substring(0, 10) && dt_inicio != '' && dt_fim != ''){
        alert("Os Dias Não Podem Ser Diferentes");
        document.getElementById('dt_fim').value= "";
        window.setTiemout(function ()
        {
            document.getElementById('dt_fim').focus();
        }, 0);
        return false;
    }

   // "Hora final Não Poder Ser Menor Que Hora Inicial"
    if(dt_inicio.substring(11, 16) > dt_fim.substring(11, 16) && dt_inicio != '' && dt_fim != ''){
        alert("Hora Final Não Pode Ser Menor Que Hora Final");
        document.getElementById('dt_fim').value= "";
        window.setTiemout(function ()
        {
            document.getElementById('dt_fim').focus();
        }, 0);
        return false;
    }  

    }


</script>