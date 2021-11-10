<?php
session_start();
include 'cabecalho.php';
include 'sql_usuarios.php';
//$row_usuario = mysqli_fetch_array($result_usuario);
//$_SESSION['adm'] = $row_usuario['adm'];
//echo $_SESSION['adm'];
$qtd_row = '1';
?>

<?php
            include 'js/mensagens.php';
            include 'js/mensagens_usuario.php';
        ?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST'){   
    $consulta_nulo = "SELECT COUNT(*) AS QTD FROM usuarios";
    $result_nulo = mysqli_query($conn,$consulta_nulo);
    $row_nulo = mysqli_fetch_array($result_nulo);
    if($row_nulo['QTD'] > 0){ 
        if(@$row_qtd['qtd'] ==  '0'){
            $_SESSION['msgerro'] = "Valor não encontrado.";
                              
        header('Location: usuarios.php');
        }
    }
}
?>
<h11><i class="fa fa-list-ul"></i>Usuarios</h11>
<span class="espaco_pequeno" style="width: 6px;" ></span>
<h27> <a href="home.php" style="color: #444444; text-decoration: none;"> <i class="fa fa-reply" aria-hidden="true"></i> Voltar </a> </h27> 

<div class="div_br"> </div>     

<form method="Post" autocomplete="off">
    <div class="row-md">

    <div class="col-md-12">
         <label> Código do usuario: </label>
    </div>

        <div class="col-md-4 input-group">
            
            <input class="form-control input-group" type="text" id="id_cd_usu" name="cd_usu" placeholder="Digite o código do usuario"> </input>
            <button type="submit" class="btn btn-primary" id="btn_pesquisar" style=""> <i class="fa fa-search" aria-hidden="true"></i></button>	
</form>
<?php if($_SESSION['adm'] == 'S'){ ?>      
    <button type="button" class="btn btn-verde" data-toggle="modal" data-target=".bd-example-modal-lg">
        <h21><i class="fas fa-plus"></i></h21>
    </button>   
    <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cadastrar usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="prc_criar_usuarios.php">
                        <div class="row">
                            <div class="col-md-4">
                            </br>
                                Usuario:
                                <input class="form-control" type="text" id="cd_usu" name="cd_usu_c" onblur="valida_usu()" required>
                        
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                            </br>
                                Nome do Usuario:
                                <input class="form-control"  type="text" id="nm_usu_c" name="nm_usu_c" required>
                            </div>
                            <div class="col-md-3">
                            </br>
                                Setor:
                                <input class="form-control" type="text" id="setor_usu_c" name="setor_usu_c" required>
                            </div>
                            <div class="col-md-4">
                            </br>
                        
                                Tipo usuario:
                            
                                <select class="form-control" name="tp_usu_c" id="tp_usu_c" onblur="">
                                <option value='S'>Administrador</option>
                                <option value='N'>Comum</option>
                                </select>
                            
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 input-group">
                                Senha:
                            </div>
                            <div class="col-md-5 input-group">
                                <input class="input-group form-control " type="password" id="senha_c" name="senha_c" required>
                                <button class="btn btn-primary" type="button" onclick="mostrarSenha()"><i class="fa fa-eye" aria-hidden="true"></i></button> <span class="espaco">
                            </div>
                        </div>
                        
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Salvar</button>
                    </from>
                </div>
            </div>
        </div>
    </div>

    <?php } ?>
        </div>
    </div>
    



    

<?php
//echo $row_qtd['qtd'];
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{   
    
    if (@$_POST['cd_usu'] == '') {
				
        $_SESSION['msgerro'] = "Insira um valor.";
                        
        header('Location: usuarios.php');
    }else{
        $temp_v_valor = @$_POST['cd_usu'];						
    
        header('Location: usuarios.php?pagina=1&filtro=' . $temp_v_valor);	
    }
    
}

?>



        </br>
		
<?php
		
		echo "<div class='table-responsive col-md-12'>
              <table class='table table-striped' cellspacing='0' cellpadding='0'>" . "<thead><tr>"; 
				
		echo "<th class='align-middle' style='text-align: center;'> Código usuario</th>			  
		      <th class='align-middle' style='text-align: center;'> Nome do usuario</th>
              <th class='align-middle' style='text-align: center;'> Admin</th>
              <th class='align-middle' style='text-align: center;'> Visualizar</th>";
        if (strtoupper($_SESSION['adm']) == 'S'){
          echo "<th class='align-middle' style='text-align: center;'> Ativo</th>
                <th class='align-middle' style='text-align: center;'> Opções</th>";
        } 

        while ($row_usuario = mysqli_fetch_array($result_usuario)) {
						
            echo "</tr></thead>";		
            echo "<td style='text-align: center;'>" . $row_usuario['cd_usuario']. "<br>" . "</td>";
            echo "<td style='text-align: center;'>" . $row_usuario['nm_usuario'] . "<br>" . "</td>";
            if($row_usuario['adm'] == 'S') { 
                echo "<td style='text-align: center;'>" . "<i style='color:green' class='fa fa-check' aria-hidden='true'></i>" . "<br>" . "</td>"; 
            }else { 
                echo "<td style='text-align: center;'>" . "<i style='color:red' class='fa fa-times' aria-hidden='true'></i>" . "<br>" . "</td>"; 
            } 
            
                        
            if(strtoupper($_SESSION['adm']) == 'S') { 
                echo "<td style='text-align: center;'>" . "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#visu_Modal" . $qtd_row . "'>
                <h21><i class='fas fa-eye'></i></h21></button>" . "" . "</a> "; 
                if ($row_usuario['sn_ativo'] == 'S') { 
                
                    echo "<td class='text-center'>" .
                    "<a class='botoes' style='color: #3c3c3c;' href='sn_ativo_usu.php?id=" . 
                    $row_usuario['cd_usuario']  . "&sn_ativo=N&tabela=usuarios" .
                     "' onclick=\"return confirm('Tem certeza que deseja desativar esse usuario?');\">" . 
                    "<i class='fa fa-toggle-on' aria-hidden='true'></i>" . "</a>" . "</td>";
                } 
                else {
                    echo "<td class='text-center'>" . 
                    "<a class='botoes' style='color: #3c3c3c;' href='sn_ativo_usu.php?id=" .
                    $row_usuario['cd_usuario']  . "&sn_ativo=S&tabela=usuarios" . 
                    "' onclick=\"return confirm('Tem certeza que deseja ativar esse usuario?');\">" . 
                    "<i class='fa fa-toggle-off' aria-hidden='true'></i>" . "</a>" . "</td>"; 
                };
                echo "<td style='text-align: center;'>" . "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#editar_Modal" . $qtd_row . "'>
                <h21><i class='fas fa-pen'></i></h21></button>" . "" . "  
                    <a class='btn btn-adm' style='color: #3c3c3c;' href='prc_excluir_usu.php?id=" .
                    $row_usuario['cd_usuario']  . "&sn_ativo=S&tabela=usuarios" . 
                    "' onclick=\"return confirm('Tem certeza que deseja excluir esse registro?');\">" . 
                    "<i class='fas fa-trash-alt'></i>" . "</a>" . "</td>"; 
            }else { 
                echo "<td style='text-align: center;'>" . "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#visu_Modal" . $qtd_row . "'>
                <h21><i class='fas fa-eye'></i></h21></button>" . "" . "</a> "; 		
            } 
            
         echo "</tr>";
         ?>
         <div class="modal fade bd-example-modal-lg" id="visu_Modal<?php echo $qtd_row;?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content ">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Visualizar usuario</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                            </br>
                                Usuario:
                                <input class="form-control" type="text" id="cd_usuh" name="cd_usuh" value="<?php echo $row_usuario['cd_usuario']?>" disabled>
                            </div>
                    </div>
                    <div class="row">
                            <div class="col-md-4">
                            </br>
                                Nome do Usuario:
                                <input class="form-control"  type="text" id="nm_usu" name="nm_usuh" value="<?php echo $row_usuario['nm_usuario']?>" disabled>
                            </div>
                            <div class="col-md-3">
                            </br>
                                Setor:
                                <input class="form-control" type="text" id="setor_usu" name="setor_usu" value="<?php echo $row_usuario['setor']?>" disabled>
                            </div>
                            <div class="col-md-3">
                            </br>
                        
                                Tipo usuario:
                            
                                <?php 
                                
                                if($row_usuario['adm'] == 'S'){
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
                        <div class="row">
                            <div class="col-md-12 input-group">
                                Senha:
                            </div>
                            <div class="col-md-5 input-group">
                            <input class="input-group form-control " value="<?php echo base64_decode($row_usuario['senha']); ?>" type="text" id="senha_v" name="senha_v" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>

                    </div>
                </div>
            </div>
         </div>

         <div class="modal fade bd-example-modal-lg" id="editar_Modal<?php echo $qtd_row;?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content ">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Editar usuario</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <form method="post" action="prc_usuarios.php">
                        <div class="row">
                            <div class="col-md-4">
                            </br>
                                Usuario:
                                <input class="form-control" type="text" id="cd_usuh" name="cd_usuh" value="<?php echo $row_usuario['cd_usuario']?>" disabled>
                                <input class="form-control" type="hidden" id="cd_usu" name="cd_usu" value="<?php echo $row_usuario['cd_usuario']?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                            </br>
                                Nome do Usuario:
                                <input class="form-control"  type="text" id="nm_usu_e" name="nm_usu_e" value="<?php echo $row_usuario['nm_usuario']?>">
                            </div>
                            <div class="col-md-3">
                            </br>
                                Setor:
                                <input class="form-control" type="text" id="setor_usu_e" name="setor_usu_e" value="<?php echo $row_usuario['setor']?>">
                            </div>
                            <div class="col-md-4">
                            </br>
                        
                                Tipo usuario:
                            
                                <select class="form-control" name="tp_usu_e" id="tp_usu_e">
                                <?php
                                if(isset($row_usuario['adm'])){
                                    if($row_usuario['adm'] == 'S'){
                                    echo "<option value='S'>Administrador</option>";
                                    echo "<option value='N'>Comum</option>";
                                    }else{
                                        echo  '<option value="'. $row_usuario['adm'] . '">Comum</option>';
                                        echo "<option value='S'>Administrador</option>";
                                    }
                                } else {
                                    echo "<option value=''>SELECIONE UM VALOR</option>";
                                }
                                    
                                
                                ?>
                                </select>
                            
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 input-group">
                                Senha:
                            </div>
                            <div class="col-md-5 input-group">
                            <input class="input-group form-control " value="<?php echo base64_decode($row_usuario['senha']); ?>" type="text" id="senha_e" name="senha_e" >
                            </div>
                        </div>
                        </br>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Salvar</button> 
                        </div>
                    </form>
                </div>
            </div>
         </div>
     <?php
     $qtd_row = $qtd_row + 1;
        }

        echo "</table></div>";

        ?>
        



<?php 
include 'rodape.php';
?>
<script>
    function valida_usu(){
        var usu_js = document.getElementById('cd_usu');
        $_SESSION['cd_usuario_js'] = usu_js;
    }

	function mostrarSenha(){
		var tipo = document.getElementById("senha_c");
		if(tipo.type == "password"){
			tipo.type = "text";
		}else{
			tipo.type = "password";
			}
	}

  


</script>
