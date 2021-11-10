<?php
    include 'cabecalho.php';
    $id  = filter_input(INPUT_GET, 'cd_oco', FILTER_SANITIZE_STRING);
    session_start();
    include 'sql_visu_oco.php';
    //echo $_SESSION['CD_USUARIO'];
    $dt_inicio = date('d/m/Y H:i:s', strtotime($row_oco_viu['dt_inicio']));
    $dt_fim = date('d/m/Y H:i:s', strtotime($row_oco_viu['dt_fim']));
    //$_SESSION['usu'] = $id;
    //echo $dt_inicio;
    
?>

<h11><i class="fas fa-user"></i> Visualizar ocorrência</h11>
<h27> <a href="ocorrencias.php" style="color: #444444; text-decoration: none;"> <i class="fa fa-reply" aria-hidden="true"></i> Voltar </a> </h27> 

</br>
<div class="row">
    <div class="col-md-2">
    </br>
        Codigo da ocorrencia:
        <input class="form-control" type="text" id="cd_usuh" name="cd_usuh" value="<?php echo $id?>" disabled>
    </div>
    <div class="col-md-3">
    </br>
        Usuario responsavel:
        <input class="form-control" type="text" id="cd_usuh" name="cd_usuh" value="<?php echo $row_oco_viu['cd_usuario'];?>" disabled>
    </div>
</div>
</br>
<div class="row">
    <div class="col-md-4">
        Titulo:
        <input class="form-control" type="text" value="<?php echo $row_oco_viu['titulo']; ?>" id="titulo" name="titulo" disabled>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
    </br>
        Problema:
        <textarea rows="5" cols="50" class="form-control"  id="ds_oco" name="ds_oco" disabled><?php echo $row_oco_viu['ds_ocorrencia']?></textarea>

    </div>
    <div class="col-md-6">
    </br>
        Solução:
        <textarea rows="5" cols="50" class="form-control" id="ds_oco" name="ds_oco" disabled><?php if($row_oco_viu['ds_detalhada'] == ''){ echo 'Estamos trabalhando para resolver esse problema'; }else{ echo @$row_oco_viu['ds_detalhada']; }?></textarea>

    </div>
    
</div>
<div class="row">
    <div class="col-md-4">
        Tipo:
        <?php 
            $tp = $row_oco_viu['tp_ocorrencia'];

            if($tp=="O"){ $tp_res = 'Ocorrência'; }
            if($tp=="M"){ $tp_res = 'Manutenção Preventiva'; }
        ?>
        <input class="form-control" value="<?php echo $tp_res; ?>" disabled>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        Serviço:
        <?php 
            $serv = $row_oco_viu['cd_servico'];

            $consulta_serv = "SELECT * FROM servicos where cd_servico = '$serv'";
            @$result = mysqli_query($conn,$consulta_serv);
            @$row_serv = mysqli_fetch_array($result);
        ?>
        <input class="form-control" value="<?php echo @$row_serv['servico']; ?>"disabled>
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
        <input class="form-control" type="text" value="<?php if($dt_fim == '01/01/1970 01:00:00' || @$row_oco_viu['dt_fim'] == ''){ echo "não foi encerrado ainda";
                                                            }else{echo $dt_fim;} ?>" id="dt_fim" name="dt_fim" disabled>
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