<?php
session_start();
include 'cabecalho.php';
include 'sql_ocorrencias.php';
//$row_oco = mysqli_fetch_array($result_usuario);
//$_SESSION['adm'] = $row_oco['adm'];
//echo $_SESSION['adm'];

?>

<?php
            include 'js/mensagens.php';
            include 'js/mensagens_usuario.php';
        ?>

<h11><i class="fa fa-list-ul"></i> Ocorrências </h11>
<span class="espaco_pequeno" style="width: 6px;" ></span>
<h27> <a href="home.php" style="color: #444444; text-decoration: none;"> <i class="fa fa-reply" aria-hidden="true"></i> Voltar </a> </h27> 

<div class="div_br"> </div>     

<form method="Post" autocomplete="off">
    <div class="row">

        <div class="col-md-3 ">
             Codigo da ocorrencia:
            <input class="form-control " type="text" id="id_cd_oco" name="cd_oco" placeholder="Digite o código da ocorrencia"> </input>
        </div>
        <div class="col-md-3 ">
            Data de inicio:
            <input class="form-control " type="datetime-local" id="id_dt_oco_in" name="dt_oco_in" onblur ="valida_dt_inicio()"> </input>
</div>
        <div class="col-md-3 ">
            Data fim:
            <input class="form-control " type="datetime-local" id="id_dt_oco_fm" name="dt_oco_fm" onblur ="valida_dt_fim()"> </input> 
        </div>
        <div class="col-md-3">
</br>
            <button type="submit" class="btn btn-primary" id="btn_pesquisar" style=""> <i class="fa fa-search" aria-hidden="true"></i></button>	
</form>
            <a href="adicionar_ocorrencia.php" class="btn btn-verde" type="submit"><h21><i class="fas fa-plus"></i></h21></a>

        </div>
    </div>

    <?php
    if(@$row_oco['cd_ocorrencia'] = '' && @$_SESSION['pesquisa'] == 'S' ){

    $_SESSION['msgerro'] = "Valor não encontrado.";
    $_SESSION['pesquisa'] == "N";
    header('Location: ocorrencias.php');
 
    }
?>
    

<?php


if ($_SERVER['REQUEST_METHOD'] == 'POST')
{   
    echo $row_qtd['QTD'];
    if($row_qtd['QTD'] == '0'){
        //$_SESSION['msgerro'] = "Valor não encontrado.";
                        
        header('Location: ocorrencias.php');
    }else{
        $temp_v_valor = @$_POST['cd_oco'];						
        $dt_inicio = @$_POST['dt_oco_in'];
        $dt_fim = @$_POST['dt_oco_fm'];
        header('Location: ocorrencias.php?pagina=1&filtro=' . $temp_v_valor.'&dt_inicio='. $dt_inicio.'&dt_fim='.$dt_fim);	
    }
    
}

?>



        </br>
		
<?php
		
		echo "<div class='table-responsive col-md-12'>
              <table class='table table-striped' cellspacing='0' cellpadding='0'>" . "<thead><tr>"; 
				
		echo "<th class='align-middle' style='text-align: center;'> Código da ocorrencia</th>			  
		      <th class='align-middle' style='text-align: center;'> Descrição</th>
              <th class='align-middle' style='text-align: center;'> Data incicio</th>
              <th class='align-middle' style='text-align: center;'> Data fim</th>
              <th class='align-middle' style='text-align: center;'> Usuario responsavel</th>
              <th class='align-middle' style='text-align: center;'> Opções </th>";
        

        while ($row_oco) {
						
            echo "</tr></thead>";		
            echo "<td style='text-align: center;'>" . $row_oco['cd_ocorrencia']. "<br>" . "</td>";
            echo "<td style='text-align: center;'>" . $row_oco['ds_ocorrencia'] . "<br>" . "</td>";
            echo "<td style='text-align: center;'>" . date('d/m/Y H:i', strtotime($row_oco['dt_inicio'])) . "<br>" . "</td>"; 
            if ($row_oco['dt_fim'] == '1970-01-01 01:00:00'){
                echo "<td style='text-align: center;'> Não foi encerrado <br>" . "</td>"; 
            }else{
            echo "<td style='text-align: center;'>" . date('d/m/Y H:i', strtotime($row_oco['dt_fim'])) . "<br>" . "</td>"; 
            }
            echo "<td style='text-align: center;'>" . $row_oco['cd_usuario'] . "<br>" . "</td>";
            echo "<td style='text-align: center;'>" . "<a class='btn btn-primary' href='visualizar_oco.php?cd_oco=" .  $row_oco['cd_ocorrencia'] . "'>" . "<i class='fas fa-eye'></i>" . "</a> "; 		
            if ($row_oco['dt_fim'] == '1970-01-01 01:00:00'){
            echo "<a class='btn btn-primary' href='editar_oco.php?cd_oco=" .  $row_oco['cd_ocorrencia'] . "'>" . "<i class='fas fa-pen'></i>". "</a>" ;
            }
            if ($_SESSION['adm'] == 'S'){
                echo "<a class='btn btn-adm' style='color: #3c3c3c;' href='prc_excluir_oco.php?id=" . $row_oco['cd_ocorrencia']  . "&sn_ativo=S&tabela=usuarios" . 
                    "' onclick=\"return confirm('Tem certeza que deseja excluir esse registro?');\">" . 
                    "<i class='fas fa-trash-alt'></i>" . "</a>" . "</td>";
            } 
  
        }

        echo "</table></div>";

        


?>

<?php 
include 'rodape.php';
?>

<script>

    function valida_dt_inicio(){

    var dt_inicio = document.getElementById('id_dt_oco_in').value;
    var dt_fim = document.getElementById('id_dt_oco_fm').value;

    if(dt_inicio >= dt_fim && dt_fim != ''){
        alert("Data fim Não Pode Ser Menor Ou Igual A Data inicio ");
        document.getElementById('id_dt_oco_fm').value= "";
        window.setTiemout(function ()
        {
            document.getElementById('id_dt_oco_fm').focus();
        }, 0);
        return false;
    }  
    if(dt_inicio == dt_fim){
        alert("Data fim Não Pode Ser Igual A Data inicio ");
        document.getElementById('id_dt_oco_fm').value= "";
        window.setTiemout(function ()
        {
            document.getElementById('id_dt_oco_fm').focus();
        }, 0);
        return false;
    }  
    }

    function valida_dt_fim(){

    var dt_inicio = document.getElementById('id_dt_oco_in').value;
    var dt_fim = document.getElementById('id_dt_oco_fm').value;

    if(dt_inicio == dt_fim ){
        alert("Data fim Não Pode Ser Igual A Data inicio ");
        document.getElementById('id_dt_oco_fm').value= "";
        window.setTiemout(function ()
        {
            document.getElementById('id_dt_oco_fm').focus();
        }, 0);
        return false;
    }  
    if(dt_inicio >= dt_fim && dt_inicio != ''){
        alert("Data fim Não Pode Ser Menor Ou Igual A Data inicio ");
        document.getElementById('id_dt_oco_fm').value= "";
        window.setTiemout(function ()
        {
            document.getElementById('id_dt_oco_fm').focus();
        }, 0);
        return false;
    }
    }


</script>