<?php
    include 'cabecalho.php';
    $id  = filter_input(INPUT_GET, 'cd_usuario', FILTER_SANITIZE_STRING);
    
    //echo $adm;
    
?>

<h11><i class="fas fa-user"></i> Adicionar ocorrencia</h11>
<h27> <a href="usuarios.php" style="color: #444444; text-decoration: none;"> <i class="fa fa-reply" aria-hidden="true"></i> Voltar </a> </h27> 

</br>
<form method="post" action="prc_adicionar_ocorrencia.php">
<div class="row">
    <div class="col-md-6">
    </br>
        Descrição:
        <textarea rows="5" cols="50" placeholder="DIGITE A DESCRIÇÃO" class="form-control" id="ds_oco" name="ds_oco" required></textarea>
    </div>
    <div class="col-md-6">
    </br>
        Descrição detalhada:
        <textarea rows="5" cols="50" placeholder="DIGITE A DESCRIÇÃO" class="form-control" id="ds_detalha" name="ds_detalha" required></textarea>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
    </br>
        Data inicio:
        <input class="form-control" type="datetime-local" id="dt_inicio" name="dt_inicio"  onblur="valida_dt_inicio()" required>
    </div>
    <div class="col-md-3">
    </br>
 
        Data fim:
        <input class="form-control" type="datetime-local" id="dt_fim" name="dt_fim"  onblur="valida_dt_fim()">
    </div>
</div>
<div class="row-md">
    <div class="col-md-2">
            </br>
        <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i> Adicionar</button> 
    </div>
</div>
</form>


<?php
    include 'rodape.php';
?>

<script>

    function valida_dt_inicio(){

    var dt_inicio = document.getElementById('dt_inicio').value;
    var dt_fim = document.getElementById('dt_fim').value;

    if(dt_inicio >= dt_fim && dt_fim != ''){
        alert("Data fim Não Pode Ser Menor Ou Igual A Data inicio ");
        document.getElementById('dt_fim').value= "";
        window.setTiemout(function ()
        {
            document.getElementById('dt_fim').focus();
        }, 0);
        return false;
    }  
    if(dt_inicio == dt_fim){
        alert("Data fim Não Pode Ser Igual A Data inicio ");
        document.getElementById('dt_fim').value= "";
        window.setTiemout(function ()
        {
            document.getElementById('dt_fim').focus();
        }, 0);
        return false;
    }  
    }

    function valida_dt_fim(){

    var dt_inicio = document.getElementById('dt_inicio').value;
    var dt_fim = document.getElementById('dt_fim').value;

    if(dt_inicio == dt_fim ){
        alert("Data fim Não Pode Ser Igual A Data inicio ");
        document.getElementById('dt_fim').value= "";
        window.setTiemout(function ()
        {
            document.getElementById('dt_fim').focus();
        }, 0);
        return false;
    }  
    if(dt_inicio >= dt_fim && dt_inicio != ''){
        alert("Data fim Não Pode Ser Menor Ou Igual A Data inicio ");
        document.getElementById('dt_fim').value= "";
        window.setTiemout(function ()
        {
            document.getElementById('dt_fim').focus();
        }, 0);
        return false;
    }
    }


</script>