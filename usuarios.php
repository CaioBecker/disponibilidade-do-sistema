<?php
session_start();
include 'cabecalho.php';
include 'sql_usuarios.php';
//$row_usuario = mysqli_fetch_array($result_usuario);
//$_SESSION['adm'] = $row_usuario['adm'];
//echo $_SESSION['adm'];

?>

<?php
            include 'js/mensagens.php';
            include 'js/mensagens_usuario.php';
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

        <div class="col-md-5 input-group">
            
            <input class="form-control input-group" type="text" id="id_cd_usu" name="cd_usu" placeholder="Digite o código do usuario"> </input>
            <button type="submit" class="btn btn-primary" id="btn_pesquisar" style=""> <i class="fa fa-search" aria-hidden="true"></i></button>	
</form>
            <a href="criar_usuario.php" class="btn btn-verde" type="submit"><h21><i class="fas fa-plus"></i></h21></a>

        </div>
    </div>


    

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{   
    if (@$_POST['cd_usu'] == '') {
				
        //$_SESSION['msgerro'] = "Insira um valor válido.";
                        
        header('Location: usuarios.php');
    }else if(@$row_usuario['count'] =  '0'){
        //$_SESSION['msgerro'] = "Valor não encontrado.";
                        
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
                echo "<td style='text-align: center;'>" . "<a class='btn btn-primary' href='visualizar_usu.php?cd_usuario=" .  $row_usuario['cd_usuario'] . "'>" . "<i class='fas fa-eye'></i>" . "</a> "; 		
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
                echo "<td style='text-align: center;'>" . "<a class='btn btn-primary' href='editar_usu.php?cd_usuario=" .  $row_usuario['cd_usuario'] . "'>" . "<i class='fas fa-pen'></i>" . "</a>  
                    <a class='btn btn-adm' style='color: #3c3c3c;' href='prc_excluir_usu.php?id=" .
                    $row_usuario['cd_usuario']  . "&sn_ativo=S&tabela=usuarios" . 
                    "' onclick=\"return confirm('Tem certeza que deseja excluir esse registro?');\">" . 
                    "<i class='fas fa-trash-alt'></i>" . "</a>" . "</td>"; 
            }else { 
                echo "<td style='text-align: center;'>" . "<a class='btn btn-primary' href='visualizar_usu.php?cd_usuario=" .  $row_usuario['cd_usuario'] . "'>" . "<i class='fas fa-eye'></i>" . "</a> "; 		
            } 
            
         echo "</tr>";
        }

        echo "</table></div>";

        


?>

<?php 
include 'rodape.php';
?>