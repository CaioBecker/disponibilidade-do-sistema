<?php
session_start();
$data = date("Y-m-d");
$data_ant = date("Y-m-d", strtotime('-90 days', strtotime($data)));

$data_while = $data_ant;
include "cabecalho_oco.php";



$count = 0;

//echo $rest;
?>
<?php
    while($data_while < $data){
        include "sql_oco.php";
        
        if(@$row_oco['dt_inicio'] != ''){
            $rest = substr(@$row_oco['dt_inicio'], -19, 10 );
            $fim  = substr(@$row_oco['dt_fim'], -19, 10 );
            
            //echo $data_while;
            //echo $rest;
            if($rest == $data_while && $fim != '1970-01-01'){ 
                $dataIni = date('Y/m/d H:i:s', strtotime(@$row_oco['dt_inicio']));
                $dataFim = date('Y/m/d H:i:s', strtotime(@$row_oco['dt_fim']));
                include 'calculo_horas.php';
                $var_resultado_hora = $horasUteisEntreDuasDatas->format('%h');
                $var_resultado_minutos = $horasUteisEntreDuasDatas->format('%i');
                ?>
                <a href="#/" data-toggle="popover" style="text-decoration: none;" title="<?php echo $data_while; ?>" 
                data-content="<?php echo $var_resultado_hora . ":" . $var_resultado_minutos;?>"> 
                <img src="img/barra_erro.png" height="10px" width="5px" class="d-inline-block align-top" > </a>
      <?php }else{ ?>
               
                <a href="#/" data-toggle="popover" style="text-decoration: none;" title="<?php echo $data_while; ?>" 
                data-content="Erro não resolvido"> 
                <img src="img/barra_hover.png" height="10" width="5px" class="d-inline-block align-top" > </a>
        <?php 
            }           
        }else{ 
        ?>
                <a href="#/" data-toggle="popover" style="text-decoration: none;" title="<?php echo $data_while; ?>" 
                data-content="Nenhum erro reladato nesse dia"> 
                <img src="img/barra_ok.png" height="10px" width="5px" class="d-inline-block align-top" > </a>
<?php                     
            }        
        $data_while = date("Y-m-d", strtotime('+1 days', strtotime($data_while)));
        $count = $count + 1;
        //echo $count;
    }
    //echo $count; 
?>
<?php

include "rodape_oco.php";

?>