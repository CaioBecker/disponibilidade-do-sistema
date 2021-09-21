<?php
session_start();
$data = date("Y-m-d");
$data_ant = date("Y-m-d", strtotime('-90 days', strtotime($data)));

$data_while = $data_ant;
include "cabecalho_oco.php";



//echo $rest;
?>
<style>
p{
    padding-left: 900px;
}


</style>
<center>
<div class="row">
<div class="col-md-12">
    <?php
        $data_hj = date("Y-m-d H:i:s");
        include "sql_erro_hj.php";
        while($row_hj = mysqli_fetch_array($result_hj)){
            ?>
            <center>
            <div class="row-md">
                <div class="col-md-8 " style="color: #fff; background-color: rgb(230, 138, 0);"> <?php
                    echo $row_hj['ds_ocorrencia'];
            ?>
                </div>
                <div class="col-md-8 caixa_aviso" > <?php
                echo 'Descrição: '. $row_hj['ds_detalhada'];

            ?>
                </div>
                <div class="col-md-8 caixa_aviso_b" > <?php
                echo 'Fora do ar desde: '. date("d/m/Y H:i", strtotime($row_hj['dt_inicio']));
            
            ?>  
                </div>
            </div>
            </center>
        </br>
        <?php
        }
        ?>
        

    </div>
</div>
</center>
    </br>
   
<div class="row-md" >

    <center>
    <div class="col-md-12" >
    
    </br>
  
        <div class="row-md">
        <div class="col-md-10" style="border-style: solid; border-radius: 7px; border-color: rgb(128, 191, 255);">
    </br>
        <?php
            $count = 0;
            while($data_while <= $data){
                include "sql_oco.php";
                
                if(@$row_oco['dt_inicio'] != ''){
                    $rest = substr(@$row_oco['dt_inicio'], -19, 10 );
                    $fim  = substr(@$row_oco['dt_fim'], -19, 10 );
                    
                    //echo $data_while;
                    //echo $rest;
                    if($rest == $data_while && $fim != '1970-01-01'){ 
                    $dataIni = date('H:i:s', strtotime(@$row_oco['dt_inicio']));
                        $dataFim = date('H:i:s', strtotime(@$row_oco['dt_fim']));
                        
                        $dataFuturo = $dataIni;
                        $dataAtual = $dataFim;

                        $date_time  = new DateTime($dataAtual);
                        $diff       = $date_time->diff( new DateTime($dataFuturo));
                    

                        
                        ?>
                        <a href="#/" data-toggle="popover" style="text-decoration: none;" title="<?php echo date('d M Y', strtotime($data_while)); ?>" 
                        data-content="<?php echo $diff->format('%H hrs %I mins');
                                            echo ' Descrição: '. $row_oco['ds_ocorrencia']; ?>">
                        <img src="img/barra_erro.png" height="25px" width="5px" class="d-inline-block align-top" > </a>
            <?php }else{ ?>
                    
                        <a href="#/" data-toggle="popover" style="text-decoration: none;" title="<?php echo date('d M Y', strtotime($data_while)); ?>" 
                        data-content="Erro não resolvido"> 
                        <img src="img/barra_hover.png" height="25" width="5px" class="d-inline-block align-top" > </a>
                <?php 
                    }           
                }else{ 
                ?>
                        
                        <a href="#/" data-toggle="popover" style="text-decoration: none;" title="<?php echo date('d M Y', strtotime($data_while)); ?>" 
                        data-content="Nenhum erro reladato neste dia"> 
                        <img src="img/barra_ok.png" height="25px" width="5px" class="d-inline-block align-top" > </a>
                        
        <?php                     
                $count = $count + 1;    
                }        
                $data_while = date("Y-m-d", strtotime('+1 days', strtotime($data_while)));
                //echo $count;
            }
            $porcentagem_dias = 100*($count/100);
            ?><center><?php echo $porcentagem_dias . '% de dias estaveis';?></center><?php
        ?>
        </div>
        </center>
    </div>
    <p>Ultimos 90 dias</p>
    
        </div>
       
        </br>
</div>
<?php

include "rodape_oco.php";

?>