<?php
include 'sql_criar_oco.php';
    include 'cabecalho.php';
    $id  = filter_input(INPUT_GET, 'cd_usuario', FILTER_SANITIZE_STRING);
    session_start();
    //echo $adm;
    
?>

<h11><i class="fas fa-user"></i> Adicionar ocorrência </h11>
<h27> <a href="ocorrencias.php" style="color: #444444; text-decoration: none;"> <i class="fa fa-reply" aria-hidden="true"></i> Voltar </a> </h27> 

</br></br>
<form method="post" action="prc_adicionar_ocorrencia.php">
<div class="row">
    <div class="col-md-3">
        Titulo:
        <input class="form-control" type="text" id="titulo" name="titulo"   required>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
    </br>
        Problema:
        <textarea rows="5" cols="50" placeholder="DIGITE O PROBLEMA" class="form-control" id="ds_oco" name="ds_oco" required></textarea>
    </div>
    
</div>
<div class="row">
    <div class="col-md-4">
        Tipo:
        <select class="form-control" id="tipo" name="tipo">
            <option value="O"> Ocorrência </option>
            <option value="M"> Manutenção Preventiva </option>
        </select>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        Serviço:
        <select class="form-control" id="servico" name="servico">
                <?php
                while($row_serv = mysqli_fetch_array($result_serv)){
                    echo '<option value="' .$row_serv['cd_servico'] . '">' . $row_serv['servico']. '</option>';
                 } ?>
        </select>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
    </br>
        Hora inicial:
        <input class="form-control" type="datetime-local" id="dt_inicio" name="dt_inicio"  onblur="valida_dt_inicio()" required>
    </div>
</div>
<div class="row">
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

var data = new Date();

    function valida_dt_inicio(){
    
        
        var dt_inicio = document.getElementById('dt_inicio').value;
    
        if(dt_inicio.substring(0, 10) > dia_atual.setday(24,0,0,0); {
            alert("Hora inicial Não Pode Ser Maior Que O Dia Atual");
            document.getElementById('dt_inicio').value= "";
            window.setTiemout(function ()
            {
                document.getElementById('dt_inicio').focus();
            }, 0);
            return false;
        }
    }


</script>