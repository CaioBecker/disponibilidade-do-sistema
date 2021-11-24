<?php
session_start();

include 'cabecalho.php';
include 'sql_servicos.php';
//$row_usuario = mysqli_fetch_array($result_usuario);
//$_SESSION['adm'] = $row_usuario['adm'];
//echo $_SESSION['adm'];

 //ACESSO RESTRITO
 include 'acesso_restrito_adm.php';

            include 'js/mensagens.php';
            include 'js/mensagens_usuario.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){  
  $consulta_nulo = "SELECT COUNT(*) AS QTD FROM SERVICOS";
  $result_nulo = mysqli_query($conn,$consulta_nulo);
  $row_nulo = mysqli_fetch_array($result_nulo);
  if($row_nulo['QTD'] > 0){ 
    if(@$row_qtd['qtd'] ==  '0'){
      $_SESSION['msgerro'] = "Valor não encontrado.";
                              
      header('Location: servicos.php');
    }
  }
}
?>
<h11><i class="fa fa-list-ul"></i>Serviços</h11>
<span class="espaco_pequeno" style="width: 6px;" ></span>
<h27> <a href="home.php" style="color: #444444; text-decoration: none;"> <i class="fa fa-reply" aria-hidden="true"></i> Voltar </a> </h27> 

<div class="div_br"> </div>     

<form method="Post" autocomplete="off">
<div class="row">

        <div class="col-md-2">
            <label> Código do serviço: </label>
        </div>
        <div class="col-md-6">
            <label> Tipo de serviço: </label>
        </div>
    </div>
    <div class="row">

        <div class="col-md-2">
            
            <input class="form-control" type="text" id="id_cd_serv" name="cd_serv" placeholder="Digite o código do serviço"> </input>
        </div>
        <div class="col-md-4 input-group">
            <input class="form-control" type="text" id="id_tp_serv" name="tp_serv" placeholder="Digite o tipo de serviço"> </input>
            <button type="submit" class="btn btn-primary" id="btn_pesquisar" style=""> <i class="fa fa-search" aria-hidden="true"></i></button>
            <button type="button" class="btn btn-verde" data-toggle="modal" data-target="#exampleModal">
                <h21><i class="fas fa-plus"></i></h21>
            </button>
        </div>
    </div>	
</form>

</br>
<!-- Button trigger modal -->


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cadastrar serviço</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="Post" autocomplete="off" action='prc_criar_servico.php'>
        <input class="form-control" type="text" id="id_tp_serv_c" name="tp_serv_c" placeholder="Digite o tipo de serviço" required> </input>
        Cor(RGB):
        <input class="form-control" type="text" id="cor" name="cor" placeholder="Codigo rgb" required> </input>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Salvar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php
//echo $row_qtd['qtd'];
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{   
    $temp_v_valor = @$_POST['cd_serv'];						
    $tipo = @$_POST['tp_serv'];	

    header('Location: servicos.php?pagina=1&filtro=' . $temp_v_valor .'&tipo=' . $tipo);	  
}

?>



        </br>
		
<?php
		
		echo "<div class='table-responsive col-md-12'>
              <table class='table table-striped' cellspacing='0' cellpadding='0'>" . "<thead><tr>"; 
				
		echo "<th class='align-middle' style='text-align: center;'> Código do serviço</th>			  
		      <th class='align-middle' style='text-align: center;'> Tipo do serviço</th>
          <th class='align-middle' style='text-align: center;'> Cor</th>
          <th class='align-middle' style='text-align: center;'> T.I.</th>
          <th class='align-middle' style='text-align: center;'> Opções</th>
          <th class='align-middle' style='text-align: center;'> </th>";
         
      $qtd = 1;
        while ($row_servico = mysqli_fetch_array($result_servico)) {
          $cd_serv = $row_servico['cd_servico'];
						$serv_qtd="SELECT COUNT(*) AS QTD FROM ocorrencias_sistema WHERE cd_servico = '$cd_serv'";
            $result_qtd = mysqli_query($conn,$serv_qtd);
            $row_serv_qtd = mysqli_fetch_array($result_qtd);
            echo "</tr></thead>";		
            echo "<td class='align-middle' style='text-align: center;'>" . $row_servico['cd_servico'] . "</br>" . "</td>";
            echo "<td class='align-middle' style='text-align: center;'> " .  $row_servico['servico']  . "</br>" . "</td>";
            echo "<td class='align-middle' style='align-items: center; justify-content: center; '> 
                    </br>
                    <center>
                      <div style='height: 20px; width: 20px; background-color: rgb". $row_servico['rgb'] .";'> 
                      </div>
                    </center>
                    </br>
                  </td>";
            if ($row_servico['sn_ti'] == 'S') { 
                
              echo "<td class='text-center align-middle'>" .
              "<a class='botoes' style='color: #3c3c3c;' href='sn_ti_serv.php?id=" . 
              $row_servico['cd_servico']  . "&sn_ativo=N&tabela=usuarios" .
               "' onclick=\"return confirm('Tem certeza que deseja desativar esse serviço como T.I.?');\">" . 
              "<i class='fa fa-toggle-on' aria-hidden='true'></i>" . "</a>" . "</td>";
            } 
            else {
              echo "<td class='text-center align-middle'>" . 
              "<a class='botoes' style='color: #3c3c3c;' href='sn_ti_serv.php?id=" .
              $row_servico['cd_servico']  . "&sn_ativo=S&tabela=usuarios" . 
              "' onclick=\"return confirm('Tem certeza que deseja ativar esse serviço como T.I.?');\">" . 
              "<i class='fa fa-toggle-off' aria-hidden='true'></i>" . "</a>" . "</td>"; 
            };
              
            if($row_serv_qtd['QTD'] >= 1){
              echo "<td class='align-middle' style='text-align: center;'> <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#modal_edit_" . $qtd . "'>
              <h21><i class='fas fa-pen'></i></h21></button> ". "<a class='btn btn-adm' style='color: #3c3c3c;'
                  ' onclick=\"alert('Esse registro não pode ser apagado');\">" . 
                  "<i class='fas fa-trash-alt'></i>" . "</a>" . "</td>"; 
            }else{
              echo "<td class='align-middle' style='text-align: center;'> <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#modal_edit_". $qtd ."'>" . 
              "<i class='fas fa-pen'></i>" . "</button> ".  "<a class='btn btn-adm' style='color: #3c3c3c;' href='prc_excluir_serv.php?id=" .
                  $row_servico['cd_servico']. 
                  "' onclick=\"return confirm('Tem certeza que deseja excluir esse registro?');\">" . 
                  "<i class='fas fa-trash-alt'></i>" . "</a>" . "</td>"; 
            }
            ?>
              <div class="modal fade " id="modal_edit_<?php echo $qtd; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Cadastrar serviço</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form method="Post" autocomplete="off" action='prc_servico.php'>
                        Codigo
                        <input class="form-control" type="text" id="id_cd_serv" name="cd_servico_c" value="<?php echo $row_servico['cd_servico'] ?>" disabled> </input>
                        <input class="form-control" type="hidden" id="id_cd_serv" name="cd_servico" value="<?php echo $row_servico['cd_servico'] ?>"> </input>
                        Tipo
                        <input class="form-control" type="text" id="id_tp_serv_c" name="tp_serv_c" value="<?php echo $row_servico['servico'] ?>" required> </input>
                        Cor(RGB):
                        <input class="form-control" type="text" id="cor" name="cor" value="<?php echo $row_servico['rgb'] ?>" placeholder="(***, ***, ***)" required> </input>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Salvar</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            
            <?php
             
            
         echo "</tr>";
         $qtd = $qtd +1;
        }

        echo "</table></div>";

        


?>

<?php 
include 'rodape.php';
?>