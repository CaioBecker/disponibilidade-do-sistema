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
        <input class="form-control" type="text" id="cd_ocoh" name="cd_ocoh" value="<?php echo $id?>" disabled>
        <input class="form-control" type="hidden" id="cd_oco" name="cd_oco" value="<?php echo $id?>" >
    </div>
    <div class="col-md-3">
    </br>
        Usuario responsavel:
        <input class="form-control" type="text" id="cd_usuh" name="cd_usuh" value="<?php echo $row_oco_edit['cd_usuario'];?>" disabled>
        <input class="form-control" type="hidden" id="cd_usu" name="cd_usu" value="<?php echo $row_oco_edit['cd_usuario'];?>">

    </div>
</div>
</br>
<div class="row">
    <div class="col-md-4">
        Titulo:
        <input class="form-control" type="text" value="<?php echo $row_oco_edit['titulo']; ?>" id="titulo" name="titulo" >
    </div>
</div>
<div class="row">
    <div class="col-md-6">
    </br>
        Problema:
        <textarea rows="5" cols="50" class="form-control"  id="ds_oco" name="ds_oco" ><?php echo $row_oco_edit['ds_ocorrencia']?></textarea>

    </div>

    <div class="col-md-6">
    </br>
        Solução:
        <textarea rows="5" cols="50" class="form-control" id="ds_deta" name="ds_deta" ><?php echo $row_oco_edit['ds_detalhada']?></textarea>

    </div>
    
</div>
<div class="row">
    <div class="col-md-4">
        Serviço:
        <?php 
            $serv = $row_oco_edit['cd_servico'];

            $consulta_serv = "SELECT * FROM servicos where cd_servico = '$serv'";
            $result = mysqli_query($conn,$consulta_serv);
            $row_serv = mysqli_fetch_array($result);
        ?>
        <input class="form-control" value="<?php echo $row_serv['servico']; ?>" disabled>
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
        <input class="form-control" type="datetime-local" id="dt_fim" name="dt_fim" >
    </div>

</div>
<div class="row">
</br>
    <div class="col-md-2">
</br>
    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Salvar</button>
            </br>
    </div>
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